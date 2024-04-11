<?php

// handsan huudas ruu ni redirect hiideg bolgomoor bn 
if(isset($_SESSION['id']))
{
    // turdee index ruu butsaay
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <?php require_once 'assets/header.php' ?>
  <!-- Register form -->
  <div class="account-page">
    <div class="form-container">
      <form id="registerForm" action="process/reg_pro.php" method="POSt">
        <h2>Register</h2>
        <hr/>
        <?php if (isset($_SESSION['errors'])): ?>
        <div class="form-errors">
        <?php foreach($_SESSION['errors'] as $error): ?>
            <p class="register_errors"><?php echo $error ?></p>
        <?php endforeach; ?>
       </div>
     
       <?php 
        unset($_SESSION['errors']); // Clear the 'errors' session variable endif; 
        endif;
      ?>
        <div class="names">
          <input type="text" placeholder="First name" required name="uname">
          <input type="text" placeholder="Last name" required name="lname">
        </div>
        <input type="email" placeholder="Email" required name="email">
        <input type="password" id="password" placeholder="Password" required name="password">
        <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
        <br>
        <button type="submit" class="btn">Register</button>
        <div class="button">
          <a href="login.php">Already have an account?</a>
        </div>
      </form>
    </div>
  </div>


  <!-- Footer -->
  <?php require_once 'assets/footer.php'?>
  
  <!-- js for toggle menu -->
<script src="js/menu.js"></script>
<script src="js/error_pass.js"></script>
</body>
</html>
