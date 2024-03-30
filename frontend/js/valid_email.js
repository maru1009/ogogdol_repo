function validateForm() {
    var emailInput = document.querySelector('.email-input');
    var email = emailInput.value.trim();

  
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        emailInput.style.borderColor = "red";
        return false;
    } else {
        emailInput.style.borderColor = "";
        return true;
    }
}
