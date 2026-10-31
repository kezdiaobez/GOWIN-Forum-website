<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
include 'connection.php';
$sql = "SELECT registered FROM userinfo WHERE Username = ?";
$stmt = sqlsrv_query($conn, $sql, array($username));
if(!$stmt){
    die(print_r(sqlsrv_errors(), true));
}
if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $_SESSION['registered'] = $row['registered'];
}
?>
