<?php
include('finduser.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('connection2.php');
    $file_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];  // Selected category
    echo $category;
    $dest = '/var/www/192.168.0.10/uploads/' . $file_name;
    //prevent duplicate value insertion
    $sql = "SELECT COUNT(*) FROM posts WHERE title = ?";
    $params = array($title);
    $stmt = sqlsrv_query($conn2, $sql, $params);
    if( !$stmt ) {
	die( print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row[''] == 0) {
	if(!empty($_FILES['file']['name'])){
	    if(move_uploaded_file($tmp_name, $dest)){
		$sql = "INSERT INTO posts (title, content, category, file_path, username, is_solved, clicks) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$params = array($title, $content, $category, $dest, $username, 0, 0);
	    } else {
		echo 'could not move file';
	    }
	} else {
	    $sql = "INSERT INTO posts (title, content, category, username, is_solved, clicks) VALUES (?, ?, ?, ?, ?, ?)";
	    $params = array($title, $content, $category, $username, 0, 0);
	}
	$stmt = sqlsrv_prepare($conn2, $sql, $params);
	if ($stmt) { 
	    $result = sqlsrv_execute($stmt);
	    if ($result) {
		echo "Post submitted successfully!";
	    } else {
		echo "Error submitting post.";
		die(print_r(sqlsrv_errors(), true));
	    }
	} else {
	    echo "Error preparing SQL statement.";
	    die(print_r(sqlsrv_errors(), true));
	}
	require_once('connection.php');
	$sql = "UPDATE userinfo SET num_posts = num_posts+1 WHERE Username = ?";
	$params = array($username);
	sqlsrv_query($conn, $sql, $params);
	sqlsrv_close($conn);
    } else {
	echo 'duplicate title found, cannot create post';
	die(print_r(sqlsrv_errors(), true));
    }
}
sqlsrv_close($conn2);
?>
<!DOCTYPE html>
<html>
<body>
    <script type="text/javascript">
        // Function to automatically submit the form
        window.onload = function() {
            document.getElementById('dumb').submit();
        };
    </script>
<form action="content.php" method="POST" id="dumb">
    <input type="hidden" id="category" name="category" value="<?php echo htmlspecialchars($category);?>">
    <input type="hidden" id="title" name="title" value="<?php echo htmlspecialchars($title);?>">
    <input type="hidden" id="content" name="content" value="<?php echo htmlspecialchars($content);?>">
</form>

</body>
</html>
