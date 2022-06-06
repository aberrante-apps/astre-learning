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

      $existencecheck = "SELECT * FROM Logins WHERE email_address = '$loginemail';";
      $existenceresult = mysqli_query($dbc, $existencecheck);

      if (@mysqli_num_rows($existenceresult) < 1) {
  
        // Query & Result
        $query = "INSERT INTO Logins (first_name, last_name, email_address, password, admin) VALUES ('$first', '$last', '$loginemail', '$passwordhash', false);";
        mysqli_query($dbc, $query);

        $search = "SELECT  * from Logins WHERE email_address = '$loginemail' AND password = '$passwordhash';";
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

          // PRIVACY AGREEMENT
          $_SESSION['Account']['data_permission'] = $row[8];
  
  
          $admintoggle = $_SESSION['Account']['admin'];
          header('location:homepage.php');
        
        } else {
          header('location:login_register.php');
          echo '<script>alert("There was an error with the system, registration was unsuccessful.")</script>';
        }
        
      } else {
        $emailErr = "Email is already registered with an account.";
        echo '<script>alert("This email is already registered with an account.")</script>';

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

         // PRIVACY AGREEMENT
        $_SESSION['Account']['data_permission'] = $row[8];
  
  
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

    <!-- W3 Schools Modal stylesheet -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>Login / Register</title>
    <style>
      html,body{
        background: -webkit-linear-gradient(left, rgb(31, 218, 212), rgb(92, 238, 184));
        /* background: -webkit-linear-gradient(left, #5372F0, #8484f0); */
        
      }
    </style>
  </head>
  <body class="brandpurple">

<!---------------------------------------------------------------------------------
 *  - HEADER - Main Nav
---------------------------------------------------------------------------------------->
<header>
  <div class="black">
  <div class="container">
    <div class="row">
         <ul class="col main-nav">
             <li><a href="homepage.php" class="logo" style="color:white; font-size:1em;"><i class="fa-solid fa-lightbulb"></i></i>Astre Learning</a></li>
         </ul>
  </div>
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

      <form action="<?php if (isset($registrationError)) echo $registrationError?>" method="POST" action class="register">

<div class="field">
  <input type="text" name="first_name" id="firstname" placeholder="First Name" required>
</div>
<span class="error_form" id="firstname_error_message"></span>

<div class="field">
  <input type="text" name="last_name" id="lastname" placeholder="Last Name" required>
</div>
<span class="error_form" id="lastname_error_message"></span>

<div class="field">
  <input type="text" name="email_address" id="register_email" placeholder="Email Address" required>
</div>
<span class="error_form" id="registerEmail_error_message"></span>
<span class="error"><?php echo $emailErr;?></span>

<div class="field">
  <input type="password" id="register_password" placeholder="Password" required>
</div>
<span class="error_form" id="registerPassword_error_message"></span>

<div class="field">
  <input type="password" name="password" id="samepass" placeholder="Confirm Password" required>
</div>
<span class="error_form" id="samepass_error_message"></span>

<!-- PRIVACY AGREEMENT CHECKBOX -->
<div class="privacy-terms-checkbox text-center">
  <br><input type="checkbox" id="privacy-agreement" name="privacy-agreement" value="">
  <label for="privacy-agreement">I agree to the terms of </label>
  <a href='javascript:void(0)' onclick="document.getElementById('id01').style.display='block'"> Astre Learning Service and Privacy Policy</a><br>

</div>

<div class="field">
  <input type="submit"class="validate-registration" name="register" value="Register">
</div>
<span class="error_form" id="registerValidateForm_error_message" style="color:red; font-size:15px;"></span>



<!-- Link -->
<div class="login-link">Already a member? <a href="javascript:void(0)">Login</a></div>
</form>
</div>
</div>
</div>
</div>

<!-- PRIVACY AGREEMENT MODAL -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <div class="p-4">
        <h2>Terms of Service and Privacy Agreement</h2>
<p>As of September 32nd, 2022, the Canadian Federal Government will introduce the General Data Protection Regulation, a new law that will require you (the User) to give explicit permission for us at Astre Learning (the Service Provider) to store and use your personal data while shopping at our online store (the Service), as well as providing you with the right to know who will access your data and how it will be used. In accordance to this new law, we advise that you read this document carefully before you consent to our Terms of Service and Privacy Agreement.</p>
<br>
<h3>Assumptions</h3>
<p>By creating an account with Astre Learning, the Service Provider assumes that the User is over the age of 18 or that the User is supervised by a parent/guardian over the age of 18. The Service Provider further assumes that the User has read through these Terms of Service and Privacy Agreement and can comprehend everything herein. With that said, the Service is merely a school project that doesn’t actually sell anything or have any real world service or functionality beyond demonstrating that the students who put this website together know how web design works. Even so, this document has been drafted to give a decent look and feel that Lorem Ipsum text cannot properly impart. I am not a lawyer, so I have no idea if this document is actually legally binding. For the sake of argument, the User must treat this document as legally binding.</p>
<br>
<h3>Data Usage</h3>
<p>As required by the General Data Protection Regulation, the User has the right to know how their data will be used:</p>
<ul>
    <li>Most of the User's data will be stored on the Service Provider's database. Such data includes the User's name, email address, phone number, shipping address, shopping cart contents, and order history. These will be saved for ease of use when making future orders.</li>
    <li>The User's credit card information will not be saved on the database. Parts of it, however, may be saved on the Service Provider's server as part of a file with the User's order details which will be emailed to the company founder, Dr. Deidre Astre, to fulfill later.</li>
    <li>The email address will be used for logging into the Service.</li>
    <li>The shipping address will be used for sening orders to the User after the order is made.</li>
    <li>The phone number will be used to call the User in case something goes wrong with the order, such as if there is a delay in shipping.</li>
    <li>Shopping cart contents will be saved to allow the User to access their shopping cart contents from any device they wish to use at any time.</li>
    <li>Order history will be saved as a record of past transactions.</li>
    <li>Credict card information will be processed through Stripe, a third party payment processor. They probably have their own Terms of Service for the User too.</li>
</ul>
<br>
<h3>Terms of Service</h3>
<p>By agreeing and consenting to the Data Usage as described above, the User will have full functionality to use the Service. By disagreeing and not consenting to the Data Usage as described above, further collection of the User's data such as order history and shopping cart contents will cease, but the User will not have full functionality to use the Service. The User will also not hold the Service Provider liable for any damages as the Service Provider does not actually exist in the real world. Again this is a school project with no real functionality nor products to sell. In any case, the User can change their mind at any time regarding Data Usage by visiting the Privacy Agreement settings in the Account menu.</p>
      </div>
    </div>
  </div>
</div>
    </div>

  <?php include ('footer.php'); ?>
 