<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url("../Images/background.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: inherit;
            filter: blur(5px);
            z-index: -1;
        }
        html, body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        #fulbox {
            border: 7px solid rgb(13,82,133);
            border-radius: 0px;
            background-color: rgb(230, 230, 232);
            padding: 20px;
            width: 350px;
            text-align: center;
            opacity: 0.9;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label, input, textarea {
            width: 90%;
            margin: 5px 0;
        }
        input, textarea {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 0px;
        }
        input[type="submit"], button {
            background-color:rgb(13,82,133);
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            width: 95%;
            margin-top: 10px;
        }
        h2{
            color:rgb(13,82,133);
        }

.close { 
  color: rgb(13,82,133);
  background-color: rgb(230, 230, 232);
  width: 30px;
  position: relative;
  left: 150px;
  font-size: 18px;
  font-style: normal;
  text-decoration: none;
  padding: 2px;
  border: 3px solid rgb(13,82,133);
}
.close:hover {
  opacity: 1;
  color: white;
  background-color: rgb(13,82,133);
  border: 3px solid white;
}
.close:focus {
 color: white;
 background-color:rgb(13,82,133);
 cursor: pointer;
}

    </style>
</head>
<body>
    <div id="fulbox">
       <form action="../index.php" method="POST">
          <button class="close" aria-label="Dismiss alert" type="submit" >
          <span aria-hidden="true"><class="fa fa-window-close">X</span>
          </button>
        </form>
        <h2>Login Form</h2>
        <?php if(!isset($_SESSION['user_id'])): ?>
        <form action="login2.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Login">
        </form>
        <?php else: ?>
        <p>Already logged in</p>
	<?=json_encode(isset($_SESSION['user_id']))?>
        <a href="../index.php">
            <button>Back</button>
        </a>
        <?php endif; ?>
    </div>
</body>
</html>
