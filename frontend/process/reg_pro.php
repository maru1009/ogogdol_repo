
<!-- To append errors to the $_SESSION['errors'] array, you can modify your code as follows:

php
Copy code -->
<?php
session_start();
include "conn.php";
include __DIR__ . "/../libs/validators.php";

// Initialize errors array
$_SESSION['errors'] = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validating firstname
    if (empty($_POST["uname"])) {
        $_SESSION['errors'][] = "First name is empty";
    } else {
        if (!validate_name($_POST['uname'])) {
            $_SESSION['errors'][] = "First name is not valid";
        }
    }

    // validating lastname
    if (empty($_POST["lname"])) {
        $_SESSION['errors'][] = "Last name is empty";
    } else {
        if (!validate_name($_POST['lname'])) {
            $_SESSION['errors'][] = "Last name is not valid";
        }
    }

    // validating password
    if (empty($_POST["password"])) {
        $_SESSION['errors'][] = "Password is empty";
    } else {
        if (!password_validate($_POST['password'])) {
            $_SESSION['errors'][] = "Password is not strong";
        }
    }

    //validating email
    if (empty($_POST["email"])) {
        $_SESSION['errors'][] = "Email is empty";
    } else {
        if (!validate_email($_POST['email'])) {
            $_SESSION['errors'][] = "Email is not valid";
        }
    }

    // If there are errors, redirect back to register.php with error messages
    if (!empty($_SESSION['errors'])) {
        header("Location: ../register.php");
        exit();
    }

    // If no errors, proceed with registration
    $uname = validate($_POST['uname']);
    $lname = validate($_POST['lname']);
    $pass = validate($_POST['password']);
    $email = validate($_POST['email']);

    // If no errors, proceed with registration
    $uname = validate($_POST['uname']);
    $lname = validate($_POST['lname']);
    $pass = validate($_POST['password']);
    $email = validate($_POST['email']);

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
                // header("Location: ../register.php?error=User already exists");
                $_SESSION['errors'][] = "Email is not valid";
                if (!empty($_SESSION['errors'])) {
                    header("Location: ../register.php");
                    exit();
                }
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
                    header("Location: register.php?error=Error executing SQL query");
                    exit();
                }
            }
        }
    } 
    
else 
{
    header("Location: register.php?error=Invalid request");
     exit();
}

?>
