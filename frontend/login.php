<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php require_once 'assets/header.php'?>
  <!-- Login form -->
  <div class="account-page">
    <div class="form-container">
      <form id="LoginForm" action="process/log_pro.php" method="POST">
        <h2>Welcome back</h2>
        <hr/>

        <?php if (isset($_SESSION['login_errors'])): ?>
        <div class="form-errors">
        <?php foreach($_SESSION['login_errors'] as $error): ?>
            <p class="login_errors"><?php echo $error ?></p>
        <?php endforeach; ?>
        </div>
       <!-- $_SESSION['errors']=null; -->
       <?php endif; ?>

        <input type="text" placeholder="Email" required name="email">
        <input type="password" placeholder="Password" required class="form" name="password">
        <br>
        <button type="submit" class="btn">Login</button>
        <div class="button">
            <a href="register.php">Create an account?</a><a href="forgot.php">Forgot password?</a>
        </div>
        <div class="social-login">
            <a href="your_facebook_oauth_url_here" class="btn-facebook">Login with Facebook</a>
            <a href="your_google_oauth_url_here" class="btn-google">Login with Google</a>
            <a href="your_google_oauth_url_here" class="btn-apple">Login with Apple</a>
          </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <?php require_once 'assets/footer.php'?>
  
  <!-- js for toggle menu -->
<script src="js/menu.js"></script>
</body>
</html>