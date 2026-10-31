<?php
require_once('connection.php');
// Check if the form is submitted
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_SESSION['user_id'])){
	session_destroy();
    }
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    //include 'register2.php';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password for security
    $sql = "SELECT email FROM deletedusers WHERE email = ?";
    $stmt = sqlsrv_query($conn, $sql, array(&$email));
    if(!$stmt){
	die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if(!$row){
	// SQL query to insert data into the userinfo table
	$sql = "INSERT INTO userinfo (Username, Email, Address, Password, is_admin, num_posts, num_replies, num_solved, registered) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	// Prepare the statement and execute the query
	$params = array($username, $email, $address, $password, 0, 0, 0, 0, 0);
	$stmt = sqlsrv_prepare($conn, $sql, $params);
	// Check if the insertion was successful
	if ($stmt === false) {
	    die(print_r(sqlsrv_errors(), true));
	} else {
	    if(sqlsrv_execute($stmt)){
		$query = "SELECT TOP 1 * FROM userinfo ORDER BY id DESC";
		$result = sqlsrv_query($conn, $query);
		if ($result === false) {
		    die(print_r(sqlsrv_errors(), true));
		}
		$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
		$_SESSION['user_id']=$row['id'];
		print_r($_SESSION['user_id']);
	    } else {
		if ($result === false) {
		    die(print_r(sqlsrv_errors(), true));
		}
	    }
	}
	echo 'before posting/replying you need admin approval. for now you can view the forums';
	echo '<a href="../index.php">
	    <button>Back</button>
	</a>';
    } else {
	echo 'your email is in blocked list, contact support@gowinsemi.com for further questions';
    }
    sqlsrv_free_stmt($stmt);
}
// Close the database connection
sqlsrv_close($conn);
?>

