<?php session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Post</title>
</head>
<body>
<form action="categories.php" method="GET" id="form">
    <input type="hidden" name="category" value="<?php echo $_POST['category'];?>">
    <button class="back" type="submit">Back</button>
</form>
<h2><br><br>Submit Your Post</h2>
<?php if(isset($_SESSION['user_id'])):?>
    <?php 
    include '/var/www/192.168.81.200/index.html/forum/finduser.php';
    include('ifregistered.php');
    //echo $_SESSION['registered'];
    if($_SESSION['registered']==1) { ?>
	<form action="create.php" method="POST" enctype='multipart/form-data'>
	    <label for="title">Title:</label><br>
	    <input type="text" id="title" name="title" required><br><br>

	    <label for="content">Content:</label><br>
	    <textarea id="content" name="content" rows="5" cols="60" required></textarea><br><br>
	    </select><br>
	    <input type="hidden" name="category" value="<?php echo $_POST['category'];?>">
	    <input type="file" name="file">
	    <input type="submit" value="Submit Post">
	</form>
    <?php } else {
	echo 'To post, you must be approved by admin';
    } ?>
<?php else: ?>
    <p> To post, you must be logged in</p>
<?php endif;?>

<style>
  .back {
         padding: 5px 20px;
         font-size: 16px;
         background-color: white;
         color: rgb(13,82,133);
         border: 3px double rgb(13,82,133);
         border-radius: 15px;
         display: inline-flex;
         align-items: left;
         justify-content: left;
         cursor: pointer;
         text-decoration: none;
         position: absolute;
         left:20px;
             }

       .active, .back:hover {
            background-color: rgb(13, 82, 133);

            color: white;
            border: 3px double white;
        }

input[type="submit"]{
    padding: 5px 30px;
    font-size: 16px;
    background-color: rgb(13,82,133);
    color: white;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-decoration: none;
}
</style>

</body>
</html>

