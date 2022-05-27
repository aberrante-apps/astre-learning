<?php
include 'connection.php';
session_start();

if (isset($_SESSION['Account']))
  {
    $userGreeting = 'Welcome back' . ", " . ($_SESSION['Account']['first_name']) . "!";
    $loginInfo = 'Logged In';
    $accountLink = 'acctmenu_customer.php';

    if (isset($_SESSION['Account']['admin']) && ($_SESSION['Account']['admin']) == 1) 
    {
      $userGreeting = 'Welcome back' . ", " . ($_SESSION['Account']['first_name']) . "!";
      $loginInfo = 'Logged In (Admin Active)';
      $accountLink = 'acctmenu_admin.php'; 
    }
  } else{
    $loginInfo = 'Not Logged In';
    $accountLink = 'login_register.php';
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
    <!-- Shopping Cart JavaScript File -->
    <script src="index/shoppingcart.js"></script>

    <title>Astre Learning</title>
  </head>
  <body>

<!--------------------------------------------------------------------------------
 *  - HEADER - Main Nav
----------------------------------------------------------------------------------->
<header>
 <div class="zone teal">
    
        <ul class="main-nav">
            <li><a href="homepage.php" class="logo"><i class="fa-solid fa-lightbulb"></i></i>Astre Learning</a></li>
            <li><span style="font-family:Dancing Script";><?php if (isset($userGreeting)) echo $userGreeting ?></span></li>
            <div class="push-left">
            <li><a href="<?php if (isset($accountLink)) echo $accountLink ?>">Account</a></li>
            <!-- cart button function -->
            <span onclick="openNav()">
            <li>
                <button type="button" class="btn shopping-cart-btn">
                    <i class="fa fa-shopping-cart" style="font-size:20px"></i>
                </button>
            </li>
        </span>
            </div>
        </ul>
 </div>
</div>

<!----------------------------------------------------------------------------------- 
    HEADER - toggle-navbar-2  
----------------------------------------------------------------------------------->

 <nav class="navbar navbar-2 navbar-expand-lg navbar-light bg-light">
    <!-- <div class="container"> -->
        <div class="row">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="homepage.php">Shop All <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link purple" style="color: white" href="page_astronomy.php">Astronomy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link green" style="color: white" href="page_biology.php">Biology</a>
          </li>
          <li class="nav-item">
            <a class="nav-link yellow" style="color: white" href="page_chemistry.php">Chemistry</a>
          </li>
          <li class="nav-item">
            <a class="nav-link blue" style="color: white" href="page_math.php">Math</a>
          </li>
          <li class="nav-item">
            <a class="nav-link orange" style="color: white" href="page_physics.php">Physics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link red" style="color: white" href="page_technology.php">Technology</a>
          </li>
      </ul>
      </div>
    </div>
<!-- </div> -->
  </nav>
</header>

<!----------------------------------------------------------------------------------- 
    SHOPPING CART - Side Nav 
----------------------------------------------------------------------------------->
<div id="mySidenav" class="sidenav">
      <div id="shopping-cart" class="shoppingcart">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times</a>
        <h2>Shopping Cart</h2>
        <div class="cart table-wrapper"> 

          <table id="myTable" class="cart-table">
            <div class="cart-header">
            <thead class="cart-header">
                <tr>
                    
                    <th class="col item" scope="col">Item</th>
                    <th class="col price" scope="col">Price</th>
                    <th class="col qty" scope="col">Qty</th>
                    <th class="col delete" scope="col"></th>
                </tr>
            </thead>
            <tbody class="cart-items" id="cart-items">
              <!-- Products added here -->
            </tbody>
            <tfoot class="cart-footer"> 
              <tr>
                <th class="col cart-subtotal" scope="col"></th>
              </tr>
            </tfoot>
          </table>
          <div class="shoppingCart-footer">
          <button type="button" class="btn checkout-btn" onclick="OpenCheckout()">Checkout</button>
        </div>
        </div>
      </div>
    </div>