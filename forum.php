<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
include 'connection2.php';
$sql = "SET NAMES 'utf8';";
sqlsrv_query($conn2, $sql);
$query = "SELECT category FROM posts WHERE title IS NULL";
$stmt = sqlsrv_query($conn2, $query);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }
        .search-bar {
            color: rgb(161, 161, 161);
            font-size: 15px;
            width: 100%;
            height: 33px;
            border-width: 1px;
            border-style: solid;
            border-color: rgb(202, 202, 202);
            padding: 0 10px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .search-bar:focus {
            outline: none;
            border-color: rgb(13,82,133);
        }
        .category-buttons {
            display: flex;
            flex-wrap: nowrap;
            gap: 5px;
            padding: 20px 20px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .nav {
            display: flex;
            //justify-content: space-between;
            margin-bottom: 0px;
            padding: 20px;
            gap: 15px;
            width: 350px;
            gap: 10px;
        }
        .back,
        .create {
            padding: 10px 25px;
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
        
        button{
            padding: 10px 25px;
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
        
        input[type="submit"]{
            padding: 10px 25px;
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

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: right;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .category-button{
            padding: 5px 20px;
            font-size: 20px;
            color: rgb(13, 82, 133);
            border: none;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.1s ease;
            display: flex;
            gap: 0px;
        }
        .active, .category-button:hover {
            background-color: rgb(13, 82, 133);
            color: white;
        }

        .btn, .back, .create, button, input[type="submit"] {
            padding: 10px 25px;
            font-size: 16px;
            background-color: rgb(13, 82, 133);
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.2s ease;
            box-sizing: border-box;
            display: inline-block;
        }
        
        .nav {
    display: flex;
    padding: 20px;
    justify-content: space-between;
    width: 350px; /* Increased to allow space between items */
    gap: 10px; /* Adds a consistent gap between child elements */
  }

  .topbox1{
    padding:0 20px;
  }
   #Frm{
    padding:0 20px;
  }

  #ln,
  .logout-btn,
  #rg{
    padding: 9px 20px;
    font-size: 16px;
    background-color:  #e6e6e8;
    color: rgb(0, 73, 129);
    border: none;
    display: flex;
    align-items: center;
    cursor: pointer;
  }

  .fm{
    padding: 9.4px 40px;
  }

  .GTP{
    padding: 0px 40px;
    font-size: 16px;
    background-color:  rgb(13,82,133);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    cursor: pointer;
  }

  #rm, #Frm, #cpr{
    color: rgb(13,82,133);
    padding: 7px 20px;
  }

    .pts{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      color: rgb(13,82,133);
    }
    #pt{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 30px;
      color: rgb(13,82,133);
   }
    .header {
  display: flex;
  justify-content: space-between; /* Pushes logo to left, buttons to right */
  align-items: center;
  padding: 10px 20px;
  opacity: 0.9;
  line-height: 17px;
  background-color: #e6e6e8;
}


.button-group {
  display: flex;
  gap: 15px; /* Even spacing between buttons */
}

.post-button{
  text-align: left;
}

    .ytlogo,
    .lklogo,
    .Xlogo,
    .fblogo {
    max-width: 50px; /* Set the maximum width */
    max-height: 50px; /* Set the maximum height */
    width: 100%; /* Ensure the button scales properly */
    height: auto; /* Maintain aspect ratio */
}
    </style>
</head>
<body>
<?php include 'htmlelements.php';?>
    <div class="category-buttons">
        <?php
        while ($category = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $categoryName = htmlspecialchars($category['category']);
             echo '<a href="?category=' . urlencode($categoryName) . '" class="category-button">' . $categoryName . '</a>';
        }
        ?>
    </div>
<?php

if(isset($_GET['category'])){
    //echo "categories page executed";
    include 'categories.php';
}
?>

    <footer id="footy">
      <p id="cpr">
       <br> Tips: Click above category to start a thread, click the post to see the whole threads.
       <br> <br> Gowin Semiconductor Corporation | 2025 All rights reserved. &copy;
        <a href="https://rb.gy/4uueow">
          <img class="ytlogo" src="../Images/YT.png" alt="YouTube">
        </a>  
  
        <a href="https://www.linkedin.com/company/3823183/">
          <img class="lklogo" src="../Images/L.png" alt="LinkedIn">
        </a>
  
        <a href="https://twitter.com/GOWIN_SEMI">
          <img class="Xlogo" src="../Images/X.png" alt="Twitter">
        </a>
  
        <a href="https://www.facebook.com/people/GOWIN-Semiconductor/61550727946253/">
          <img class="fblogo" src="../Images/FB.png" alt="Facebook">
        </a>

        <a href="https://www.reddit.com/r/GowinFPGA/?share_id=qmCrNj3nxrFTnKh2Tum-k&utm_content=1&utm_medium=ios_app&utm_name=ioscss&utm_source=share&utm_term=1">
          <img class="fblogo" src="../Images/RD.png" alt="Reddit">
        </a>

       <a href="http://www.magicjellybean.org/">
          <img class="fblogo" src="../Images/MJB.jpg" alt="MJB">
        </a>

      </p>
    </footer>

</body>
</html>
<?php
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn2);
?>
