<?php

require "conn.php";
//add item


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $prod_name = $_POST['name'];
    $prod_description = $_POST['description'];
    // $prod_size = $_POST['size'];
    $prod_quantity = $_POST['quantity'];
    $prod_cost = $_POST['price'];

    // Insert data into database
    $sql = "INSERT INTO product (Prod_Name, Prod_description, Prod_quan, Prod_Cost)
            VALUES ('$prod_name', '$prod_description', $prod_quantity, $prod_cost)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "buruu utga";  
    }
}




// remove item




// //modify item
// $item_id = $_POST['item_id'];

// $sql = "SELECT * FROM product WHERE Prod_ID = $item_id";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     echo json_encode(array("exists" => true));
// } else {
//     echo json_encode(array("exists" => false));
// }

// $conn->close();

// ?> 