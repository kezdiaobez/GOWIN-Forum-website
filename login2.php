<?php
session_start();
require_once('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // Check if the user exists
    $sql = "SELECT Password, id FROM userinfo WHERE Username = ?";
    $params = array($username);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    // Check if a matching user was found
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // Password comparison (ensure the password is hashed for security in production)
        if (password_verify($password, $row['Password'])) {
            echo "Login successful!";
	    $_SESSION['user_id'] = $row['id'];
	    header('Location: ../index.php');
            //print_r ($username );
        } else {
            echo "Incorrect password.";
	    header('Location: login.php');
        }
    } else {
        echo "Username does not exist.";
	header('Location: login.php');
    }
    // Close the statement
    sqlsrv_free_stmt($stmt);
}
// Close the connection
sqlsrv_close($conn);
?>

