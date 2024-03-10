function addToCart() {
    const productName = "Бүтээгдэхүүний нэр";
    const productPrice = 10.00; // Set the price of the product
    const size = document.getElementById('size').value;
    const quantity = document.getElementById('quantity').value;

    const product = {
        name: productName,
        price: productPrice,
        size: size,
        quantity: quantity
    };

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(product);
    localStorage.setItem('cart', JSON.stringify(cart));
}