<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
  <?php require_once 'assets/header.php'?>

  <!-- all product page-->
  <div class="small-container">
    <div class="row-2">
      <h2>All Products</h2>
    </div>
    <div class="row">
      <?php require_once "process/get_items.php";
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-3">';
            echo '<a href="product_details.php?id=' . $row["Prod_ID"] . '">';
            echo '<img src="images/' . $row["Prod_img"] . '" alt="' . $row["Prod_Name"] . '" >';
            echo '<h4>' . $row["Prod_Name"] . '</h4>';
            echo '<h4 class="cost">' . $row["Prod_Cost"] .'₮'. '</h4>';
            echo '</a>';
            echo '</div>';
        }
        $result->data_seek(0);
        ?>  
    </div>
  
    <div class="page-btn">
      <span>1</span>
      <span>2</span>
      <span>3</span>
      <span>4</span>
      <span>&#8594;</span>
    </div>
  </div>

  <!-- Footer -->
  <?php require_once 'assets/footer.php ' ?>
  
  <!-- js for toggle menu -->
<script src="js/menu.js"></script>
</body>
</html>