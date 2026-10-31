<?php
include 'finduser.php';
include 'time.php';
require_once('connection2.php');
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo isset($_FILES);
    echo "empty: " . count($_FILES)==0;
    //var_dump($_FILES);
    echo $username;
    var_dump($_POST);
    $category = $_POST['category'];
    $title = $_POST['title'];
    $reply = isset($_POST['reply']) ? $_POST['reply'] : $_POST['reply2'];
    $indentation = isset($_POST['reply']) ? $_POST['indentation_level']+1 : 0;
    $orderr = isset($_POST['orderr']) ? $_POST['orderr']+1 : $_POST['count'];
    $file_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $dest = '/var/www/192.168.0.10/uploads/' . $file_name;
    $dest2 = 'uploads/' . $file_name;
    if(isset($_POST['reply'])){
        $sql = "UPDATE posts SET orderr = orderr + 1 WHERE orderr >= ?";
	$params = array($orderr);
	$stmt = sqlsrv_query($conn2, $sql, $params);
    }
    require_once('connection.php');
    $sql = "UPDATE userinfo SET num_replies = num_replies + 1 WHERE Username >= ?";
    $params = array($username);
    $stmt = sqlsrv_query($conn, $sql, $params);
    sqlsrv_close($conn);
    if(!empty($_FILES['file']['name'])){
	if(move_uploaded_file($tmp_name, $dest)){
	    $sql = "INSERT INTO posts (indentation_level, orderr, replies, title, username, file_path, is_solved) 
		    VALUES (?, ?, ?, ?, ?, ?, ?)";
	    $params = array($indentation, $orderr, $reply, $title, $username, $dest2, 0);
	    //var_dump($params);
	    $stmt = sqlsrv_query($conn2, $sql, $params); 
	} else {
	    echo 'could not move file';
	}
    } else {
        echo 'executed';
	$sql = "INSERT INTO posts (indentation_level, orderr, replies, title, username, is_solved) VALUES (?, ?, ?, ?, ?, ?)"; 
        $params = array($indentation, $orderr, $reply, $title, $username, 0);
	echo $reply;
	print_r($params);
        $stmt = sqlsrv_query($conn2, $sql, $params);
	if($stmt == false){
	    die(print_r(sqlsrv_errors()));
	}
    }
    sqlsrv_free_stmt($stmt);
    echo 'success';
}
sqlsrv_close($conn2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Submit Form</title>
    <script type="text/javascript">
        // Function to automatically submit the form
        window.onload = function() {
            document.getElementById('autoSubmitForm').submit();
        };
    </script>
</head>
<body>
<form id="autoSubmitForm" action="content.php" method="POST">
    <!-- Hidden input field that contains the PHP variable $title -->
    <input type="hidden" name="title" value="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="category" value="<?=$category?>">
</form>
</body>
</html>
