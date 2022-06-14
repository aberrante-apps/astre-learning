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
    $userGreeting = 'Hi' . " " . ($_SESSION['Account']['first_name']) . "!";
        // display 'logged in' in footer
    $loginInfo = 'Logged In';
        // account icon will take user to Customer account menu
    $accountLink = 'acctmenu_customer.php';

    // if the there is an account session and the user is logged in as an admin
    if (isset($_SESSION['Account']['admin']) && ($_SESSION['Account']['admin']) == 1) 
    {
          // display greeting of user's name in header
      $userGreeting = 'Hi' . " " . ($_SESSION['Account']['first_name']) . "!";
          // display 'logged in as an admin' in footer
      $loginInfo = 'Logged In (Admin Active)';
          // account icon will take user to Admin account menu
      $accountLink = 'acctmenu_admin.php'; 
    }

    $currentCartQuery = "SELECT * FROM Cart WHERE login_id = " . $_SESSION['Account']['id'] . ";";
    $currentCartQuery_result = mysqli_query($dbc, $currentCartQuery);

    if(mysqli_num_rows($currentCartQuery_result) > 0) {

      $numRowGet = mysqli_num_rows($currentCartQuery_result);
      $prodCount = 0;

      while ($prodCount < $numRowGet) {

        $queryRow = mysqli_fetch_assoc($currentCartQuery_result);
        $queryRow_prod = $queryRow['product_id'];
        $queryRow_quantity = $queryRow['quantity'];
        $productLookup = "SELECT * FROM Products WHERE id = '$queryRow_prod';";
        $productLookup_result = mysqli_query($dbc, $productLookup);

        if(mysqli_num_rows($productLookup_result) == 1) {
          $LookupRow = mysqli_fetch_assoc($productLookup_result);
          $prodToAdd_picture = $LookupRow['picture'];
          $prodToAdd_name = $LookupRow['name'];
          $prodToAdd_price = $LookupRow['price'];
      
          $prodToAdd_array = array(
            'item_id' => $queryRow_prod,
            'item_picture' => $prodToAdd_picture,
            'item_name' => $prodToAdd_name,
            'item_price' => $prodToAdd_price,
            'item_quantity' => $queryRow_quantity
          );
          $_SESSION['cart'][$prodCount] = $prodToAdd_array;
        }
        $prodCount++;
      }
    }
  } else{
    $loginInfo = 'Not Logged In';
    // account icon will take user to login/register page
    $accountLink = 'login_register.php';
  }



//   
?>
<!--------------------------------------------------------------------------------
//  * ADD TO CART FUNCTIONALITY
// ----------------------------------------------------------------------------------->
<?php
// if 'add-to-cart' has been clicked:
if(isset($_POST['add_to_cart'])) 
{
  
    // if a cart session already exists:
    if(isset($_SESSION['cart'])) 
    {    
        $item_array_id = array_column($_SESSION['cart'], "item_id");

        // if the product is not already in the array
        if(!in_array($_GET['id'], $item_array_id)) 
        {
            // add to count
            $count = count($_SESSION['cart']);
            // store item info into an array
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_picture' => $_POST["hidden_picture"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION['cart'][$count] = $item_array;

           
            
        } else {
          for($i = 0; $i < count($_SESSION['cart']); $i++) {
            // If the matching item id is found
            if($_SESSION['cart'][$i]["item_id"] == $_GET["id"])
            {
              // First, check to see how much of the product is currently in stock
              $productStockQuery = "SELECT stock FROM Products WHERE id = " . $_SESSION['cart'][$i]["item_id"] . ";";
              $productStock = 0;
              $result = mysqli_query($dbc, $productStockQuery);
              if ($result) {
                $row = $result -> fetch_array(MYSQLI_NUM);
                $productStock = $row[0];
              } else {
                print "<h3>SQL ERROR: " . $productStockQuery . "<br></h3>";
                print mysqli_error($dbc);
              }
        
              // Then increase the item quantity in the cart if it doesn't exceed the amount in stock
              if ($_SESSION['cart'][$i]['item_quantity'] < $productStock) {
                $_SESSION['cart'][$i]['item_quantity']++;

                
                header("Refresh:0");
              }
            }
          }
            // refresh page
            header("Refresh:0");
        }
    } else {
        // collect product info
        $item_array = array(
            'item_id' => $_GET["id"],
            'item_picture' => $_POST["hidden_picture"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );
        // & Create a new session['cart'] variable, that stores product
        $_SESSION['cart'][0] = $item_array;
    }

    //----------------------------------------------------
    // STORE CART IN DATABASE - R10 R09
    // ----------------------------------------------------

    if(isset($_SESSION['Account'])) {

      $overwritecheck_product = $_GET["id"];
      $overwritecheck_login = $_SESSION['Account']['id'];
      $overwritecheck = "SELECT * FROM Cart WHERE product_id = '$overwritecheck_product' AND login_id = '$overwritecheck_login';";
      $overwritecheck_result = mysqli_query($dbc, $overwritecheck);

      if (@mysqli_num_rows($overwritecheck_result) == 1) {

        $carttable_newquantity = $_POST["quantity"];
        $carttable_update = "UPDATE Cart SET quantity = '$carttable_newquantity' WHERE (product_id = '$overwritecheck_product' AND login_id = '$overwritecheck_login');";
        $carttable_update_result = mysqli_query($dbc, $carttable_update);     

      } else {

        $carttable_new = "INSERT INTO Cart (login_id, product_id, quantity) VALUES ('$overwritecheck_login', '$overwritecheck_product', 1);";
        $carttable_new_result = mysqli_query($dbc, $carttable_new);
      }
    }
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

<!--------------------------------------------------------------------------------
 *  - HEADER - Main Nav
----------------------------------------------------------------------------------->

<header>
  <div class="brandpurple">
    <div class="container">
      <div class="row">
        <ul class="col main-nav">
            <li><a href="homepage.php" class="logo"><i class="fa-solid fa-lightbulb"></i></i>Astre Learning</a></li>
            <li><span style="font-family:Dancing Script; color:white;"><?php if (isset($userGreeting)) echo $userGreeting ?></span></li>
            <div class="push-left">
              <li><a href="<?php if (isset($accountLink)) echo $accountLink ?>">Account</a></li>
              <!-- cart button function -->
              <!-- <span onclick="openNav()"> -->
                <a href="shopping-cart.php">
              <li>
              <button type="button" class="btn shopping-cart-btn">
                    <i class="fa fa-shopping-cart" style="font-size:20px"></i>
                </button>
              </li>
                  </a>
              <!-- </span> -->
          </div>
        </ul>
      </div>
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
            <a class="nav-link" id="hover hover-purple" href="page_astronomy.php">Astronomy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="hover hover-green" href="page_biology.php">Biology</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="hover hover-yellow" href="page_chemistry.php">Chemistry</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="hover hover-blue" href="page_math.php">Math</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="hover hover-orange" href="page_physics.php">Physics</a>
          </li>
          <li class="nav-item" >
            <a class="nav-link" id="hover hover-red"  href="page_technology.php">Technology</a>
          </li>
      </ul>
      </div>
    </div>
<!-- </div> -->
  </nav>
</header>
