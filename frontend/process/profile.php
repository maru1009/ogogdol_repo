<?php
    require "conn.php";

    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
    } else {
        header('Location: login.php');
        exit();
    }
    $sql = "SELECT cus_first_name AS username, cus_last_name AS user, Cus_email AS email, Cus_pass AS password FROM customer WHERE Cus_ID = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last = $row["username"];
    $first = $row["user"];
    $email = $row["email"];
    $password = $row["password"];
    } else {
    echo "0 results";
    }
?>