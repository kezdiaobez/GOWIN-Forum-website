<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connection2.php');
$title = $_POST['title'];
if(isset($_POST['category'])){
    $category = $_POST['category'];
} else {
    $reply = $_POST['reply'];
}
$order= $_POST['order'];
echo $order;
if(!empty($reply)){
    $sql = "DELETE FROM posts WHERE replies = ? AND title = ? AND orderr = ?";
    $stmt = sqlsrv_query($conn2, $sql, array($reply, $title, $order));
    $sql = "UPDATE posts SET orderr = orderr-1 WHERE orderr > ?";
    $stmt = sqlsrv_query($conn2, $sql, array($order));
} else {
    $sql = "DELETE FROM posts WHERE title = ?";
    $stmt = sqlsrv_query($conn2, $sql, array($title));
}
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Rows deleted successfully!";
}
sqlsrv_close($conn2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript">
        // Function to automatically submit the form
        window.onload = function() {
            document.getElementById('form').submit();
        };
    </script>

</head>
<body>
<?php if(isset($_POST['reply'])): ?>
    <form action="content.php" method="POST" class="category-button" id="form">
        <input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST['title']);?>">
    </form>
<?php else:?>
    <form action="forum.php" method="get" class="category-button" id="form">
	<input type="hidden" name="category" value="<?php echo $category;?>">
    </form>
<?php endif; ?>
</body>
</html>
