<?php
require "conn.php";


$sql = "SELECT * FROM product";
$result = $conn->query($sql);
if (!$result) {
    die('Error executing query: ' . $conn->error);
}
$conn->close();
return $result;
?>
