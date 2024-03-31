<?php
session_start();
if(!isset($_SESSION['id'])) {
  
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/my_profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php require_once 'assets/header.php '?>
<?php require 'process/profile.php' ?> 
  <!-- Profile form -->
  <div class="profile-page">
    <div class="profile-container">
        <div class="profile-header">
            <img src="images/image1.png" alt="Profile Picture">
            <h2><?php echo $first , " " , $last; ?></h2>
        </div>
        <div class="profile-info">
            <h5>Email</h5>
            <span>Email: <?php echo $email; ?></span>
            <h5>Password</h5>
            <span>Password: ********</span>
        </div>
        <div class="profile-footer">
            <button>Edit Profile</button>
        </div>
    </div>
  </div>


  <!-- Footer -->
  <?php require_once 'assets/footer.php'?>
  
  <!-- js for toggle menu -->
<script src="js/menu.js"></script>
</body>
</html>