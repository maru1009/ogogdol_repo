<?php
require "conn.php";


$sql = "SELECT Cus_ID, cus_first_name,cus_last_name, Cus_email, admin FROM customer";
$result = $conn->query($sql);
if (!$result) {
    die('Error executing query: ' . $conn->error);
}
$conn->close();
return $result;
?>
