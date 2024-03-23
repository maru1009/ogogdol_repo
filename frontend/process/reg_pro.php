<?php
session_start();
include "conn.php";

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['email'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $lname = validate($_POST["lname"]); // corrected variable name
    $pass = validate($_POST['password']);
    $email = validate($_POST['email']);

    if (empty($uname) || empty($pass) || empty($email)) {
        header("Location: reg.php?error=Username, password, or email is empty");
        exit();
    } else {
        
        $user_check = "SELECT * FROM customer WHERE cus_email=?";
        $stmt_check = mysqli_prepare($conn, $user_check);
        
        if (!$stmt_check) {
            die('Error in preparing check statement: ' . mysqli_error($conn));
        }
        
        mysqli_stmt_bind_param($stmt_check, "s", $email); // corrected parameter
        mysqli_stmt_execute($stmt_check);
        $result = mysqli_stmt_get_result($stmt_check);
        
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
} else {
    header("Location: reg.php?error=Invalid request");
    exit();
}
?>
