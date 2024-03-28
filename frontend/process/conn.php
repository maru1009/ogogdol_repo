<?php
$servername="localhost:3306";
$username = "root";
$password= "G@nb0617";
$database= "ecommerce";
$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die('Connection failed:' . mysqli_connect_error());
}

echo"Connected"
?>