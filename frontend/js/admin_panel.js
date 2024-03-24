// zurag haruulah zorilgotoi
document.getElementById("image").addEventListener("change", function() {
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById("preview").src = e.target.result;
        document.getElementById("preview").style.display = "block";
    };
    reader.readAsDataURL(this.files[0]);
});

var quantityInputs = {
    "XXS": 0,
    "XS": 0,
    "S": 0,
    "M": 0,
    "L": 0,
    "XL": 0,
    "XXL": 0
};

var quantityInputsMod = {
    "XXS": 0,
    "XS": 0,
    "S": 0,
    "M": 0,
    "L": 0,
    "XL": 0,
    "XXL": 0
};

// [add] size deer darahaar too ni garj irdeg
function showQuantityInput() {
    var sizeSelect = document.getElementById("size");
    var quantityInput = document.getElementById("quantityInput");
    var quantityField = document.getElementById("quantity");

    quantityField.value = quantityInputs[sizeSelect.value]; // Set quantity to the value associated with the selected size

    if (sizeSelect.value === "Select Size") {
        quantityInput.style.display = "none";
    } else {
        quantityInput.style.display = "block";
    }
}

function updateQuantity() {
    var sizeSelect = document.getElementById("size");
    var quantityField = document.getElementById("quantity");

    quantityInputs[sizeSelect.value] = parseInt(quantityField.value); // Update the quantity associated with the selected size
}



// [mod] size deer darahaar too ni garj irdeg
function showQuantityInputMod() {
    var sizeSelect = document.getElementById("size-mod");
    var quantityInput = document.getElementById("quantityInputMod");
    var quantityField = document.getElementById("quantityMod");

    quantityField.value = quantityInputsMod[sizeSelect.value]; // Set quantity to the value associated with the selected size

    if (sizeSelect.value === "Select Size") {
        quantityInput.style.display = "none";
    } else {
        quantityInput.style.display = "block";
    }
}

function updateQuantityMod() {
    var sizeSelect = document.getElementById("size-mod");
    var quantityField = document.getElementById("quantityMod");

    quantityInputsMod[sizeSelect.value] = parseInt(quantityField.value); // Update the quantity associated with the selected size
}




//buttom switching
function showAddSection() {
    document.getElementById('addSection').style.display = 'block';
    document.getElementById('removeSection').style.display = 'none';
    document.getElementById('modifySection').style.display = 'none';
}

function showDeleteSection() {
    document.getElementById('addSection').style.display = 'none';
    document.getElementById('removeSection').style.display = 'block';
    document.getElementById('modifySection').style.display = 'none';
}

function showModifySection() {
    document.getElementById('addSection').style.display = 'none';
    document.getElementById('removeSection').style.display = 'none';
    document.getElementById('modifySection').style.display = 'block';
}

showAddSection();
