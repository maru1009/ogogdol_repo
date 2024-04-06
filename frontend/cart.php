<!-- cart.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/cart.css">
    <!-- Pass the user ID to the data-userid attribute -->
    <div id="user-id" data-userid="<?php echo $_SESSION['id']; ?>"></div>
</head>
<body>
    <?php require_once 'assets/header.php'?>
    <div id="message"></div>
    <div class="cart">
    <h1>Сагс</h1>
    <div id="cart-items">
        <?php
        $totalPrice = 0; // Initialize total price variable
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $index => $cartItem) {
                echo '<div class="cart-item">';
                echo '<p>Нэр: ' . $cartItem['name'] . '</p>';
                echo '<p>Үнэ: ' . $cartItem['price'] . '</p>';
                echo '<p>Тоо ширхэг: ' . $cartItem['quantity'] . '</p>';
                echo '<button class="remove-btn" onclick="removeFromCart(\'' . $cartItem['name'] . '\')">Устгах</button>';
                echo '</div>';

                // Add the item price to the total price
                $totalPrice += $cartItem['price'] * $cartItem['quantity'];
            }
        } else {
            echo '<p>Одоогоор сагсанд бүтээгдэхүүн алга байна.</p>';
        }
        ?>
    </div>
    <div class="total">
            <p>Нийт: <span id="total-price"><?php echo number_format($totalPrice, 2) . "₮"; ?></span></p>
            <button class="checkout-btn">Захиалах</button>
        </div>
    </div>


    <?php require_once 'assets/footer.php'?>

    <script src="js/menu.js"></script>
    <script src="js/cart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
