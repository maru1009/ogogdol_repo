<?php
session_start();

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the cart item data from the POST data
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantity'];
    $productRemainingQuantity = $_POST['remainingQuantity'];
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $productName) {
            $item['quantity'] += $productQuantity;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $productQuantity,
            'remainingQuantity' => $productRemainingQuantity
        ];
    }

    echo 'Item added to cart successfully.';
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>
