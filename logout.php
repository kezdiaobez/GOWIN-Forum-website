<?php
session_start();
if(isset($_SESSION['user_id'])){
        session_destroy();
}
include 'htmlelements.php';
?>
  <div class="topbox1">
  <p class="pts">You have been logged out! </p>


    <footer id="footy">
        <p id="cpr">
          Gowin Semiconductor | 2025 All rights reserved. &copy;
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
        font-size: 26px;
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



