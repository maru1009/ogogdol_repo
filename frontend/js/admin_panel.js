// zurag haruulah zorilgotoi
document.getElementById("image").addEventListener("change", function() {
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById("preview").src = e.target.result;
        document.getElementById("preview").style.display = "block";
    };
    reader.readAsDataURL(this.files[0]);
});


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


document.getElementById('show-name').addEventListener('change', function() {
    document.getElementById('name-section').style.display = this.checked ? 'block' : 'none';
});

document.getElementById('show-price').addEventListener('change', function() {
    document.getElementById('price-section').style.display = this.checked ? 'block' : 'none';
});


document.getElementById('show-quantity').addEventListener('change', function() {
    document.getElementById('quantity-section').style.display = this.checked ? 'block' : 'none';
});

document.getElementById('show-description').addEventListener('change', function() {
    document.getElementById('description-section').style.display = this.checked ? 'block' : 'none';
});

document.getElementById('show-image').addEventListener('change', function() {
    document.getElementById('image-section').style.display = this.checked ? 'block' : 'none';
});



function checkItem() {
    var modifyItemId = document.getElementById('modify-item-id').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../process/item_add.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response.trim() === 'found') {
                document.getElementById('hiddenFields').style.display = 'block';
                document.querySelector('#modifyForm [type="submit"]').style.display = 'block';
                document.querySelector('.check-button').style.display = 'none';
            } else {
                document.getElementById('hiddenFields').style.display = 'none';
                document.querySelector('#modifyForm [type="submit"]').style.display = 'none';
                alert('Item ID not found in the database.');
            }
        }
        
    };
    xhr.send('modify-item-id=' + modifyItemId);
}



