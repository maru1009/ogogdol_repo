function validateForm() {
    var emailInput = document.querySelector('.email-input');
    var email = emailInput.value.trim();

  
    var emailRegex = /^[a-z0-9!#$%&'*+\/=?^{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_{|}~-]+)@(?:[a-z0-9](?:[a-z0-9-][a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;

    if (!emailRegex.test(email)) {
        emailInput.style.borderColor = "red";
        return false;
    } else {
        emailInput.style.borderColor = "";
        return true;
    }
}
