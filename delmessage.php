<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connection3.php');
$title = $_GET['title'];
$sql = "DELETE FROM updates WHERE title = ?";
$stmt = sqlsrv_query($conn3, $sql, array($title));
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Rows deleted successfully!";
}
sqlsrv_close($conn3);
header('Location: http://192.168.81.200/index.html/forum/whatsnew.php');
?>
