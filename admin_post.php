<?php
session_start();
require_once('connection3.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "INSERT INTO updates (title, post) VALUES (?, ?)";
    $params = array($_POST['title'], $_POST['post']);
    $stmt = sqlsrv_prepare($conn3, $sql, $params);
    if ($stmt) {
	$result = sqlsrv_execute($stmt);
	if ($result) {
	    echo "Post submitted successfully!";
	    header('Location: whatsnew.php');
	} else {
	    echo "Error submitting post.";
	    die(print_r(sqlsrv_errors(), true));
	}
    } else {
	echo "Error preparing SQL statement.";
	die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_close($conn3);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Post</title>
</head>
<body>
<form action="" method="POST" enctype='multipart/form-data'>
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>
    <label for="content">Content:</label><br>
    <textarea id="content" name="post" rows="15" required></textarea><br><br>
    <input type="submit" value="bingbong">
</form>
</body>
</html>

