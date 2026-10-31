<?php session_start();?>
<?php include 'htmlelements.php';?>

  <div class="topbox1">
  <p class="pts">  This website is hosted by Melody Semiconductor LLC in California, USA, who is wholly owned by Gowin Semiconductor Corporation   </p>
  <h2 id="pt">Legal Disclaimer</h2>
  <div class="tb1">
    <p class="pts">
      The Gowin Semiconductor Forum (the “Forum”) is provided solely for technical discussion and support related to Gowin Semiconductor’s Field-Programmable Gate Arrays (FPGAs). By accessing or participating in the Forum, you agree to the following terms:
    </p>


    <p class="pts">
      <strong>1. Purpose and Moderation:</strong> The Forum is intended for technical discussions and support for Gowin Semiconductor’s FPGA products. All content, including posts, comments, and other submissions, is moderated by Gowin Semiconductor or its designated representatives. We reserve the right to remove, edit, or restrict any content that violates our policies, is off-topic, or is deemed inappropriate at our sole discretion.
    </p>

    <p class="pts">
      <strong>2. Content Ownership:</strong> By submitting content to the Forum, you grant Gowin Semiconductor a worldwide, perpetual, irrevocable, royalty-free, and fully transferable license to use, reproduce, modify, distribute, display, and create derivative works from such content in any form or media. You represent and warrant that you have the necessary rights to grant this license for any content you submit.
    </p>

    <p class="pts">
      <strong>3. No Warranty:</strong> The information and content provided on the Forum are for informational purposes only and are provided “as is” without any warranties, express or implied, including but not limited to warranties of accuracy, completeness, or fitness for a particular purpose. Gowin Semiconductor does not guarantee the accuracy, reliability, or suitability of any content shared on the Forum.
    </p>

    <p class="pts">
      <strong>4. Limitation of Liability:</strong> Gowin Semiconductor, its affiliates, officers, employees, or agents shall not be liable for any direct, indirect, incidental, special, or consequential damages arising from your use of or reliance on the Forum or its content, even if advised of the possibility of such damages.
    </p>

    <p class="pts">
      <strong>5. User Responsibility:</strong> You are solely responsible for your interactions on the Forum and any content you submit. You agree not to post content that is unlawful, defamatory, obscene, infringing, or otherwise objectionable. Gowin Semiconductor is not responsible for the conduct or content of any Forum user.
    </p>

    <p class="pts">
      <strong>6. Changes to the Forum:</strong> Gowin Semiconductor reserves the right to modify, suspend, or discontinue the Forum or its terms of use at any time without prior notice.
    </p>

    <p class="pts">
      <strong>7. Forum Usage:</strong>By using the Forum, you acknowledge and agree to abide by this Disclaimer and any additional terms or policies posted on the Forum. If you do not agree with these terms, please refrain from using the Forum.
    </p>

    <p class="pts">
      For questions or concerns, please contact <a href="mailto:support@gowinsemi.com">support@gowinsemi.com</a>.
    </p>
  </div>
</div>


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
