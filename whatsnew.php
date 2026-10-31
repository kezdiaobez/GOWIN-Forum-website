<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
// Handle timezone POST request and store it in session
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['timezone'])) {
    $_SESSION['timezone'] = $_POST['timezone'];
    echo 'Timezone stored';
    exit;
}
// Include other necessary files
include 'htmlelements.php';
?>
<h2 id="pt">Whats New?</h2>
<?php 
include 'finduser.php';
if(isset($username) && $username == 'admin'){
?>
    <a href="admin_post.php"><button>post update</button></a>
    <br>
<?php
$admin =True;
}else {
$admin =False;
}
sqlsrv_close($conn);
require_once('connection3.php');
$sql = "SELECT * FROM updates";
$stmt = sqlsrv_query($conn3, $sql);
$table = array();
?>
 <div class="container">

<?php
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $table[] = $row;
}
// Use the timezone from the session, default to 'UTC' if not set
$table_r= array_reverse($table);
$timezone = isset($_SESSION['timezone']) ? $_SESSION['timezone'] : 'UTC';
foreach($table_r as $row) {
    //echo '<p>' . htmlspecialchars($row['title']) . '</p>';
    
    // Check if the 'date' is already a DateTime object
    if (!empty($row['date'])) {
        // If it's a DateTime object, no need to create a new one
        if ($row['date'] instanceof DateTime) {
            $datetime = $row['date'];
        } else {
            // If it's a string, convert it to a DateTime object
            $datetime = new DateTime($row['date'], new DateTimeZone('UTC'));
        }
        
        // Now set the timezone
        $datetime->setTimezone(new DateTimeZone($timezone));
        // Output the formatted date
        echo '<h3 class="pts">' . $datetime->format('m/d/Y') . '</h3>';
    }
    
    echo '<p class="pts">' . htmlspecialchars($row['post']) . '</p>';
   if($admin){
      echo '<form action="delmessage.php" method="get" id="form">';
      echo '<input type="hidden" name="title" value="'. htmlspecialchars($row['title']). '">';
      echo '<button type="submit" class="back">delete</button>';
      echo ' </form>';

   }
}
sqlsrv_close($conn3);
?>
 </div>
<!-- Load timezone.js script -->
<script src="timezone.js"></script>

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

          <a href="http://www.magicjellybean.org/">
           <img class="fblogo" src="../Images/MJB.jpg" alt="MJB">
        </a>

        </p>
    </footer>

    <style>
    .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
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
      font-size: 20px;
      padding: 0px 20px;
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
