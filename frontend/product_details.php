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
    <div id="message"></div>
    <div class="single-product">
        <img src="images/<?php echo $prod_img; ?>" alt="<?php echo $prod_name; ?>">
        <div class="info">
        <h4><?php echo $prod_name; ?></h4>
        <h3><?php echo $prod_cost . "₮" ; ?></h3>
        <p><?php echo $prod_description; ?></p>
        <h2><?php echo "Үлдэгдэл: " .  $prod_quantity; ?></h2>
        <?php  
            if(isset($_SESSION['id'])) {
            ?>
            <span>Захиалах: </span>
            <input type="number" id="quantity" value="1"><br>
            <button class="btn" onclick="addToCart()">Сагсанд нэмэх</button>
            <?php
            }
        ?>
        </div>
    </div>
    <?php require_once 'assets/footer.php'?>
    <script src="js/menu.js"></script>
    <script src="js/cart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
