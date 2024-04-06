function addToCart() {
    var productName = document.querySelector('.info h4').innerText;
    var productPrice = parseFloat(document.querySelector('.info h3').innerText);
    var productQuantity = parseInt(document.getElementById('quantity').value);
    var productRemainingQuantity = parseInt(document.querySelector('.info h2').innerText.split(':')[1].trim());

    // Validate quantity
    if (isNaN(productQuantity) || productQuantity <= 0) {
        updateMessage('Тоо оруулна уу.', 'error');
        return;
    }

    // Validate remaining quantity
    if (productQuantity > productRemainingQuantity) {
        updateMessage('Үлдэгдэл бүтээгдэхүүнээс их байна.', 'error');
        return;
    }

    var cartItem = {
        name: productName,
        price: productPrice,
        quantity: productQuantity,
        remainingQuantity: productRemainingQuantity
    };

    $.ajax({
        type: 'POST',
        url: '../process/addToCart.php',
        data: cartItem,
        success: function() {
            updateMessage('Бараа амжилттай сагслагдлаа.', 'success');
        },
        error: function() {
            updateMessage('Бараа сагслахад алдаа гарлаа.', 'error');
        }
    });
}


function removeFromCart(productName) {
    $.ajax({
        type: 'POST',
        url: '../process/removeFromCart.php',
        data: { name: productName },
        success: function() {
            updateMessage('Бараа амжилттай хасагдлаа.', 'success', function() {
                $('#cart-items').find('.cart-item').each(function() {
                    if ($(this).find('p:first').text().trim() === productName) {
                        $(this).remove();
                    }
                });
               
            });
        },
        error: function() {
            updateMessage('Алдаа гарлаа', 'error');
        }
    });
    setTimeout(function() {
        location.reload();
    }, 5000);
}





function updateMessage(message, type) {
    var messageDiv = document.getElementById('message');
    messageDiv.innerHTML = message;
    messageDiv.classList.add(type);
    messageDiv.style.display = 'flex';

    // Remove the message after 3 seconds
    setTimeout(function() {
        messageDiv.innerHTML = '';
        messageDiv.classList.remove(type);
        messageDiv.style.display = 'none'; 
    }, 7000);
}

