<?php
session_start();
require 'process/conn.php'; 

$sql = 'SELECT Cus_ID FROM customer WHERE admin = 1'; 
$result = mysqli_query($conn, $sql);

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $admin_id = $row['Cus_ID'];
        
        if ($user_id != $admin_id) { 
            http_response_code(403);
            exit;
        }
    } else {
        // No admin found, handle this case
        http_response_code(403);
        exit;
    }
} else { 
    header('Location: login.php');
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add item</title>
    <link rel="stylesheet" href="css/admin_panel.css">
</head>
<body>
    <?php 
    require_once 'assets/header.php';
    require 'process/item_add.php';


    //log message
    if (isset($_SESSION['message'])) {
        echo '<div class="insert_message">' . $_SESSION['message'] . '</div><br>';
        unset($_SESSION['message']);
    }
    ?>
    <!-- box started -->
    <div class="container-add">
        <!-- button section--> 
        <div class="dropdown">
            <button class="admin-button dropdown-toggle" id="dropdownMenuButton">
                Сонголтууд
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
                <a onclick="showUsers()">Бүх хэрэглэгчдийг харах</a>
                <a onclick="showItems()">Бүх бүтээгдэхүүн харах</a>
                <a onclick="showAddSection()">Бүтээгдэхүүн нэмэх</a>
                <a onclick="showDeleteSection()">Бүтээгдэхүүн устгах</a>
                <a onclick="showModifySection()">Бүтээгдэхүүнд өөрчлөлт хийх</a>
            </div>
        </div>

            <!-- option -->
        <div class="options">
            <div id="userSection" class="hidden">
                <h1>Одоо байгаа хэрэглэгчид</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Хэрэглэгчийн ID</th>
                            <th>Овог</th>
                            <th>Нэр</th>
                            <th>Email</th>
                            <th>admin</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <?php
                        require_once 'process/get_users.php';
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["Cus_ID"] . "</td>";
                                echo "<td>" . $row["cus_first_name"] . "</td>";
                                echo "<td>" . $row["cus_last_name"] . "</td>";
                                echo "<td>" . $row["Cus_email"] . "</td>";
                                echo "<td>" . ($row["admin"] == 1 ? "Тийм" : "Үгүй") . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            $message = 'Одоогоор хэрэглэгч алга байна.';
                            $_SESSION['message'] = $message;
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <div id="itemsSection" class="hidden">
                <h1>Бүтээгдэхүүний жагсаалт</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Бүтээгдэхүүний ID</th>
                            <th>Бүтээгдэхүүний нэр</th>
                            <th>Бүтээгдэхүүний тайлбар</th>
                            <th>Бүтээгдэхүүний үнэ</th>
                            <th>Бүтээгдэхүүний тоо</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        <?php
                        require_once 'process/get_items.php';
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["Prod_ID"] . "</td>";
                                echo "<td>" . $row["Prod_Name"] . "</td>";
                                echo "<td>" . $row["Prod_description"] . "</td>";
                                echo "<td>" . $row["Prod_Cost"] . "</td>";
                                echo "<td>" . $row["Prod_quan"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            $message = 'Одоогоор бүтээгдэхүүн алга байна.';
                            $_SESSION['message'] = $message;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- add section--> 
            <div id="addSection" class="hidden">
                <div class="box1">
                    <h2>Бүтээгдэхүүн нэмэх</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <label for="name">Бүтээгдэхүүний нэр:</label>
                        <input type="text" id="name" name="name" required><br><br>
                        <label for="price">Бүтээгдэхүүний үнэ:</label>
                        <input type="number" id="price" name="price" required><br><br>
                        <label for="quantity">Тоо ширхэг:</label>
                        <input type="number" id="quantity" name="quantity" required onchange="updateQuantity()">
                        <label for="description">Тайлбар:</label>
                        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
                        <label for="image">Зураг:</label>
                        <input type="file" id="image" name="image" accept="image/*" required><br><br>
                        <img id="preview" src="#" alt="Image preview" style="display: none; max-width: 200px;"><br><br>
                        <input type="submit" value="Нэмэх">
                    </form>
                </div>
            </div>
            <!-- Remove section-->
            <div id="removeSection" class="hidden">
                <div class="box2">
                    <h2>Remove Item</h2>
                    <form method="POST">
                    <label for="remove-id">Бүтээгдэхүүний ID:</label>
                    <input type="number" id="remove-id" name="remove-id" required><br><br>
                        <input type="submit" value="Устгах">
                    </form>
                </div>
            </div>
            <!-- Modify section-->
            <div id="modifySection" class="hidden">
                <div class="box3">
                    <h2>Бүтээгдэхүүнд өөрчлөлт хийх</h2>
                    <form id="modifyForm" method="POST" enctype="multipart/form-data">
                        <label for="modify-item-id">Бүтээгдэхүүний ID:</label>
                        <input type="number" id="modify-item-id" name="modify-item-id" required><br><br>
                        <!-- hidden field -->
                        <div id="hiddenFields" style="display: none;">
                            <label for="nameM">Бүтээгдэхүүний нэр:</label>
                            <input type="text" id="nameM" name="nameM" required><br><br>
                            <label for="priceM">Бүтээгдэхүүний үнэ:</label>
                            <input type="number" id="priceM" name="priceM" required><br><br>
                            <label for="quantityM">Тоо ширхэг:</label>
                            <input type="number" id="quantityM" name="quantityM">
                            <label for="descriptionM">Тайлбар:</label>
                            <textarea id="descriptionM" name="descriptionM" rows="4" cols="50" required></textarea><br><br>
                        </div>
                        <input type="button" value="Шалгах" onclick="checkItem()" class="check-button">
                        <input type="submit" value="Өөрчлөх" style="display: none;">
                    </form>
                </div>
            </div>
    </div>
    </div>
    <!-- Footer -->
    <?php require_once 'assets/footer.php'?>
    <!-- js for toggle menu -->
    <script src="js/menu.js"></script>
    <script src="js/admin_panel.js"></script>
</body>
</html>