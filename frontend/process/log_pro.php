<?php
session_start();
include "conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: login.php?error=Username or password is empty");
        exit();
    } else {
        
        $user_check = "SELECT * FROM customer WHERE cus_name=?";
        $stmt_check = mysqli_prepare($conn, $user_check);
        
        if (!$stmt_check) {
            die('Error in preparing check statement: ' . mysqli_error($conn));
        }
        
        mysqli_stmt_bind_param($stmt_check, "s", $uname);
        mysqli_stmt_execute($stmt_check);
        $result = mysqli_stmt_get_result($stmt_check);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['cus_pass'];
            $static_salt = "Static salt is bad";
            $hashed_input_password = hash('sha256', $pass . $static_salt);
            
            if ($hashed_password === $hashed_input_password) {
                $_SESSION['username'] = $uname;
                header('location: index.php'); 
                exit();
            } else {
                header("Location: login.php?error=Incorrect password");
                exit();
            }
        } else {
            header("Location: login.php?error=User does not exist");
            exit();
        }
    }
} else {
    header("Location: login.php?error=Invalid request");
    exit();
}
?>
