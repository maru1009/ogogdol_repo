<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <?php require_once 'assets/header.php'?>
  <!-- Featured products -->
  <div class="small-container">
    <h2 class="title">Онцлох бүтээгдэхүүн</h2>
    <div class="row">
        <?php
        require_once "process/get_items.php";

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

    <h2 class="title">Сүүлийн үеийн загвар</h2>
    <div class="row">
        <?php
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-3">';
            echo '<a href="product_details.php?id=' . $row["Prod_ID"] . '">';
            echo '<img src="images/' . $row["Prod_img"] . '" alt="' . $row["Prod_Name"] . '" >';
            echo '<h4>' . $row["Prod_Name"] . '</h4>';
            echo '<h4 class="cost">' . $row["Prod_Cost"] .'₮'. '</h4>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>
  </div>

 <?php require_once 'assets/footer.php' ?>
  
  <!-- js for toggle menu -->
<script src="js/menu.js"></script>
</body>
</html>