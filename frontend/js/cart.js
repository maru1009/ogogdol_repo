const cartItems = document.getElementById('cart-items');
const totalSpan = document.getElementById('total-price');
let total = 0;

function addToCart(productName, productPrice) {
    const productDiv = document.createElement('div');
    productDiv.classList.add('product');

    const productDetails = document.createElement('div');
    productDetails.classList.add('product-details');

    const name = document.createElement('p');
    name.classList.add('product-name');
    name.textContent = productName;

    const price = document.createElement('p');
    price.classList.add('product-price');
    price.textContent = productPrice;

    const quantity = document.createElement('p');
    quantity.classList.add('quantity');
    quantity.innerHTML = `Quantity: <input type="number" value="1" min="1">`;

    const removeBtn = document.createElement('button');
    removeBtn.classList.add('remove-btn');
    removeBtn.textContent = 'Remove';
    removeBtn.addEventListener('click', () => {
        total -= parseFloat(productPrice);
        totalSpan.textContent = total.toFixed(2);
        productDiv.remove();
    });

    productDetails.appendChild(name);
    productDetails.appendChild(price);
    productDetails.appendChild(quantity);
    productDetails.appendChild(removeBtn);

    productDiv.appendChild(productDetails);
    cartItems.appendChild(productDiv);

    total += parseFloat(productPrice);
    totalSpan.textContent = total.toFixed(2);
}

addToCart('Product Name 1', '10.00');
addToCart('Product Name 2', '20.00');