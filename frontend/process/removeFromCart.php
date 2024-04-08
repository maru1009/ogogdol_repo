<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productNameToRemove = $_POST['name'];

    echo 'Product name to remove: ' . $productNameToRemove;

    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['name'] === $productNameToRemove) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);

            // Debugging output
            echo 'Item removed from cart successfully.';
            echo 'Updated cart array: ';
            var_dump($_SESSION['cart']);

            exit;
        }
    }

    echo 'Item not found in cart.';
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>
