<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
session_start();
require_once('connection.php');
if(isset($username)){
    $sql = "SELECT Email FROM userinfo WHERE Username = ?";
    $params = array(&$username);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if(!$stmt){
	die(print_r(sqlsrv_errors(), true));
    }
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $email = $row['Email'];
    }
    sqlsrv_free_stmt($stmt);
}
?>

