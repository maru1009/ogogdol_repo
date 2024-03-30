<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/product_details.css">
</head>
<body>
  <?php require_once 'assets/header.php'?>
    <!-- Product form -->
    <div class="single-product">
      <img src="images/1.webp" alt="computer1">
      <div class="info">
          <h4>Air Force</h4>
          <h3></h3>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus, tempore!</p>
  
          <span>Тоо ширхэг: %d</span>
          <input type="number" id="quantity" value="1">
          <a href="cart.php" class="btn" onclick="addToCart()">Add to Cart</a>
      </div>
  </div>
    
    <!-- Footer -->
    <?php require_once 'assets/footer.php'?>
    
    <!-- js for toggle menu -->
    <script src="js/product.js"></script>
    <script src="js/menu.js"></script>
</body>
</html>