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

    if (!empty($_SESSION['forgot_errors'])) {
      header("Location: ../forgot.php");
      exit();
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
        if (mysqli_num_rows($result) == 1 ) {
            
          $token= bin2hex(random_bytes(16));
          $token_hash= hash("sha256",$token);
          $expiry = date("Y-m-d H:i:s", time()+ 60 * 30);
        
          $sql = "UPDATE customer 
                  SET reset_token_hash=?, 
                      reset_token_expires_at=? 
                  WHERE cus_email=?";

      
          $stmt_check2=mysqli_prepare($conn,$sql);

          if (!$stmt_check2) 
          {
            die('Error in preparing check statement: ' . mysqli_error($conn));
          }

          mysqli_stmt_bind_param($stmt_check2,"sss",$token_hash,$expiry,$email);
          mysqli_stmt_execute($stmt_check2);
      
          $affected_row_num = mysqli_stmt_affected_rows($stmt_check2);

    
        //   $affected_row_num=mysqli_stmt_affected_rows($stmt_check2);
          if($affected_row_num>0)
          {
            $mailer = require  "mailer.php"; 
           
            $mail->setFrom("davkharbayr05@gmail.com");
            $mail->addAddress($email);
            $mail->Subject = "Password reset";
            $mail->Body = <<<END
            Click <a href="http://localhost:8083/reset-password2.php?token=$token"> here </a>
            to reset your password.
            END;
            $mail->send();
            echo"Message sent";
          }
        
          
        }

        // If user is not in db 
        else{

            $_SESSION['forgot_errors'][] = "Email is not registered";
            if (!empty($_SESSION['forgot_errors'])) {
                // to-do : ene neg ymni haasha ywahig bodoh
                header("Location: ../forgot.php");
                exit();
            }
        }
    }
}


?>
