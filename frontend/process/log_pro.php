<?php
session_start();
include "conn.php";
include __DIR__ . "/../libs/validators.php";

if (isset($_POST['email'], $_POST['password'])) {
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if (empty($email) || empty($pass)) {
        redirectToLoginPage("Email or password is empty");
    }

    $user_check = "SELECT * FROM customer WHERE Cus_email=?";
    $stmt_check = mysqli_prepare($conn, $user_check);

    if (!$stmt_check) {
        die('Error in preparing check statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt_check, "s", $email);
    mysqli_stmt_execute($stmt_check);
    $result = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['Cus_pass'];
        $salt = $row['pass_salt'];
        $hashed_input_password = hash('sha256', $pass . $salt);

        // helpmepls($hashed_password,$hashed_input_password);

        
        if ($hashed_password === $hashed_input_password) {
            $_SESSION['id'] = $row["Cus_ID"];
            header('Location: ../index.php');
            exit();
        } else {
            redirectToLoginPage("Incorrect password");
        }
    } else {
        redirectToLoginPage("User does not exist");
    }
} else {
    redirectToLoginPage("Invalid request");
}



function redirectToLoginPage($error)
{
    header("Location: login.php?error=$error");
    exit();
}



?>
