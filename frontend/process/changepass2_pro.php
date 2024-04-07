<?php
$mysqli = require "conn2.php";
include "../libs/validators.php";

session_start();
$_SESSION['change_errors'] = array();
$token = $_POST['token'];

$token_hash = hash("sha256", $token);

// Validate password
if (empty($_POST["password"])) {
    $_SESSION['errors'][] = "Password is empty";
} else {
    if (!password_validate($_POST['password'])) {
        $_SESSION['change_errors'][] = "Password is not strong";
    }
}

$password = $_POST['password']; // Don't validate again, just use the raw password

$sql = "SELECT * FROM Customer
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("Error: " . $mysqli->error); // Check for errors in prepare
}

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}

// Check if cus_email key exists
if (!array_key_exists('Cus_email', $user)) {
    die("cus_email key not found in user data");
}

$dynamic_salt = $user["pass_salt"];
// echo $dynamic_salt;
// echo "{{{{{{{{{{{{{{{{";
// echo var_dump($user);
$email = $user["Cus_email"];

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

$hashed_password = hash('sha256', $password . $dynamic_salt);

$sql = "UPDATE customer
        SET cus_pass = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE cus_email = ?";

$stmt = $mysqli->prepare($sql);
// echo var_dump($stmt);
if (!$stmt) {
    die("Error: " . $mysqli->error); // Check for errors in prepare
}

$stmt->bind_param("ss", $hashed_password, $email); // Assuming cus_id is an integer

$stmt->execute();
header("Location ../login.php")
?>
