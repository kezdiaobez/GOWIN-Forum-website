<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" type="x-icon" href="Images/gowinIcon.png" />
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
        <img src="./Images/gowinlogo.png" width="200px" />
      </a>
      <div class="button-group">
	<?php if(isset($_SESSION['user_id'])):?>
            <button class="logout-btn" onclick="window.location.href='http://forum.gowinsemi.com/index.html/forum/logout.php';">Log Out</button>
	<?php else:?>
            <button id="rg" onclick="redirectToForum2()">Register</button>
	    <button id="ln" onclick="redirectToForum1()">Login</button>
	<?php endif;?>
      </div>
    </div>

    <div class="nav">
      <button class="GTP" onclick="window.location.href='http://forum.gowinsemi.com/index.html/index.php'">Home</button>
      <button id="fm" onclick="redirectToForum()">Forum</button>
      <button class="GTP" onclick="window.location.href='http://forum.gowinsemi.com/index.html/forum/whatsnew.php'">Whats New?</button>
      <button class="GTP" onclick="window.location.href='http://forum.gowinsemi.com/index.html/forum/help.php'">Disclaimer</button>
      <button class="GTP" onclick="window.location.href='http://forum.gowinsemi.com/index.html/forum/profile.php'">Update Profile</button>
    <?php if(isset($_SESSION['user_id'])){
	include '/var/www/192.168.0.10/index.html/forum/finduser.php';
	if($username == 'admin'){?>
	    <button class="GTP" onclick="window.location.href='http://forum.gowinsemi.com/index.html/forum/adminapproval2.php'">approve user</button>
	<?php } ?>
    <?php } ?> 
  </div>

    <script type="text/javascript">
        function redirectToForum() {
            window.location.href = "http://forum.gowinsemi.com/index.html/forum/forum.php";
        }
        function redirectToForum1() {
            window.location.href = "http://forum.gowinsemi.com/index.html/forum/login.php";
        }
        function redirectToForum2() {
            window.location.href = "http://forum.gowinsemi.com/index.html/forum/register.html";
        }
    </script>

    <h2 id="Frm">Greetings, FPGA professionals and fans!</h2>
    <!-- Heading and Id-->
    <!-- Button that sends you to create.html and id-->

    <!-- Heading and Id-->

    <div class="topbox1">
      <p class="pts">Welcome to the Gowin Semiconductor Corporation Customer Support Portal! This forum is your dedicated hub for connecting with our support team and fellow Gowin users. Whether you have questions about our FPGA solutions, need technical assistance, or want to share insights and best practices, this platform is designed to provide fast, reliable, and community-driven support. Dive in, explore resources, and let us help you unlock the full potential of Gowin’s innovative semiconductor products!</p>
    </div>

    <footer id="footy">
      <p id="cpr">
        Gowin Semiconductor | 2025 All rights reserved. &copy;
        <a href="https://rb.gy/4uueow">
          <img class="ytlogo" src="Images/YT.png" alt="YouTube">
        </a>
        <a href="https://www.linkedin.com/company/3823183/">
          <img class="lklogo" src="Images/L.png" alt="LinkedIn">
        </a>

        <a href="https://twitter.com/GOWIN_SEMI">
          <img class="Xlogo" src="Images/X.png" alt="Twitter">
        </a>

        <a href="https://www.facebook.com/people/GOWIN-Semiconductor/61550727946253/">
          <img class="fblogo" src="Images/FB.png" alt="Facebook">
        </a>

        <a href="https://www.reddit.com/r/GowinFPGA/?share_id=qmCrNj3nxrFTnKh2Tum-k&utm_content=1&utm_medium=ios_app&utm_name=ioscss&utm_source=share&utm_term=1">
          <img class="fblogo" src="http://forum.gowinsemi.com/index.html/Images/RD.png" alt="Reddit">
        </a>

       <a href="http://www.magicjellybean.org/">
          <img class="fblogo" src="Images/MJB.jpg" alt="MJB">
        </a>

      </p>
  </footer>

    <style>
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
    padding: 9px 40px;
    font-size: 16px;
    background-color:  #e6e6e8;
    color: rgb(0, 73, 129);
    border: none;
    display: flex;
    align-items: center;
    cursor: pointer;
  }

  #fm,
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

    body{
      font-family: Arial, Helvetica, sans-serif;
      margin: 0px;
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
  background-color: #e6e6e8;
}

.button-group {
  display: flex;
  gap: 15px; /* Even spacing between buttons */
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

  </body>
</html>

