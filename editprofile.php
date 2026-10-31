<?php
require_once('connection.php');
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
print_r($_POST);
$file_name = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$dest = '../../uploads/' . $file_name;
if(!empty($_FILES['file']['name'])){
    $username = $_POST['username'];
    echo $username;
    echo $dest;
    if(move_uploaded_file($tmp_name, $dest)){
	$sql = "UPDATE userinfo SET pic = ? WHERE Username = ?";
	$stmt = sqlsrv_prepare($conn, $sql, array(&$dest,&$username));
	if ($stmt === false) {
	    die(print_r(sqlsrv_errors(), true));
	}
	$result = sqlsrv_execute($stmt);
	if ($result === false) {
	    die(print_r(sqlsrv_errors(), true));
	}
    } else {
	echo 'could not move file';
    }
}elseif(!empty($_POST['username2'])) {
    $originalUsername = $_POST['username'];  // Assuming this value is passed somehow, e.g., from the session
    $newUsername = $_POST['username2'];
    echo 'notsupposed';
    // Update the username column
    $sql = "UPDATE userinfo SET Username = ? WHERE Username = ?";
    $params = array($newUsername, $originalUsername);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if( !$stmt ) {
        die( print_r(sqlsrv_errors(), true));
    }
}elseif (!empty($_POST['address2'])) {
    echo 'notsupposed2';
    echo $_POST['address2'];
    $originalAddress = $_POST['address'];  // Same as above, assuming original value is passed
    $newAddress = $_POST['address2'];

    // Update the address column
    $sql = "UPDATE userinfo SET Address = ? WHERE Address = ?";
    $params = array($newAddress, $originalAddress);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if( !$stmt ) {
        die( print_r(sqlsrv_errors(), true));
    }
}else{
    echo 'executed';
    $origUser = $_POST['username'];
    $newPassword = $_POST['password2'];
    $sql = "UPDATE userinfo SET Password = ? WHERE Username = ?";
    $password = password_hash($newPassword, PASSWORD_DEFAULT);
    $params = array($password, $origUser);
    $stmt = sqlsrv_prepare($conn, $sql, $params);
    if( !$stmt ) {
        die( print_r(sqlsrv_errors(), true));
    }else{
	if(!sqlsrv_execute($stmt)){
	    die( print_r(sqlsrv_errors(), true));	    
	}
    }
}
// If we reach here, the update was successful
echo "Update successful!";
header('Location: profile.php');
// Close the connection
sqlsrv_close($conn);
?>

