<?php
$serverName = "192.168.0.10"; // SQL Server host
$connectionOptions = array(
    "Database" => "whatnew", // The name of your database
    "Uid" => "SA",      // Your database username
    "PWD" => "gowin@2014"       // Your database password
);

// Establishes the connection
$conn3 = sqlsrv_connect($serverName, $connectionOptions);

// Check if the connection is successful
if ($conn3 === false) {
    die(print_r(sqlsrv_errors(), true));
}
session_start();
?>

