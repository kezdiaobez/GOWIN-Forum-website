<?php
include 'connection2.php';
$title = $_POST['title'];
$sql = "UPDATE posts SET clicks = clicks+1 WHERE title = ?";
$params = array($title);
$stmt = sqlsrv_query($conn2, $sql, $params);
if(!$stmt){
    die(print_r(sqlsrv_errors(), true));
}
sqlsrv_close($conn2);
?>
