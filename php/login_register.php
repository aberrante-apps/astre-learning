<?php

include 'connection.php';
session_start();

if (isset($_SESSION['Account']) && $_SESSION['Account']['admin'] == 0)
  {
      header('location:acctmenu_admin.php');
  } 
  else if (isset($_SESSION['Account']) && $_SESSION['Account']['admin'] == 1)
  {
    header('location:acctmenu_admin.php');
  }
  else {
    session_start();
  }



if($_SERVER["REQUEST_METHOD"] === "POST") {

  global $dbc;
  $loginemail = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['email_address'])));
  $loginpassword = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password'])));
  $passwordhash = sha1($loginpassword);

  if (isset($_POST['register'])){

    if (isset($_POST['email_address']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name'])) {
      $first = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['first_name'])));
      $last = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['last_name'])));

      $existencecheck = "SELECT * FROM Logins 
      WHERE
      email_address = '$loginemail';";
      $existenceresult = mysqli_query($dbc, $existencecheck);

      if (@mysqli_num_rows($existenceresult) < 1) {
  
        // Query & Result
        $query = "INSERT INTO Logins 
        (first_name, last_name, email_address, password, admin)
        VALUES
        ('$first', '$last', '$loginemail', '$passwordhash', false);";
        mysqli_query($dbc, $query);

        $search = "SELECT  * from Logins WHERE email_address = '$loginemail'  AND password = '$passwordhash';";
        $result = mysqli_query($dbc, $search);
  
        if (@mysqli_num_rows($result) == 1) {
  
          $row = $result -> fetch_array(MYSQLI_NUM);
          $_SESSION['Account']['id'] = $row[0];
          $_SESSION['Account']['first_name'] = $row[1];
          $_SESSION['Account']['last_name'] = $row[2];
          $_SESSION['Account']['email_address'] = $row[3];
          $_SESSION['Account']['phone_number'] = $row[4];
          $_SESSION['Account']['shipping_address'] = $row[6];
          $_SESSION['Account']['admin'] = $row[7];
  
  
          $admintoggle = $_SESSION['Account']['admin'];
          header('location:homepage.php');
        
        } else {
          $registrationError = 'Registration unsuccessful. Please try again.';
        }
        
      } else {
        $registrationError = 'Email address is already registered.';
      }
    } 
  }   
  
  else {
    if (isset($_POST['email_address']) && isset($_POST['password'])) {


  
      // Query & Result
      $query = "SELECT  * from Logins WHERE email_address = '$loginemail'  AND password = '$passwordhash';";
      $result = mysqli_query($dbc, $query);
  
      if (@mysqli_num_rows($result) == 1) {
  
        $row = $result -> fetch_array(MYSQLI_NUM);
        $_SESSION['Account']['id'] = $row[0];
        $_SESSION['Account']['first_name'] = $row[1];
        $_SESSION['Account']['last_name'] = $row[2];
        $_SESSION['Account']['email_address'] = $row[3];
        $_SESSION['Account']['phone_number'] = $row[4];
        $_SESSION['Account']['shipping_address'] = $row[6];
        $_SESSION['Account']['admin'] = $row[7];
  
  
        $admintoggle = $_SESSION['Account']['admin'];
        header('location:homepage.php');
        
      } else {
        $loginError = 'Wrong email address or password. Try again.';
      }
    } 
  } 
}



?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Css  -->
    <link rel="stylesheet" type="text/css" href="index/style.css">
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c70abeedb1.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Dancing Script' rel='stylesheet'> 

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
             <li><a href="homepage.php" class="logo"><i class="fa-solid fa-lightbulb"></i></i>Astre Learning</a></li>
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
      <form action="" method="POST" class="login" enctype="multipart/form-data">
        <div class="field">
          <input type="text" name="email_address" id="email" placeholder="Email Address" >
        </div>
        <span class="error_form" id="email_error_message"></span>

        <div class="field">
          <input type="password" name="password" id="password" placeholder="Password"  >
        </div>
        <span class="error_form" id="password_error_message"></span>

        <!-- <div class="pass-link"><a><span>Forgot Password?<span></a></div> -->
        <div class="field">
          <input type="submit" value="Login">
        </div>
        <span style="color:red;"><?php if (isset($loginError)) echo $loginError ?></span>
        <!-- Link -->
        <div class="register-link">Not a member? <a href="#">Register Now</a></div>
      </form>

       

      <!-- REGISTER FORM ------------------------------------------------------>

      <form action="" method="POST" action class="register">
        <div class="field">
          <input type="text" name = "first_name" placeholder="First Name" required>
        </div>
        <div class="field">
          <input type="text" name = "last_name" placeholder="Last Name" required>
        </div>
        <div class="field">
          <input type="text" name = "email_address" placeholder="Email Address" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Password" required>
        </div>
        <div class="field">
          <input type="password" name="password" placeholder="Confirm Password" required>
        </div>
        <div class="field">
          <input type="submit" name="register" value="Register">
        </div>
        <span style="color:red;"><?php if (isset($registrationError)) echo $registrationError ?></span>
        <!-- Link -->
        <div class="login-link">Already a member? <a href="#">Login</a></div>
      </form>
    </div>
  </div>
</div>
</div>



    <div class="container">
        <div class="row text-muted">
          <p><?php if (isset($loginInfo)) echo $loginInfo ?></p>
        </div>
        <div class="col m-0 justify-content-center text-white">
          <p>Copyright &copy; Astre Learning 2022</p>
        </div>
    </div>



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
 