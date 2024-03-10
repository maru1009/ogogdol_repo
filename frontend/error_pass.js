document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('registerForm').addEventListener('submit', function(event) {
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('confirmPassword').value;
      if (password !== confirmPassword) {
        document.getElementById('password').style.borderColor = 'red';
        document.getElementById('confirmPassword').style.borderColor = 'red';
        event.preventDefault(); 
      } else {
        document.getElementById('password').style.borderColor = '';
        document.getElementById('confirmPassword').style.borderColor = '';
      }
    });
  });