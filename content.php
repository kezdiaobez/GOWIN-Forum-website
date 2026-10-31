<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
if(isset($_SESSION['user_id'])){
    include 'finduser.php';
}
include 'connection2.php';
$title = $_POST['title'];
$category = $_POST['category'];
echo '<h1>';
echo $category;
echo '</h1>';
if(!isset($_POST['counter'])){
    $counter = 0;
} else {
    $counter = $_POST['counter'];
    //list with all elements with key timeAgo
    $timeAgo = explode(",", $_POST['timeAgo']);
}
if(isset($_POST['execute'])){
    $execute = true;
} else {
    $execute = false;
}
// Query to select the post and replies
$sql = "SELECT content, replies, indentation_level, timestamp, orderr, username, file_path, is_solved 
        FROM posts WHERE title = ?";
$params = array($title);
$stmt = sqlsrv_query($conn2, $sql, $params);

// Fetch data into an array
$replies = [];
if(!$stmt){
    die(print_r(sqlsrv_errors(), true));
}
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $replies[] = $row;
}

sqlsrv_free_stmt($stmt);

// Function to display the replies with correct indentation
function displayReplies($replies, $title, $username, $timeAgo, $imageFormat) {
    if($replies[0]['is_solved'] == 1){
	echo '<h3>The issue is solved! </h3>';
    }
    $file_path = $replies[0]['file_path'];
    if($file_path !== null){
	$file_name = (basename($file_path));
	$file_url = "https://forum.gowinsemi.com/uploads/" . rawurlencode($file_name);
	$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
	if(in_array($extension, $imageFormat)){
	    ?><a><img src="<?=$file_url;?>" alt="file" width="150" height="150"></a><?php
	} else {
	    echo '<a href="' . htmlspecialchars($file_url) . '" download>Download ' . htmlspecialchars($file_name) . '</a>';
	}
    }
    $maxOrder = count($replies);
    // Prepare the nested replies structure in correct order
    for ($i = 0; $i < $maxOrder; $i++) {
        for ($j = 1; $j < $maxOrder; $j++) {
            if ($replies[$j]['orderr'] == $i) {
                $reply = $replies[$j]; // Assign $reply outside of echo block
                ?>
                <div class="reply-box" style = "margin-left: <?= $reply['indentation_level'] * 50 ?>px;">
                    <?php if(!empty($reply['replies'])): ?>
			<form action='finduser2.php' method='GET'>
			    <input type='submit' name='username' value='<?= htmlspecialchars($reply['username']) ?>'>
			    <input type='hidden' name='location' id='location<?=$i?>'>
			    <input type='hidden' name='title' id='title'<?=$i?> value='<?=$title?>'>
			</form>
                        <p><?= $timeAgo[$i]?></p>
                        <p><?= nl2br(htmlspecialchars($reply['replies'])) ?></p>
			<?php $edge_case = false;
			$max_order_index = array_search($maxOrder-1, array_column($replies, 'orderr'));
			for ($g = 0; $g<$maxOrder; $g++){
			    if($g != $max_order_index){
				$next = array_search($replies[$g]['orderr']+1, array_column($replies, 'orderr'));
				if($replies[$g]['indentation_level'] > $reply['indentation_level'] && $replies[$next]['indentation_level'] <= $reply['indentation_level'] && $replies[$g]['orderr'] > $reply['orderr']){
				    $orderr = $replies[$g]['orderr'];
				    $edge_case = true;
				}
			    }
			}
			//subtract 1 because orderr starts at 0
			if(!$edge_case && $replies[$max_order_index]['indentation_level'] > $reply['indentation_level']){
			    $orderr = $maxOrder-1;
			}elseif(!$edge_case){
			    $orderr = $reply['orderr'];
			}
			?>
			<?php if(isset($_SESSION['user_id']) && $reply['is_solved'] == 0): ?>
			    <?php
			    include 'ifregistered.php';
			    if($_SESSION['registered']==1){ ?>
				<form action='submit_reply.php' method='POST' enctype='multipart/form-data'>
				    <input type='hidden' name='title' value='<?= htmlspecialchars($title) ?>'>
				    <input type='hidden' name='category' value='<?= htmlspecialchars($category) ?>'>
				    <input type='hidden' name='orderr' value='<?= $orderr ?>'>
				    <input type='hidden' name='indentation_level' value='<?= $reply['indentation_level'] ?>'>
				    <input type='file' name='file'>
				    <br>
				    <textarea rows='10' cols="60" id= '<?= $i ?>' name='reply' style="display: none;" required></textarea>
				    <br>
				    <input type='submit' value='Reply' onclick="show(<?php echo $i;?>)">
				</form>
			    <?php } ?>
			<?php else:?>
			    <p> You need log in to reply unless this thread is solved </p>
			<?php endif;?>
                    <?php endif; ?>
                    <?php if($reply['file_path'] !== null):
		        $file_url = "https://forum.gowinsemi.com/uploads/" . rawurlencode(basename($reply['file_path']));
        		$extension = strtolower(pathinfo($reply['file_path'], PATHINFO_EXTENSION));
			if(in_array($extension, $imageFormat)){
		            ?><a><img src="<?=$file_url;?>" alt="file" width="150" height="150"></a><?php
			} else {
			    echo '<a href="' . htmlspecialchars($file_url) . '" download>Download ' . (basename($reply['file_path'])) . '</a>';
			}
                        ?>
                    <?php endif; ?>
                    <br>
		<?php if($reply['is_solved'] == 0 && $username == $replies[0]['username']): ?>
		    <form action='update_status.php' method='POST'>
			<input type='hidden' name='title' value='<?=htmlspecialchars($title)?>'>
			<input type="hidden" name="username" value='<?=htmlspecialchars($reply['username'])?>'>
			<input type='submit' value='mark as solved'>
		    </form>
		<?php endif;?>
		<?php if($username == 'admin'): ?>
		    <form action="delete_post.php" method="post">
			    <input type="hidden" name="title" value="<?=htmlspecialchars($title)?>">
			    <input type="hidden" name="reply" value="<?=htmlspecialchars($reply['replies'])?>">
                            <input type="hidden" name="order" value="<?=htmlspecialchars($orderr)?>">
			    <input type="submit" value="Delete Reply">
		    </form>
		    <form action="delete_user.php" method="post">
			    <input type="hidden" name="user" value="<?=htmlspecialchars($reply['username'])?>">
			    <input type="hidden" name="title" value="<?=htmlspecialchars($title)?>">
			    <input type="submit" value="Delete User">
		    </form>
		    <form action="delete_all.php" method="post">
			    <input type="hidden" name="user" value="<?=htmlspecialchars($reply['username'])?>">
			    <input type="hidden" name="title" value="<?=htmlspecialchars($title)?>">
			    <input type="submit" value="Delete user and all replies in this post">
		    </form>
		<?php endif;?>
		</div>
                <?php
            }
        }
    }
    return $replies[0]['is_solved'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .post-container {
            width: 100%;
  	    text-align: left;
        }
        .reply-form input[type="text"] {
            width: 90%;
            padding: 8px;
            margin-top: 10px;
        }
        .reply-form input[type="submit"] {
            padding: 8px 16px;
            margin-top: 10px;
        }
	.reply-box {
            width: 80%;

	    border: 2px solid rgb(13,82,133);
	    padding: 15px;
	    margin-bottom: 10px;
	    border-radius: 8px;
	    box-sizing: border-box;
	    background-color: #f7f7f7;
	    color: #333;
	}
	.back{
            padding: 7px 15px;
            font-size: 16px;
            background-color: white;
            color: rgb(13,82,133);
            border: double, 3px, rgb(13,82,133);
            border-radius: 15px;
            cursor: pointer;
            text-decoration: none;
            box-sizing: border-box;
            display: inline-block;
        }
        .active, .back:hover{
            padding: 7px 15px;
            font-size: 16px;
            background-color: rgb(13,82,133);
            color: white;
            border: double, 3px, white;
        }
        
        input[type="submit"]{
            padding: 7px 15px;
            font-size: 16px;
            background-color: white;
            color: rgb(13,82,133);
            border: double, 3px, rgb(13,82,133); 
            border-radius: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s ease;
            box-sizing: border-box;
            display: inline-block;
        }
	input[type="file"]{
            padding: 4px 13px;
            font-size: 16px;
            background-color: rgb(13,82,133);
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s ease;
            box-sizing: border-box;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="post-container">
    <h1><?php echo htmlspecialchars($title); ?></h1>
    <a href="forum.php?category=<?=urlencode($category)?>">
	<button class="back">Back</button>
    </a>
    <div id="maxcount" data-php-var="<?=count($replies)?>"></div>
    <?php
    if(!isset($username)){
	$username = "thisdoesntmatter";
    }
    $imageFormat = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
    if($execute){
	// Display the post's main content
	echo "<div>" . "<br><strong>Original post by </strong> " . htmlspecialchars($replies[0]['username']) . "</div>";
	echo "<div>" . "<strong></strong> " . nl2br(htmlspecialchars($replies[0]['content'])) . "<br></div>";
	$is_solved = displayReplies($replies, $title, $username, $timeAgo, $imageFormat);
    }
    $dates = array_column($replies, 'timestamp');
    foreach ($dates as &$date){
	$date = $date->format('Y-m-d H:i:s');
    }
    //print_r($dates);
    ?>
    <div id="dates" dates-php-var="<?= htmlspecialchars(json_encode($dates), ENT_QUOTES, 'UTF-8'); ?>"></div>;
    <?php if($counter == 0):?>
	<?php $counter+=1;?>
	<form action='time.php' method='POST' id='form'>
	    <input type='hidden' name='time' id='date'>
	    <input type='hidden' name='counter' id='notdate' value='<?=$counter?>'>
	    <input type='hidden' name='title' id='notdate2' value='<?=$title?>'>
            <input type='hidden' name='category' id='notdate2' value='<?=$category?>'>
	</form>
    <?php endif; ?>
    <?php if(isset($_SESSION['user_id'])): ?>
	<?php
	include '/var/www/192.168.81.200/index.html/forum/finduser.php';
	if (!isset($_SESSION['registered'])){
	    include('ifregistered.php');
	}
	if($_SESSION['registered']==1){ ?>
	    <form action='submit_reply.php' method='POST' enctype='multipart/form-data'>
		<input type='hidden' name='title' value='<?php echo htmlspecialchars($title);?>'>
		<input type='hidden' name='count' value='<?php echo count($replies);?>'>
		<input type='hidden' name='category' value='<?=$category?>'>
		<textarea rows='5' cols='60' name='reply2' required></textarea>
		<br>
		</br>
		<input type='file' name='file'>
		<br>
		</br>
		<input type='submit' value='Reply'>
	    </form>
	<?php } else { ?>
	    <p> To reply, you must be approved by admin </p>
	<?php } ?>
    <?php else: ?>
	<p> To reply, you must be logged in</p>
    <?php endif; ?>    
</div>
</body>
<script>
    window.onload = function(){
        var numRows = document.getElementById("maxcount").getAttribute("data-php-var");
        console.log(numRows);
	const dates2 = document.getElementById("dates").getAttribute("dates-php-var");
	console.log(dates2);
	dates = JSON.parse(dates2);
	var url=window.location.href;
        if(document.getElementById("date")!==null){
            document.getElementById("date").value = JSON.stringify(dates);
            document.getElementById('form').submit();
        }
	for (var i = 1; i < numRows; i++) {
	    const elem = document.getElementById("location" + i);
	    if (elem) {
		elem.value = url;
	    }
	} 
    }
    function show(textareaId) {
        const textarea = document.getElementById(textareaId);
        // Toggle the visibility of the textarea (show it if it's hidden, hide it if it's shown)
        if (textarea.style.display === 'none' || textarea.style.display === '') {
            textarea.style.display = 'block';
        } else {
            textarea.style.display = 'none';
      }
    };
</script>
</html>
<?php
sqlsrv_close($conn2);
?>

