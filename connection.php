<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$serverName = "192.168.0.10"; // SQL Server host
$connectionOptions = array(
    "Database" => "userbomb", // The name of your database
    "Uid" => "SA",      // Your database username
    "PWD" => "gowin@2014"       // Your database password
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check if the connection is successful
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
session_start();
?>

