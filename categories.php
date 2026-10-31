<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
session_start();
if(isset($_GET['is_solved'])){
    $check = true;
} else {
    $check = false;
}
if(isset($_GET['counter'])){
    $counter = 1;
} else {
    $counter = 0;
}
if(isset($_GET['execute'])){
    $execute = true;
} else {
    $execute = false;
}
if(isset($_GET['timeAgo'])){
    $dates2 = $_GET['timeAgo'];
    $dates = explode(',', $dates2);
}
$category = $_GET['category'];
require_once('connection2.php');
$sql = "SELECT COUNT(*) AS title_count 
        FROM posts 
        WHERE title IS NOT NULL AND category = ?";
$stmt = sqlsrv_query($conn2, $sql, array(&$category));
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$num_titles = $row['title_count'];
sqlsrv_close($conn2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white; //#f4f4f9;
        }
        .button-container {
            //display: flex;
            //flex-direction: column;
            //align-items: right;
            //justify-content: left;
            //height: 200vh;
            //padding: 20px;
            //box-sizing: border-box;
        }
	.post-button-wrapper {
            display: flex;
            flex-direction: column;
	    position: relative;
	    width: 90%;
            max-height: 180px;
	    margin: 1px auto;
	}

        .post-button-left {
	    white-space: nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
	    display: block;
	    width: 100%;
            height: 180px;
	    font-size: 16px;
	    cursor: pointer;
	    color: rgb(13,82,133);
	    background-color: #f4f4f9;
	    text-align: left;
	    //border: rgb(13,82,133) 3px solid;
            //border-style: 
	    padding: 0px;
	    //box-sizing: border-box;
	    position: relative; /* Needed to position inside here */
        }
       .post-button-center {
            white-space: normal;
            display: block;
            width: 100%;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            color: rgb(13,82,133);
            background-color: #f4f4f9;
            text-align: center;
            border: rgb(13,82,133) 3px;
            border-style: double none none none;
            padding: 5px;
            box-sizing: border-box;
            position: relative; /* Needed to position inside here */
        }

	.inner-button {
	    position: absolute;
	    top: 3px;
	    right: 2px;
	    padding: 0px 0px;
	    font-size: 10px;
	    cursor: pointer;
	}
        .post-form {
            width: 100%; /* Ensure the form takes the full width available */
            //height: 180px;
        }
        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 5px;
            color: rgb(13,82,133);  
          }
       .no-posts {
            font-size: 24px;
            color: #555;
            text-align: center;
        }
       .create,
       .back {
         padding: 5px 20px;
         font-size: 16px;
         background-color: white;
         color: rgb(13,82,133);
         border: 3px double rgb(13,82,133);
         border-radius: 15px;
         display: inline-flex;
         align-items: center;
         justify-content: center;
         cursor: pointer;
         text-decoration: none;
         margin-left: 20px; /* Adds space between buttons */
         margin-right: 10px;
             }
       .active, .create:hover {
            background-color: rgb(13, 82, 133);
            color: white;
            border: 3px double white;
        }

      .search-bar{
        padding: 0px ;
        width:400px;
        display: inline-flex;
        color: rgb(13,82,133);
        background-color: white;
        align-items: stretch;
        justify-content: left;
        border: 1px solid rgb(13,82,133);
        //margin: 5px 10px 5px 0;
      }
	.search-bar2{
        padding: 0px ;
        display: none;
        color: rgb(13,82,133);
        background-color: white;
        align-items: stretch;
        justify-content: right;
        border: 0px solid rgb(13,82,133);
        //margin: 5px 10px 5px 0;
      }

      .btn-container {
          display: inline-flex; /* Makes buttons align in a row */
            gap: 1px; /* Adds spacing between buttons */
            padding: 20px;
      }
        
    </style>
    <script>
	window.onload = function (){
	    if(document.getElementById("form")){
	        document.getElementById("form").submit();
	    }
	}
	function toggleInput2(){
	    checkbox2 = document.getElementById('unsolved_checkbox');
            if(checkbox2.checked){
                console.log("checkded");
                window.location.href="forum.php?category=<?=urlencode($category)?>&is_solved=False";
            } else {
                console.log("not checked");
                window.location.href="forum.php?category=<?=urlencode($category)?>";
            }
	}
    </script>
</head>
<body>

<div class="btn-container">
<form action="create2.php" method="POST">
    <input type="hidden" name="category" value="<?php echo $category;?>">
    <button class="create" type="submit">Create</button>
