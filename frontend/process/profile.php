<?php
    require "conn.php";

    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
    } else {
        header('Location: login.php');
        exit();
    }
    
    // Prepare the SQL statement with a parameter placeholder
    $sql = "SELECT cus_first_name AS username, cus_last_name AS user, Cus_email AS email, Cus_pass AS password FROM customer WHERE Cus_ID = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind the parameter value
    $stmt->bind_param("i", $user_id);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last = $row["username"];
        $first = $row["user"];
        $email = $row["email"];
        $password = $row["password"];
    } else {
        echo "0 results";
    }
    
    // Close the statement
    $stmt->close();
    
?>