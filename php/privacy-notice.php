<?php
include 'connection.php';
session_start();

// HEADER FUNCTIONALITY

// <!--------------------------------------------------------------------------------
//  *  SESSION TRACKING - for not logged in, logged in as customer, and logged in as Admin
// ----------------------------------------------------------------------------------->

// if there is an account session: 
if (isset($_SESSION['Account']))
  {
        // display greeting of user's name in header
    $userGreeting = 'Welcome back' . ", " . ($_SESSION['Account']['first_name']) . "!";
        // display 'logged in' in footer
    $loginInfo = 'Logged In';
        // account icon will take user to Customer account menu
    $accountLink = 'acctmenu_customer.php';

    // if the there is an account session and the user is logged in as an admin
    if (isset($_SESSION['Account']['admin']) && ($_SESSION['Account']['admin']) == 1) 
    {
          // display greeting of user's name in header
      $userGreeting = 'Welcome back' . ", " . ($_SESSION['Account']['first_name']) . "!";
          // display 'logged in as an admin' in footer
      $loginInfo = 'Logged In (Admin Active)';
          // account icon will take user to Admin account menu
      $accountLink = 'acctmenu_admin.php'; 
    }
  } else{
    $loginInfo = 'Not Logged In';
    // account icon will take user to login/register page
    $accountLink = 'login_register.php';
  }

?>

<!--------------------------------------------------------------------------------
---- HEADER HTML  
----------------------------------------------------------------------------------->
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
        <!-- Shopping Cart JavaScript File
        <script src="index/shoppingcart.js"></script> -->

        <title>Astre Learning</title>
    </head>

    <body>
    <header>
        <div class="brandpurple">
            <div class="container">
            <div class="row">
                <ul class="col main-nav">
                    <li><a class="logo"><i class="fa-solid fa-lightbulb"></i></i>Astre Learning</a></li>
                    <li><span style="font-family:Dancing Script; color:white;"><?php if (isset($userGreeting)) echo $userGreeting ?></span></li>
                    <div class="push-left">
                </div>
                </ul>
            </div>
            </div>
        </div>
    </header>

    <?php
    include 'privacy-terms2.php';
    ?>

    <script src="index/index.js"></script>
    </body>
</html>