<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" type="x-icon" href="../Images/gowinIcon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gowin Forum</title>
    <!-- Title of the website-->
    <link href="Css/style.css" rel="stylesheet" type="text/css" />
    <!-- This is the link so that index can recive the code from css-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <?php
    session_start();
    ?>
    <div class="header">
      <a href="https://www.gowinsemi.com/">
        <img src="../Images/gowinlogo.png" width="200px" />
      </a>
      <div class="button-group">
        <?php if(isset($_SESSION['user_id'])):?>
            <button class="logout-btn" onclick="window.location.href='logout.php';">Log Out</button>
        <?php else:?>
            <button id="rg" onclick="redirectToForum2()">Register</button>
            <button id="ln" onclick="redirectToForum1()">Login</button>
        <?php endif;?>
      </div>
    </div>
    <div class="nav">
      <button class="GTP" onclick="window.location.href='../index.php'">Home</button>
      <button class="GTP" onclick="redirectToForum()">Forum</button>
      <button class="GTP" onclick="window.location.href='whatsnew.php'">Whats New?</button>
      <button class="GTP" onclick="window.location.href='help.php'">Disclaimer</button>
      <button class="GTP" onclick="window.location.href='profile.php'">Update Profile</button>
    </div>
    <script type="text/javascript">
        function redirectToForum() {
            window.location.href = "forum.php";
        }
        function redirectToForum1() {
            window.location.href = "login.php";
        }
        function redirectToForum2() {
            window.location.href = "http://forum.gowinsemi.com/index.html/forum/register.html";
        }
    </script>
