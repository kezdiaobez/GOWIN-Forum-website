<?php
include 'connection.php';
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
$sql = "SELECT Username, Email FROM userinfo WHERE registered = 0";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die("Query failed.");
}
$emails = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $email = $row['Email'];
    $emails[] = $email;
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
    echo "<td>" . htmlspecialchars($email) . "</td>";
    echo "<td>";
    echo "<form onsubmit='deleteUser(event, \"" . addslashes($email) . "\")'>
            <button type='submit'>Delete</button>
        </form>";
    echo "</td>";
    echo "</tr>";
}
// Echo Approve All button inside its own row
if (count($emails) > 0) {
    echo "<tr><td colspan='3' style='text-align:center;'>";
    echo "<form onsubmit='approveAll(event, " . json_encode($emails) . ")'>
            <button type='submit'>Approve All</button>
        </form>";
    echo "</td></tr>";
}
?>
