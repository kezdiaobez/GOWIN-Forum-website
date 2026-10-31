<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

session_start();
require_once('connection2.php');
$title = $_POST['title'];
$sql = "UPDATE posts SET is_solved = ? WHERE title = ?";
$params = array(1, $title);
$stmt = sqlsrv_query($conn2, $sql, $params);
if($stmt == false){
    die(print_r(sqlsrv_errors()));
}
require_once('connection.php');
$username = $_POST['username'];
$sql = "UPDATE userinfo SET num_solved = num_solved+1 WHERE Username = ?";
$stmt = sqlsrv_query($conn,$sql, array(&$username));
if($stmt == false){
    die(print_r(sqlsrv_errors()));
}
sqlsrv_close($conn);
sqlsrv_close($conn2);
?>
<html>
<script type="text/javascript">
// Function to automatically submit the form
window.onload = function() {
    document.getElementById('form').submit();
};
</script>
<form action="content.php" method="POST" id="form">
    <input type="hidden" name="title" value="<?=htmlspecialchars($title)?>">
</form>
</html>



