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


<!-----------------------------------------------------------------
 *  ADD NEW PRODUCT TO CATALOGUE - Form
 ----------------------------------------------------------------->

 <!-- LEFT-SIDE ACCOUNT DIRECTORY -->
 <!-- *** This still needs to be shut up in a hamburger menu when screen is mobile *** -->
 <div class="grid-container">
    <div class="grid-item">
        <div class="col-12 col-4-md col-3-lg">
            <h2 class="t-header-block">
                Account Menu
            </h2>
            <ul class="col-12 col-4-md col-3-lg">
                <li class="is-active">
                    <a href="">Order History</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                    
                </li>

            </ul>
        </div>
    </div>

    <!-- MIDDLE ACCOUNT COLUMN -->
    <div class="col-12 col-4-md col-3-lg">
        <div class="">
            <p>
                <strong>My Account</strong>
            </p>
            <div class="c-account-line-title"></div>
        </div>
        <h2>Order History</h2>
        
    </div>
</div>

<?php include 'footer.php'; ?>