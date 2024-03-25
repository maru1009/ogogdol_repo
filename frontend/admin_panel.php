<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add item</title>
    <link rel="stylesheet" href="css/admin_panel.css">
</head>
<body>
<?php require_once 'assets/header.php'?>
    <div class="container-add">
        <!-- button section--> 
        <div class="button-container">
            <button class="admin-button" onclick="showAddSection()">Add item</button>
            <button class="admin-button" onclick="showDeleteSection()">Delete Item</button>
            <button class="admin-button" onclick="showModifySection()">Modify Item</button>
        </div>
        <!-- option -->
        <div class="options">
            <!-- add section--> 
            <div id="addSection" class="hidden">
                <div class="box1">
                    <h2>Add item</h2>
                    <form method="POST" enctype="multipart/form-data">
                    <label for="add-id">Item ID:</label>
                    <input type="number" id="add-id" name="add-id" required><br><br>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required><br><br>
                    <label for="size">Size:</label>
                    <select id="size" name="size" onchange="showQuantityInput()">
                        <option>Select Size</option>
                        <option>XXS</option>
                        <option>XS</option>
                        <option>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                        <option>XXL</option>
                    </select><br><br>
                    <div id="quantityInput" style="display: none;">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" required onchange="updateQuantity()">
                    </div>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
                    <label for="image">Image:</label>
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
                    <label for="remove-id">Item ID:</label>
                    <input type="number" id="remove-id" name="remove-id" required><br><br>
                        <input type="submit" value="Remove Item">
                    </form>
                </div>
            </div>
            <!-- Modify section-->
            <div id="modifySection" class="hidden">
                <div class="box3">
                    <h2>Modify item</h2>
                    <form method="POST" enctype="multipart/form-data">
                    <label for="modify-item-id">Item ID:</label>
                    <input type="number" id="modify-item-id" name="modify-item-id" required><br><br>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required><br><br>
                    <label for="size">Size:</label>
                    <select id="size-mod" name="size" onchange="showQuantityInputMod()">
                        <option>Select Size</option>
                        <option>XXS</option>
                        <option>XS</option>
                        <option>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                        <option>XXL</option>
                    </select><br><br>
                    <div id="quantityInputMod" style="display: none;">
                        <label for="quantityMod">Quantity:</label>
                        <input type="number" id="quantityMod" name="quantity" required onchange="updateQuantityMod()">
                    </div>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required><br><br>
                    <img id="preview" src="#" alt="Image preview" style="display: none; max-width: 200px;"><br><br>
                    <input type="submit" value="Өөрчлөх">
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