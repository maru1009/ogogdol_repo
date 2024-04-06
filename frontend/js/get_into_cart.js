function addToCart() {
    const productName = visualViewport
    const quantityInput = document.getElementById('quantity');
    const quantity = parseInt(quantityInput.value) || 0;
    const remaining_ = document.querySelector('.info h2').textContent.replace(/\D/g, '');
    const remaining = parseInt(remaining_) || 0;
    const priceText = document.querySelector('.info h3').textContent;
    const price = parseFloat(priceText.replace(/[^0-9.]/g, ''));

    if (!isNaN(quantity) && quantity > 0 && remaining > quantity) {
        alert(`Adding ${quantity} ${productName}(s) to cart at ${price} each`);
        quantityInput.value = '';
    } else {
        alert('Invalid quantity. Please enter a valid number.');
    }
}