</form>
<?php if($num_titles>0): ?>
    <form method="GET" action="forum.php">
        <input type="text" name="title" class="search-bar" placeholder="Search post's title in <?php echo $category;?> ">
        <input type="hidden" name="category" value="<?php echo htmlspecialchars($category);?>">
       <button type="submit"  class="create" >Search</button>
    </form>
    <!--
    <form method="GET" action="forum.php">
        <input type="text" id="user" name="user" class="search-bar2" placeholder="Search user's posts in <?php echo $category;?>">
        <input type="hidden" name="category" value="<?php echo htmlspecialchars($category);?>">
        <button type="submit" class="create">Search</button>
    </form>
    -->
    <label>
        <input type="checkbox" id="unsolved_checkbox" onclick="toggleInput2()" <?php echo $check ? 'checked' : ''; ?>> Unsolved
    </label>
<?php endif; ?>

</div>
<!-- The buttons will be inserted here by PHP -->
</body>
<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
include 'connection2.php';
if(!(isset($_GET['title']) || isset($_GET['user']) || isset($_GET['is_solved']))){
    // SQL query to fetch posts matching the category
    $sql = "SELECT timestamp, title, username, content, clicks, is_solved FROM posts WHERE category LIKE ? AND category IS NOT NULL AND title IS NOT NULL";
    // Prepare the statement
    $stmt = sqlsrv_prepare($conn2, $sql, array(&$category));
    // Execute the query
    if (!sqlsrv_execute($stmt)) {
	die(print_r(sqlsrv_errors(), true));
    }
} else if (isset($_GET['user'])){
    $username = $_GET['user'];
    $sql = "SELECT timestamp, title, username, content, clicks, is_solved FROM posts WHERE DIFFERENCE(username, ?)>2 AND category LIKE ? AND category IS NOT NULL AND title IS NOT NULL";
    $stmt = sqlsrv_prepare($conn2, $sql, array(&$username, &$category));
    // Execute the query
    if (!sqlsrv_execute($stmt)) {
	die(print_r(sqlsrv_errors(), true));
    }
} else if (isset($_GET['title'])){
    $title = $_GET['title'];
    $sql = "SELECT timestamp, title, username, content, clicks, is_solved FROM posts WHERE DIFFERENCE(title, ?)>2 AND category LIKE ? AND category IS NOT NULL AND title IS NOT NULL";
    $stmt = sqlsrv_prepare($conn2, $sql, array(&$title, &$category));
    // Execute the query
    if (!sqlsrv_execute($stmt)) {
	die(print_r(sqlsrv_errors(), true));
    }
} else if (isset($_GET['is_solved'])) {
    $is_solved = $_GET['is_solved'];
    //echo 'executed';
    $sql = "SELECT timestamp, title, username, content, clicks, is_solved FROM posts WHERE is_solved = ? AND category LIKE ? AND category IS NOT NULL AND title IS NOT NULL";
    $stmt = sqlsrv_prepare($conn2, $sql, array(0, &$category));
    // Execute the query
    if (!sqlsrv_execute($stmt)) {
	die(print_r(sqlsrv_errors(), true));
    }

}
// Fetch the results
$posts = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $posts[] = $row;
}
// If posts are available, generate the HTML for buttons
if (!empty($posts)) {
    if($execute){
	//echo '<div class="button-container">';
	$posts = array_reverse($posts);
	$dates = array_reverse($dates);
	foreach ($posts as $post) {
	    $sql = "SELECT COUNT(*) AS num_replies FROM posts WHERE replies IS NOT NULL AND title = ?";
	    $stmt = sqlsrv_prepare($conn2, $sql, array(&$post['title']));
	    if (!sqlsrv_execute($stmt)) {
		die(print_r(sqlsrv_errors(), true));
	    }
	    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
	    $num_replies = $row['num_replies'];
	    include('connection.php');
	    $sql = "SELECT pic FROM userinfo WHERE Username=?";
	    $params = array($post['username']);
	    $stmt = sqlsrv_query($conn, $sql, $params);
	    if(!$stmt){
		die(print_r(sqlsrv_errors(), true));
	    }
	    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$pic = $row['pic'];
	    }
	    if (!empty($pic)) {
		$file_url = str_replace('/var/www/', 'http://', $pic);
	    }
            else { $file_url = "../Images/no-picture-available-icon-8.png"; 
            }
            $index = array_search($post, $posts);
	    echo '<div class="post-button-wrapper">';
	    echo '<form action="content.php" id="formm' . $index . '" method="POST" class="post-form">';
	    echo '<button type="submit" class = "post-button-center">' . htmlspecialchars($post['title']) . ' <br>  </button>';
            echo '<button type="submit" class = "post-button-left">'. $dates[$index] . ' by ' . htmlspecialchars($post['username']) . '<br> Replies '  .$num_replies.  ';   Views ' .$post['clicks'].  '<br> This issue is ' . ((bool) $post['is_solved'] ? 'solved' : 'not solved') . ' <br> <br> ' . htmlspecialchars($post['content']) . ' </button>';
	    echo '<input type="hidden" name="title" value="' . htmlspecialchars($post['title']) . '" id="title' . $index . '">';
	    echo '<input type="hidden" name="content" value="' . htmlspecialchars($post['content']) . '">';
	    echo '<input type="hidden" name="username" value="' . htmlspecialchars($post['username']) . '">';
	    echo '<input type="hidden" name="category" value="' . htmlspecialchars($category) . '">';
	    echo '</form>';
	    echo '<form action="finduser2.php" method="GET">
		<input type="hidden" name="username" value="' . htmlspecialchars($post['username']) . '">
		<input type="hidden" id="location'.(array_search($post, $posts)).'" name="location">
		<input type="image" src="' . $file_url . '" alt="Submit" width="80" height="83" class="inner-button">
	    </form>';
	    echo '</div>';
	    if(isset($_SESSION['user_id'])){
		$id = $_SESSION['user_id'];
		$sql = "SELECT is_admin FROM userinfo WHERE id = ?";
		$params = array($id);
		$stmt = sqlsrv_query($conn, $sql, $params);
		if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		    $is_admin = $row['is_admin'];
		}
                //print_r($id);
		if($is_admin){
		    echo '
		    <form action="delete_post.php" method="post">
			    <input type="hidden" name="title" value="'.htmlspecialchars($post['title']).'">
			    <input type="hidden" name="category" value="'.htmlspecialchars($category).'">
			    <input type="hidden" id="location'.(array_search($post, $posts)+count($posts)).'" name="location">
			    <input type="submit" value="Delete Post">
		    </form>
		    <form action="delete_user.php" method="post">
			    <input type="hidden" name="user" value="'.htmlspecialchars($post['username']).'">
			    <input type="hidden" name="category" value="'.htmlspecialchars($category).'">
			    <input type="hidden" id="location'.(array_search($post, $posts)+2*count($posts)).'" name="location">
			    <input type="submit" value="Delete User">
		    </form>
		    <form action="delete_all.php" method="post">
			    <input type="hidden" name="user" value="'.htmlspecialchars($post['username']).'">
			    <input type="hidden" name="category" value="'.htmlspecialchars($category).'">
			    <input type="hidden" id="location'.(array_search($post, $posts)+3*count($posts)).'" name="location">
			    <input type="submit" value="Delete user and all related posts and replies">
		    </form>
		    ';
		}
	    }
	}
	//echo '</div>';

	echo '<div id="postlen" data-php-var="' . count($posts) . '"></div>';
	echo '
	<script>
	console.log("executed");
	var numRows = document.getElementById("postlen").getAttribute("data-php-var");
	console.log(numRows);
	var url=window.location.href;
	for (var i = 0; i < numRows*4; i++) {
	    console.log("Processing index: " + i);
	    document.getElementById("location"+i).value = url;
	}
	</script>
	';
	//echo '</div>';
    }
    if($counter == 0){
	echo 'to time.php';
	$dates = array_column($posts, 'timestamp');
	$counter+=1;
	?>
	<form action='time.php' method='POST' id='form'>
	    <input type='hidden' name='time' id='date' value='<?=json_encode($dates)?>'>
	    <input type='hidden' name='counter' id='notdate' value='<?=$counter?>'>
	    <input type='hidden' name='category' id='notdate2' value='<?=$category?>'>
	    <?php if(isset($title)):?>
		<input type='hidden' name='title' value='<?=$title?>'>
	    <?php endif;?>
	    <?php if(isset($username)):?>
		<input type='hidden' name='user' value='<?=$username?>'>
	    <?php endif;?>
	    <?php if(isset($is_solved)):?>
		<input type='hidden' name='is_solved' value='<?=((bool) $is_solved ? 'true' : 'false')?>'>
	    <?php endif;?>
	    <input type='hidden' name='different'>
	</form>
    <?php
    }
} else {
    echo '<p>Oops, No posts found in this category. Becomes first one to post here!</p>';
}
?>
<script>
console.log("numRows" + numRows);
window.onload = function(){
    for(let i=0; i<numRows; i++){
	document.getElementById("formm" + i).addEventListener("submit", function (event) {
	    event.preventDefault();
	    console.log("post click");
	    if(document.getElementById("title" + i)){
		const title = document.getElementById("title" + i).value;
		console.log(title);
		fetch("clicks.php", {
		    method: "POST",
		    headers: {
			"Content-Type": "application/x-www-form-urlencoded",
		    },
		    body: `title=${title}`,
		})
		.then(response => response.text())
		.then(result => {
		    event.target.submit();
		    //alert("Server response: " + result);
		})
		.catch(error => {
		    console.error("Error:", error);
		});
	    } else {
		console.log('title not defined');
	    }
	});
    }
}
</script>
</html>

