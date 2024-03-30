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
  <!-- Password recovery form -->
  <div class="account-page">
    <div class="form-container">
      <form id="ForgotPorm" action="process/forgot_pro.php" method="POST" onsubmit="return validateForm()">
        <h2>Email-ээ оруулна уу.</h2>
        <input type="text" placeholder="Email" required name="email" class="email-input">
        <div class="button">
            <a href="javascript:history.back()">Back</a>
            <button type="submit" class="btn">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <?php require_once 'assets/footer.php'?>
  
  <!-- js for toggle menu -->
<script src="js/menu.js"></script>
<script src="js/valid_email.js"></script>
</body>
</html>