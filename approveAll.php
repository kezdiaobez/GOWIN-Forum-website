<?php
include 'connection.php';
$emails = $_POST['emails'];
foreach($emails as $email){
    $sql = "UPDATE userinfo SET registered = 1 WHERE Email = ?";
    $stmt = sqlsrv_query($conn, $sql, array(&$email));
    if(!$stmt){
	die(print_r(sqlsrv_errors(), true));
    }
}
sqlsrv_close($conn);
?>
