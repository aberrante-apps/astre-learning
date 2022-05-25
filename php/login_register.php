<?php
  require 'connection.php';

  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginemail = $_POST['email_address'];
    $loginpassword = $_POST['password'];
    global $dbc;



    // Retrieve product ID of the login info
    $query = "SELECT  * from Logins WHERE email_address = '$loginemail'  AND password = '$loginpassword';";
    $result = mysqli_query($dbc, $query);
    if ($result) {
      $row = $result -> fetch_array(MYSQLI_NUM);

      $_SESSION['Account']['id'] = $row[0];
      $_SESSION['Account']['first_name'] = $row[1];
      $_SESSION['Account']['last_name'] = $row[2];
      $_SESSION['Account']['email_address'] = $row[3];
      $_SESSION['Account']['phone_number'] = $row[4];
      $_SESSION['Account']['shipping_address'] = $row[6];
      $_SESSION['Account']['admin'] = $row[7];

      echo "<b>Currently Logged-In As:</b><br>" . $_SESSION['Account']['first_name'] . " ";
      echo "" . $_SESSION['Account']['last_name'] . "<br>";
      echo "" . $_SESSION['Account']['email_address'] . "<br>";

      $admintoggle = $_SESSION['Account']['admin'];

      if ($admintoggle == "1") {
        echo "(Admin Status Active)";
      }

    } 




      
   // $query = "SELECT  * from Logins WHERE email_address = '$loginemail'  AND password = '$loginpassword';";
  //  $currentlogin = mysqli_query($dbc, $query);

   // while ($row = mysql_fetch_assoc($currentlogin)) {
   //   echo "Test";
  //  }
   // echo "$row['id']";



    //$_SESSION['Account']['id'] = $currentlogin['id'];
    //$_SESSION['Account']['first_name'] = $currentlogin['first_name'];
    //$_SESSION['Account']['last_name'] = $currentlogin['last_name'];
    //$_SESSION['Account']['email_address'] = $currentlogin['email_address'];
    //$_SESSION['Account']['phone_number'] = $currentlogin['phone_number'];
    //$_SESSION['Account']['shipping_address'] = $currentlogin['shipping_address'];

  }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Css  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="index/style.css">
    <!-- Add icon library -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://kit.fontawesome.com/c70abeedb1.js" crossorigin="anonymous"></script>
        

    <title>Login / Register</title>
    <style>
      html,body{
        background: -webkit-linear-gradient(left, rgb(31, 218, 212), rgb(92, 238, 184));
        /* background: -webkit-linear-gradient(left, #5372F0, #8484f0); */
        
      }
    </style>
  </head>
  <body>

    <!---------------------------------------------------------------------------------
 *  - HEADER - Main Nav
---------------------------------------------------------------------------------------->
<header>
  <div class="zone black">
         <ul class="main-nav">
             <li><a href="" class="logo"><i class="fa-solid fa-lightbulb"></i></i>Astre Learning</a></li>
         </ul>
  </div>
 </div>
</header>


<!---------------------------------------------------------------------------------
 *  REGISTRATION - form
 ----------------------------------------------------------------------------------->
<div class="body2">
 <div class="wrapper">

  <!-- TOP Title -->
  <div class="title-text">
    <div class="title login">Login</div>
    <div class="title register">Register</div>
  </div>
  
  <!-- Slider Tab -->
  <div class="form-container">
    <div class="slide-controls">
      <input type="radio" name="slider" id="login" checked>
      <input type="radio" name="slider" id="register">
      <!-- Labels for slide tab -->
      <label for="login" class="slide login">Login</label>
      <label for="register" class="slide register">Register</label>
      <div class="slide-tab"></div>
    </div>

    <!-- LOGIN FORM -------------------------------------------------------->

    <div class="form-inner">
      <form action="#" class="login" method="post" enctype="multipart/form-data">
        <div class="field">
          <input type="text" name="email_address" placeholder="Email Address" required>
        </div>
        <div class="field">
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="pass-link"><a href="#">Forgot Password?</a></div>
        <div class="field">
          <input type="submit" value="Login">
        </div>
        <!-- Link -->
        <div class="register-link">Not a member? <a href="#">Register Now</a></div>
      </form>

      <!-- REGISTER FORM ------------------------------------------------------>

      <form action="#" class="register">
        <div class="field">
          <input type="text" placeholder="First Name" required>
        </div>
        <div class="field">
          <input type="text" placeholder="Last Name" required>
        </div>
        <div class="field">
          <input type="text" placeholder="Email Address" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Password" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Confirm Password" required>
        </div>
        <div class="field">
          <input type="submit" value="Register">
        </div>
        <!-- Link -->
        <div class="login-link">Already a member? <a href="#">Login</a></div>
      </form>
    </div>
  </div>
</div>
</div>





<!---------------------------------------------------------------------------------
 EVERYTHING BELOW IS IN THE:
 footer.php file
 
 When you create your login_register.php file
 at the bottom you will code:

 <?php
 include 'footer.php'
 ?>
 ----------------------------------------------------------------------------------->

<!-- Footer-->
<footer class="py-5 bg-dark">
  <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Astre Learning 2022</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>



<!-- Optional JavaScript -->
  <script src="index/index.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>