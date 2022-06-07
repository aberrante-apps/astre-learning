<?php 
include 'connection.php'; 
session_start();
 if (isset($_SESSION['Account']) && $_SESSION['Account']['admin'] == 1)
  {
      header('location:acctmenu_admin.php');
  } 
  else if (!isset($_SESSION['Account'])) 
  {
      header('location:login_register.php');
  }
  else {
    session_start();
  }

include 'header.php';
 ?>

<!------------------------------------------------------------------------------------- 
     LEFT-SIDE MENU DIRECTORY 
    ------------------------------------------------------------------------------------- -->
 <!-- *** This still needs to be shut up in a hamburger menu when screen is mobile *** -->
 <div class="container">
    <div class="grid-container">

        <div class="account-sidenav t-white-block">
        <h5 class="t-header-block">Account Menu</h5>
            <ul class="">
                <li class="is-active"><a href="javascript:void(0)" class="orders-btn ">Order History</a></li>
                <li><a href="javascript:void(0)"class="privacy-btn">Privacy Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

 <!--------------------------------------------------------------------------------------- 
         MIDDLE ACCOUNT COLUMN 
        ------------------------------------------------------------------------------------- -->

        <div class="account-header">
            <p class="c-account-line-title"><strong>My Account</strong></p>
            <h3><span class="account_title">Order History</span></h3>

            <div class="account-content">
        <!-- Orders -->
        <span class="content-orderHistory"><?php include ('order_history.php');?></span>

        <!-- Privacy Agreement -->
        <span class="content-privacyTerms"><?php include ('privacy-terms.php');?></span>


        </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>