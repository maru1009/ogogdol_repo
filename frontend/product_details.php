<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="product_details.css">
</head>
<body>
  <?php require_once 'assets/header.php'?>
    <!-- Product form -->
    <div class="single-product">
      <img src="https://i.ibb.co/dWK8Fcw/computer1.png" alt="computer1">
      <div class="info">
          <h4>Бүтээгдэхүүний нэр</h4>
          <h3>Бүтээгдэхүүний талаарх мэдээлэл</h3>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus, tempore!</p>
          <h2>Размераа сонгоно уу</h2>
          <select id="size">
              <option>Select Size</option>
              <option>XXS</option>
              <option>XS</option>
              <option>S</option>
              <option>M</option>
              <option>L</option>
              <option>XL</option>
              <option>XXL</option>
          </select>
          <span>Тоо ширхэг: %d</span>
          <input type="number" id="quantity" value="1">
          <a href="cart.php" class="btn" onclick="addToCart()">Add to Cart</a>
          
      </div>
  </div>
    
    <!-- Footer -->
    <?php require_once 'assets/footer.php'?>
    
    <!-- js for toggle menu -->
    <script src="product.js"></script>
    <script src="menu.js"></script>
</body>
</html>