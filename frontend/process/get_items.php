<?php
require "conn.php";


$sql = "SELECT * FROM product";
$result = $conn->query($sql);

$conn->close();
?>
