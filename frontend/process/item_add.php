<?php
require "conn.php";

function uploadFile($conn, $target_dir, $prod_id) {
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $new_filename = $prod_id . '_product.' . $imageFileType;

    // check file size
    if ($_FILES["image"]["size"] > 500000) {
        return "Sorry, your file is too large.";
    }

    // validate picture
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
        return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // okay or not 
    if ($uploadOk == 0) {
        return "Sorry, your file was not uploaded.";
    // upload if it is ok
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $new_filename)) {
            $sql = "UPDATE product SET prod_img=? WHERE prod_id=?";
            $stmt = mysqli_prepare($conn, $sql);

            if (!$stmt) {
                return "Error in preparing update statement: " . mysqli_error($conn);
            }

            mysqli_stmt_bind_param($stmt, "si", $new_filename, $prod_id);
            if (mysqli_stmt_execute($stmt)) {
                return "The file " . $new_filename . " has been uploaded and linked to the product.";
            } else {
                return "Error updating database: " . mysqli_error($conn);
            }
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
        return "Алдаа:" . mysqli_error($conn);
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
        return "Алдаа:" . mysqli_error($conn);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])){
        $prod_name = $_POST['name'];
        $prod_description = $_POST['description'];
        $prod_quantity = $_POST['quantity'];
        $prod_cost = $_POST['price'];
        $target_dir = "images/"; 
        $message = insertProduct($conn, $prod_name, $prod_description, $prod_quantity, $prod_cost);
        $prod_id = mysqli_insert_id($conn);
        $upload_message = uploadFile($conn, $target_dir, $prod_id);
        if (strpos($upload_message, "uploaded") === false) {
             $_SESSION['message'] = 'Зураг оруулахад алдаа гарлаа.';
        }else{
          
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



