<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
<?php require_once 'assets/header.php'?>
  
  
  <div class="cart">
    <h1>Сагс</h1>
    <div id="cart-items"></div>
    <div class="total">
        <p>Total: <span id="total-price">0.00</span></p>
        <button class="checkout-btn">Захиалах</button>
    </div>
</div>

  <!-- Footer -->
  <?php require_once 'assets/footer.php'?>
  
  <!-- js for toggle menu -->
<script src="js/menu.js"></script>
<script src="js/cart.js"></script>
</body>
</html>