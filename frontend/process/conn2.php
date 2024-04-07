<?php

$host = "localhost:3306";
$dbname = "ecommerce";
$username = "root";
$password = "G@nb0617";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;