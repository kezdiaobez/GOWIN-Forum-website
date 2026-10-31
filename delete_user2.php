<?php
include 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = sqlsrv_query($conn, "DELETE FROM userinfo WHERE Email = ?", [$email]);
    $sql = "INSERT INTO deletedusers (email) VALUES (?)";
    $stmt2 = sqlsrv_query($conn, $sql, array(&$email));
    if ($stmt === false || $stmt2 === false) {
        http_response_code(500);
    }
}
?>
