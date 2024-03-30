<?php
session_start();
include "conn.php";
include __DIR__ . "/../libs/validators.php";
include __DIR__ . "/../libs/helpers.php";


$_SESSION['forgot_errors']=array();
if(is_post_request())
{
     //validating email
     if (empty($_POST["email"])) 
     {
        $_SESSION['forgot_errors'][] = "Email is empty";
     } 
     else {
        if (!validate_email($_POST['email'])) 
        {
            $_SESSION['forgot_errors'][] = "Email is not valid";
        }
    }

    $email = validate($_POST['email']);

    // Query

    if (isset($email)) 
    {

        $user_check = "SELECT * FROM customer WHERE cus_email=?";
        $stmt_check = mysqli_prepare($conn, $user_check);
        
        if (!$stmt_check) 
        {
            die('Error in preparing check statement: ' . mysqli_error($conn));
        }
        
        mysqli_stmt_bind_param($stmt_check, "s", $email); 
        mysqli_stmt_execute($stmt_check);
        $result = mysqli_stmt_get_result($stmt_check);

        // Checking if it is already registered
        if (mysqli_num_rows($result) > 0) {
            // header("Location: ../register.php?error=User already exists");
            $_SESSION['errors'][] = "Email is not valid";
            if (!empty($_SESSION['forgot_errors'])) {
                // to-do : ene neg ymni haasha ywahig bodoh
                header("Location: ../register.php");
                exit();
            }
        }
        else{
            
        }
    }
}


?>
