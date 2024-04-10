<?php
session_start();
include "conn.php";
include __DIR__ . "/../libs/validators.php";

$_SESSION['login_errors']=array();

if ($_SERVER["REQUEST_METHOD"] === "POST")
{

      // validating email
      if (empty($_POST["email"])) {
        $_SESSION['login_errors'][] = "Email is empty";
    } else {
        if (!validate_email($_POST['email'])) {
            $_SESSION['login_errors'][] = "Email is not valid";
        }
    }
    // validating password
    if (empty($_POST["password"])) {
        $_SESSION['login_errors'][] = "Password is empty";
    } else {
        if (!password_validate($_POST['password'])) {
            $_SESSION['login_errors'][] = "Password is not strong";
        }
    }
    // IF there is any error it will redirect 2 login page
    if (!empty($_SESSION['login_errors'])) {
        header("Location: ../login.php");
        exit();
    }
    
    $pass = validate($_POST['password']);
    $email= validate($_POST['email']);

    if (isset($_POST['email'], $_POST['password'])) { 
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
                $_SESSION['login_errors'][] = "Incorrect password";
            }
        } else {
            $_SESSION['login_errors'][] = "User doesn't exist";
        }
    } else {
        redirectToLoginPage("Invalid request");
    }
    if (!empty($_SESSION['login_errors'])) {
        header("Location: ../login.php");
        exit();
    }
}

function redirectToLoginPage($error)
{
    header("Location: login.php?error=$error");
    exit();
}



?>
