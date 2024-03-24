<?php
session_start();
include "conn.php";
include __DIR__ . "/../libs/validators.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{

    // validating firstname
    if(empty($_POST["uname"]))
    {
        header("Location: ../reg.php?error=First name is empty");
    }
    else{
        if(validate_name($_POST['uname']))
        {
        $uname=validate($_POST['uname']);
        }
        else{
            header("Location: ../reg.php?error=Not name type");
        }
    }

    // validating lastname
    if(empty($_POST["lname"]))
    {
        header("Location: ../reg.php?error=Last name is empty");
    }
    else{
        if(validate_name($_POST['lname']))
        {
        $lname=validate($_POST['lname']);
        }
        else{
            header("Location: ../reg.php?error=Not name type");
        }
    }

    // validating password
    if(empty($_POST["password"]))
    {
        header("Location: ../reg.php?error=Password is empty");
    }
    else{
        if(password_validate($_POST['password']))
        {
        $pass=validate($_POST['password']);
        }
        else{
            header("Location: ../reg.php?error=Not strong password");
        }
    }

    //validating email
    if(empty($_POST["email"]))
    {
        header("Location: ../reg.php?error=Email is empty");
    }
    else{
        if(validate_email($_POST['email']))
        {
        $email=validate($_POST['email']);
        }
        else{
            header("Location: ../reg.php?error=Is not email");
        }
    }

//  Query
    if (isset($uname) && isset($lname) && isset($pass) && isset($email)) {

            $user_check = "SELECT * FROM customer WHERE cus_email=?";
            $stmt_check = mysqli_prepare($conn, $user_check);
            
            if (!$stmt_check) {
                die('Error in preparing check statement: ' . mysqli_error($conn));
            }
            
            mysqli_stmt_bind_param($stmt_check, "s", $email); 
            mysqli_stmt_execute($stmt_check);
            $result = mysqli_stmt_get_result($stmt_check);
            // Checking if it is already registered
            if (mysqli_num_rows($result) > 0) {
                header("Location: reg.php?error=User already exists");
                exit();
            } else {
                
            
                $dynamic_salt = uniqid();
                $hashed_password = hash('sha256', $pass . $dynamic_salt);

                $sql = "INSERT INTO customer (cus_first_name, cus_last_name, cus_email, cus_pass, pass_salt) VALUES (?, ?, ?, ?, ?)";
                $stmt_insert = mysqli_prepare($conn, $sql);
                
                if (!$stmt_insert) {
                    die('Error in preparing insert statement: ' . mysqli_error($conn));
                }
                
                mysqli_stmt_bind_param($stmt_insert, "sssss", $uname, $lname, $email, $hashed_password, $dynamic_salt); 
            
                if (mysqli_stmt_execute($stmt_insert)) {
                    $_SESSION['username'] = $uname;
                    header('location: ../login.php');
                    exit();
                } else {
                    header("Location: reg.php?error=Error executing SQL query");
                    exit();
                }
            }
        }
    } 
    
else 
{
    header("Location: reg.php?error=Invalid request");
     exit();
}

?>
