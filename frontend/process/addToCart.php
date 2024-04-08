<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantity'];
    $productRemainingQuantity = $_POST['remainingQuantity'];

    $totalQuantity = $productQuantity;
    foreach ($_SESSION['cart'] as $item) {
        if ($item['name'] === $productName) {
            $totalQuantity += $item['quantity'];
            break;
        }
    }

    if ($totalQuantity > $productRemainingQuantity) {
        http_response_code(400);
        exit;
    }

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

} else {
    http_response_code(405);
}
?>
