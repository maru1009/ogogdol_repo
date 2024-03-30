<?php
require "conn.php";

function uploadFile($target_dir) {
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

    // check file exists
    if (file_exists($target_dir . basename($_FILES["image"]["name"]))) {
        return "Sorry, file already exists.";
    }

    // check file size
    if ($_FILES["image"]["size"] > 500000) {
        return "Sorry, your file is too large.";
    }

    // validate picture
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // okay or not 
    if ($uploadOk == 0) {
        return "Sorry, your file was not uploaded.";
    // upload if it is ok
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . basename($_FILES["image"]["name"]))) {
            return "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }
}

function insertProduct($conn, $prod_name, $prod_description, $prod_quantity, $prod_cost) {
    $sql = "INSERT INTO product (Prod_Name, Prod_description, Prod_quan, Prod_Cost)
            VALUES ('$prod_name', '$prod_description', $prod_quantity, $prod_cost)";
    if ($conn->query($sql) === TRUE) {
        return "Бүтээгдэхүүн амжилттай нэмэгдлээ.";
    } else {
        return "Алдаа гарлаа.";
    }
}

function removeItem($conn, $remove_id) {
    $sql = "DELETE FROM product WHERE Prod_ID = $remove_id";
    $a = "ALTER TABLE product AUTO_INCREMENT = 1";
    if ($conn->query($sql) === TRUE) {
        return "Бүтээгдэхүүн амжилттай хасагдлаа.";
    } else {
        return "$remove_id ID-тай бүтээгдэхүүн алга байна.";
    }
}

function checkID($conn, $modify_id){ 
    $sql = "SELECT * FROM product WHERE prod_id = $modify_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function modifyProduct($conn, $prod_id, $prod_name, $prod_description, $prod_quantity, $prod_cost) {
    $sql = "UPDATE product SET prod_name='$prod_name', prod_description='$prod_description', prod_quan='$prod_quantity', prod_cost='$prod_cost' WHERE prod_id='$prod_id'";
    if ($conn->query($sql) === TRUE) {
        return "Бүтээгдэхүүн амжилттай шинэчилэгдлээ.";
    } else {
        return "Алдаа гарлаа.";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])){
        $prod_name = $_POST['name'];
        $prod_description = $_POST['description'];
        $prod_quantity = $_POST['quantity'];
        $prod_cost = $_POST['price'];
        $target_dir = "images/"; 

        $upload_message = uploadFile($target_dir);
        $_SESSION['upload_message'] = $upload_message;

        if (strpos($upload_message, "uploaded") !== false) {
            $message = insertProduct($conn, $prod_name, $prod_description, $prod_quantity, $prod_cost);
            $_SESSION['message'] = $message;
        }
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }else if (isset($_POST['remove-id'])){ 
        $remove_id = $_POST['remove-id'];
        $message = removeItem($conn, $remove_id);
        $_SESSION['message'] = $message;
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }else if (isset($_POST['modify-item-id'])) {
        $modify_id = $_POST['modify-item-id'];
        $result = checkID($conn, $modify_id);
        if ($result) {
            echo 'found';
        } else {
            echo 'not_found';
        }
    }
    if (isset($_POST['modify-item-id']) && isset($_POST['nameM']) && isset($_POST['descriptionM']) && isset($_POST['quantityM']) && isset($_POST['priceM'])) {
        $modify_id = $_POST['modify-item-id'];
        $prod_name = $_POST['nameM'];
        $prod_description = $_POST['descriptionM'];
        $prod_quantity = $_POST['quantityM'];
        $prod_cost = $_POST['priceM'];
        
        $message = modifyProduct($conn, $modify_id, $prod_name, $prod_description, $prod_quantity, $prod_cost);
        $_SESSION['message'] = $message;
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}



?> 



