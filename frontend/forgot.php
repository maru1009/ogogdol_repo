<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/forgot.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php require_once 'assets/header.php'?>
    <?php require 'assets/profile.php' ?>
  <!-- Password recovery form -->
  <div class="profile-page">
    <div class="profile-container">
      <div class="profile-header">
        <img src="images/image1.png" alt="Profile Picture">
        <h2><?php echo $username; ?></h2>
      </div>
      <div class="profile-info">
        <h5>Email</h5>
        <span>Email: <?php echo $email; ?></span>
        <h5>Phone</h5>
        <span>Phone: <?php echo $phone; ?></span>
      </div>
      <div class="profile-footer">
        <button>Edit Profile</button>
        <button>Change Password</button>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php require_once 'assets/footer.php'?>
  
  <!-- js for toggle menu -->
<script src="js/menu.js"></script>
<script src="js/valid_email.js"></script>
</body>
</html>