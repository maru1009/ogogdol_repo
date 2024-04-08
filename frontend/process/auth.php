<?php

require "conn.php";

function register_user(string $username, string $password, string $email)
{
    global $conn; 

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO customer (Cus_Name, Cus_email, Cus_pass) 
            VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: reg.php?error=sql_error");
        exit();
    }

    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: /login.php');
        exit();
    } else {
        header("Location: reg.php?error=error");
        exit();
    }

    // Close statement
    // mysqli_stmt_close($stmt);
}

?>
