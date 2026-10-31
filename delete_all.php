<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['action']) && $_POST['action'] == 'execute_code') {
    require_once('connection2.php');
    $user = $_POST['user'];
    $username = $user;
    include 'finduser3.php';
    if(isset($_POST['category'])){
	$sql = "DELETE FROM posts WHERE username = ?";
	$stmt = sqlsrv_query($conn2, $sql, array($user));
    } else {
        $sql = "DELETE FROM posts WHERE username = ? AND title = ? AND replies IS NOT NULL";
	$stmt = sqlsrv_query($conn2, $sql, array($user, $_POST['title']));
    }
    if ($stmt === false) {
	die(print_r(sqlsrv_errors(), true));
    } else {
	echo "everything deleted successfully!";
    }
    sqlsrv_close($conn2);
    require_once('connection.php');
    $sql = "DELETE FROM userinfo WHERE Username = ?";
    $stmt = sqlsrv_query($conn, $sql, array($user));
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "user deleted successfully!";
    }
    $sql = "INSERT INTO deletedusers (email) VALUES (?)";
    $stmt2 = sqlsrv_query($conn, $sql, array($email));
    if(!$stmt2){
	die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_close($conn);
    echo "<script type='text/javascript'>
	window.onload = function() {
	    document.getElementById('form').submit();
	};
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<form action="" method="post">
    <input type="hidden" name="action" value="execute_code">
    <input type="hidden" name="user" value="<?php echo htmlspecialchars($_POST['user']);?>">
    <?php if(isset($_POST['title'])): ?>
	<input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST['title']);?>">
	<button type="submit">DELETE USER AND RELATED REPLIES IN POST</button>
    <?php else:?>
	<input type="hidden" name="category" value="<?php echo htmlspecialchars($_POST['category']);?>">
	<button type="submit">DELETE USER AND RELATED POSTS AND REPLIES</button>
    <?php endif; ?>

</form>
<?php if(isset($_POST['title'])): ?>
    <form action="content.php" method="POST" class="category-button" id="form">
	<input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST['title']);?>">
    </form>
<?php else:?>
    <form action="forum.php" method="get" class="category-button" id="form">
	<input type="hidden" name="category" value="<?php echo htmlspecialchars($_POST['category']);?>">
    </form>
<?php endif; ?>
</body>
</html>
