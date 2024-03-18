<?php

require "conn.php";

function register_user(string $username, string $password, string $email)
{
    global $conn; 

    $sql = "INSERT INTO customer (Cus_Name, Cus_email, Cus_pass) 
            VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header('location: /login.php');
        exit();
    } else {
        header("Location: reg.php?error=error");
        exit();
    }
}

?>
