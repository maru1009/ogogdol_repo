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
      <form id="registerForm" action="process/reg_pro.php" method="post">
        <h2>Register</h2>
        <hr/>
        <div class="names">
          <input type="text" placeholder="First name" required>
          <input type="text" placeholder="Last name" required>    
        </div>
        <input type="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Password" required>
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