<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
require_once('connection.php');
if (!empty($_GET)) {
    $username = $_GET['username'];
    $location = $_GET['location'];
    if(isset($_GET['title'])){
	$title = $_GET['title'];
    }
    $sql = "SELECT Email, Address, num_posts, num_replies, num_solved FROM userinfo WHERE Username = ?";
    $params = array($username);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
	$address = $row['Address'];
	$num_posts = $row['num_posts'];
	$num_replies = $row['num_replies'];
	$num_solved = $row['num_solved'];
	if(isset($_GET['title'])){
            $title = $_GET['title'];
	    echo '
	    <form id="user" action="profile.php" method="POST">
	    <input type="hidden" name="location" value="'.htmlspecialchars($location).'">
	    <input type="hidden" name="username" value="'.htmlspecialchars($username).'">
	    <input type="hidden" name="address" value="'.htmlspecialchars($address).'">
	    <input type="hidden" name="title" value="'.htmlspecialchars($title).'">
	    <input type="hidden" name="num_posts" value="'.htmlspecialchars($num_posts).'">
	    <input type="hidden" name="num_replies" value="'.htmlspecialchars($num_replies).'">
	    <input type="hidden" name="num_solved" value="'.htmlspecialchars($num_solved).'">
	    </form>
	    ';
	    echo '
	    <script type="text/javascript">
	    window.onload = function() {
		    document.getElementById("user").submit();
		};
	    </script>';
	} else {
	    echo '
            <form id="user" action="profile.php" method="POST">
            <input type="hidden" name="location" value="'.$location.'">
            <input type="hidden" name="username" value="'.htmlspecialchars($username).'">
            <input type="hidden" name="address" value="'.htmlspecialchars($address).'">
            <input type="hidden" name="email" value="'.htmlspecialchars($email).'">
            <input type="hidden" name="num_posts" value="'.htmlspecialchars($num_posts).'">
            <input type="hidden" name="num_replies" value="'.htmlspecialchars($num_replies).'">
	    <input type="hidden" name="num_solved" value="'.htmlspecialchars($num_solved).'">
            <input type="hidden" name="date" value="'.htmlspecialchars($date).'">
            </form>
	    ';
	    echo '
	    <script type="text/javascript">
	    window.onload = function() {
		    document.getElementById("user").submit();
		};
	    </script>';
	}
    }else{
	echo 'user account doesnt exist anymore';
	echo '<a href="'.$location.'">
            <button class="back">Back</button>
        </a>';

    }
} else {
    $id = $_SESSION['user_id'];
    $sql = "SELECT Email, Address, num_posts, num_replies, num_solved FROM userinfo WHERE id = ?";
    $params = array($id);
    $stmt = sqlsrv_prepare($conn, $sql, $params);
    if (sqlsrv_execute($stmt)) {
	if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
	    $email = $row['Email'];
	    $address = $row['Address'];
	    $num_posts = $row['num_posts'];
	    $num_replies = $row['num_replies'];
	    $num_solved = $row['num_solved'];
	}else{
            die(print_r(sqlsrv_errors(), true)); // Check for execution errors
	}
    } else {
	die(print_r(sqlsrv_errors(), true)); // Check for execution errors
    }
}
sqlsrv_free_stmt($stmt);
//sqlsrv_close($conn);
?>



