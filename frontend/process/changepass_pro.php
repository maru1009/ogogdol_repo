<?php
include "conn.php";
include "../libs/validators.php";
$token= $_POST['token'];

$_SESSION['change_errors']=array();
$token_hash = hash("sha256",$token);




if (empty($_POST["password"])) {
    $_SESSION['errors'][] = "Password is empty";
} else {
    if (!password_validate($_POST['password'])) {
        $_SESSION['change_errors'][] = "Password is not strong";
    }
}
$password=password_validate($_POST['password']);
$sql="SELECT * FROM customer
      WHERE reset_token_hash = ?";

$stmt_check=mysqli_prepare($conn,$sql);
if(!$stmt_check)
{
    die('Error in preparing check statement: ' . mysqli_error($conn));
  }

mysqli_stmt_bind_param($stmt_check,"s",$token_hash);
mysqli_stmt_execute($stmt_check);

$result = mysqli_stmt_get_result($stmt_check);
if(mysqli_num_rows($result)>0)
{
    $row = mysqli_fetch_assoc($result);
    if($row===null)
    {
        die("token not found");
    }
   if(strtotime($row["reset_token_expires_at"])<= time()) {
    die("token has expired");  
    }
    echo"token is valid and hasn't expired";
}
echo"row aa";
//this part is not working
    if (mysqli_num_rows($result) == 1) {
        echo"aa";
        $row = mysqli_fetch_assoc($result);
        if ($row === null) {
            die("No matching record found for the provided token");
        }
        
        // Ensure that required columns exist in the result set
        if (!isset($row['pass_salt']) || !isset($row['cus_id'])) {
            die("Required columns are missing in the result set");
        }
        
        $dynamic_salt = $row['pass_salt'];
        $email= $row['Cus_email'];
        
        $hashed_password = hash('sha256', $password . $dynamic_salt);
        $sql= "UPDATE customer
               SET cus_pass=?,
                    reset_token_hash=NULL,
                    reset_token_expires_at=NULL
                WHERE cus_email=?";
        $stmt_check2=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt_check2, "ss", $hashed_password,$email);
        if(mysqli_stmt_execute($stmt_check2))
        {
            header("Location: ../login.php");
            exit();
        }
        else{
            die("SQL execution failed");
        }
    }


?>
