<?php
include "process/conn.php";
$token= $_GET['token'];

$token_hash = hash("sha256",$token);

$sql="SELECT * FROM customer
      WHERE reset_token_hash = ?";

$stmt_check=mysqli_prepare($conn,$sql);
if(!$stmt_check)
{
    die('Error in preparing check statement: ' . mysqli_error($conn));
  }

mysqli_stmt_bind_param($stmt_check,"s",$token_hash);
mysqli_stmt_execute($stmt_check);

$result = mysqli_stmt_get_result($stmt_check);
if(mysqli_num_rows($result)>0)
{
    $row = mysqli_fetch_assoc($result);
    if($row===null)
    {
        die("token not found");
    }
   if(strtotime($row["reset_token_expires_at"])<= time()) {
    die("token has expired");  
    }
    echo"token is valid and hasn't expired";

}
?>


<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/forgot.css">
>
</head>
<body>
    <?php require_once 'assets/header.php'?>
  <!-- Change pass form -->
  <div class="account-page">
    <div class="form-container">
      <form id="registerForm" action="process/changepass_pro.php" method="POSt">
        <h2>Register</h2>
        
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <input type="password" id="password" placeholder="Password" required name="password">
        <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
        <br>
        <button type="submit" class="btn">Reset password</button>
      </form>
    </div>
  </div>

  <script src="js/error_pass.js"></script>
