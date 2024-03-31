<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/product_details.css">
</head>
<body>
  <?php require_once 'assets/header.php'?>
  <?php
    require_once "process/get_items.php";
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        while ($row = $result->fetch_assoc()) {
            if ($row["Prod_ID"] == $product_id) {
                $prod_name = $row["Prod_Name"];
                $prod_description = $row["Prod_description"];
                $prod_quantity = $row["Prod_quan"];
                $prod_cost = $row["Prod_Cost"];
                $prod_img = $row["Prod_img"];
                break;
            }
        }

        if (!isset($prod_name)) {
            echo "Product not found.";
            exit();
        }
    } else {
        echo "Product ID not provided.";
        exit();
    }
  ?>
    <!-- Product form -->
    <div class="single-product">
    <img src="images/<?php echo $prod_img; ?>" alt="<?php echo $prod_name; ?>">
    <div class="info">
        <h4><?php echo $prod_name; ?></h4>
        <h3><?php echo $prod_cost . "₮" ; ?></h3>
        <p><?php echo $prod_description; ?></p>
        <span>Захиалах</span>
        <input type="number" id="quantity" placeholder="Тоо ширхэг"><br>
        <button class="btn" onclick="addToCart()">Сагсанд нэмэх</button>
    </div>
</div>
    
    <!-- Footer -->
    <?php require_once 'assets/footer.php'?>
    
    <!-- js for toggle menu -->
    <script src="js/product.js"></script>
    <script src="js/menu.js"></script>
</body>
</html>