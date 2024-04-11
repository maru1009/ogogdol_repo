<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require "process/conn2.php";

$sql = "SELECT * FROM customer
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="css/reset_password.css">
</head>
<body>
    <?php require_once 'assets/header.php'; ?>
    <!-- Change pass form -->
    <div class="account-page">
        <div class="form-container">
            <form id="registerForm" action="process/changepass2_pro.php" method="POST">
                <h2>Reset Password</h2>
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <input type="password" id="password" placeholder="Password" required name="password">
                <input type="password" id="confirmPassword" placeholder="Confirm Password" required name="confirmPassword">
                <br>
                <button type="submit" class="btn">Reset Password</button>
            </form>
        </div>
    </div>

    <script src="js/error_pass.js"></script>
</body>
</html>



