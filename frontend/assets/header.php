<?php
session_start()
?>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  @font-face {
    font-family: "Tauri", sans-serif;
    src: url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Tauri&family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&display=swap');
  }


  body {
    font-family: "Tauri", sans-serif;
    font-weight: 400;
    font-style: normal;
  }
  
  a {
    text-decoration: none;
    color: #555;
  }
  
  p {
    color: #555;
  }
  
  
  /* Header starts*/
  .navbar {
    display: flex;
    align-items: center;
    padding: 20px;
    
  }
  
  nav {
    flex: 1;
    text-align: right;
  }
  
  nav ul {
    display: inline-block;
    list-style-type: none;
  }
  
  nav ul li {
    display: inline-block;
    margin-right: 20px;
  }
  
  .container {
    max-width: 1300px;
    margin: auto;
    padding-left: 25px;
    padding-right: 25px;
  }
  
  .header {
    background: #FBEEC1;
    width: 100%;
  }
  
  .logo span{ 
    font-size: 20px;
    color: black;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  }
  
  .menu-icon {
    width: 28px;
    margin-left: 20px;
    display: none;
  }
  
  #MenuItems {
    transition: max-height 0.2s ease-out;
    z-index: 1;
  
  }

  .row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: space-around;
  }
</style>

<div class="header">
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <a href="index.php"><span>AST</span></a>
        </div>
        <nav>
          <ul id="MenuItems">
            <li><a href="index.php">Home</a></li>
            <li><a href="product.php">Products</a></li>
              <?php 
              if(isset($_SESSION['id']))
              {
                echo "<li><a href='my_profile.php'>Profile</a></li>";
                echo "<li><a href='../process/logout.php'>Logout</a></li>";
              }
              else{
                echo"<li><a href='login.php'>Login</a></li>";
              }
            ?>
            <!-- <li><a href="#">Contact</a></li> -->
            <!-- <li><a href="login.php">Account</a></li> -->
          </ul>
        </nav>
        <a href="cart.php"><img src="https://i.ibb.co/PNjjx3y/cart.png" alt="" width="30px" height="30px"/></a>
        <img src="https://i.ibb.co/6XbqwjD/menu.png" alt=""  class="menu-icon" onclick="menutoggle()" />
      </div>
    </div>
</div>

