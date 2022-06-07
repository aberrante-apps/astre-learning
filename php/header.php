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
  } else{
    $loginInfo = 'Not Logged In';
    // account icon will take user to login/register page
    $accountLink = 'login_register.php';
  }

//   <!--------------------------------------------------------------------------------
//  * ADD TO CART FUNCTIONALITY
// ----------------------------------------------------------------------------------->

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
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION['cart'][$count] = $item_array;
            
        } else {
            //
            // - Add 1 to the quantity
            // echo "<script>alert('Product is already added in the cart..')</script>";

            // refresh page
            echo "<script>window.location='display-products.php'</script>";
        }
    } else {
        // collect product info
        $item_array = array(
            'item_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );
        // & Create a new session['cart'] variable, that stores product
        $_SESSION['cart'][0] = $item_array;
    }
}
//-------------------------------------------------------------------------------
// DELETE  - INDIVIDUAL ITEM FROM CART
//
if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
    foreach($_SESSION["cart"] as $keys => $values)
    {
      if($values["item_id"] == $_GET["id"])
      {
        unset($_SESSION["cart"][$keys]);
        //  echo '<script>alert("Item Removed")</script>';
        echo '<script>window.location="display-products.php"</script>';
      }
    }
 }
}

// ----------------------------------------------------------------------------
// EMPTY CART
//
if(isset($_GET['action']))
{
    if ($_GET["action"] == "emptycart")
    {
        foreach($_SESSION["cart"] as $keys => $values)
        {
            unset($_SESSION["cart"][$keys]);
            echo '<script>window.location="display-products.php"</script>';
        }
    }
}

//-------------------------------------------------------------------------------
// ADD ITEM QUANTITY
//
if(isset($_POST["addButton"])) {
  // Loop through each item to find the matching id
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
        echo '<script>window.location="display-products.php"</script>';
      }
    }
  }
}

//-------------------------------------------------------------------------------
// SUBTRACT ITEM QUANTITY
//
if(isset($_POST["subtractButton"])) {
  // Loop through each item to find the matching id
  for($i = 0; $i < count($_SESSION['cart']); $i++) {
    // If the matching item id is found and there is more than one unit in the cart
    if($_SESSION['cart'][$i]["item_id"] == $_GET["id"] && $_SESSION['cart'][$i]['item_quantity'] > 1) {
      // Remove one unit of the product from the cart
      $_SESSION['cart'][$i]['item_quantity']--;
      echo '<script>window.location="display-products.php"</script>';
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
              <span onclick="openNav()">
              <li>
                <button type="button" class="btn shopping-cart-btn">
                    <i class="fa fa-shopping-cart" style="font-size:20px"> 
                    <?php
                    // CART COUNT
                    if(isset($_SESSION['cart']))
                    {
                      $count = count($_SESSION['cart']);
                      echo "<span id='cart_count'>$count</span></i>";
                    } else{
                      echo "<span id='cart_count'>0</span></i>";
                    }
                    ?>
                </button>
              </li>
              </span>
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


<!----------------------------------------------------------------------------------- 
    SHOPPING CART - Side Nav 
----------------------------------------------------------------------------------->

<div id="mySidenav" class="sidenav">
  <div id="shopping-cart" class="shoppingcart">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times</a>
    <h2>Shopping Cart</h2>
    
    <!-- CART TABLE START -->
      <div class="cart table-wrapper"> 

      <?php
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
        {
      ?>
        <table id="myTable" class="cart-table">
          <div class="cart-header">

            <!-- CART HEADER -->
              <thead class="cart-header">
                <tr>
                  <th class="col item" scope="col">Item</th>
                  <th class="col price" scope="col">Price</th>
                  <th class="col qty" scope="col">Qty</th>
                  <th class="col total" scope="col">Total</th>
                  <th class="col delete" scope="col"></th>
                </tr>
              </thead>
        
      <?php
          foreach($_SESSION['cart'] as $keys => $values)
          {
      ?>
              <!-- CART BODY -->
              <tbody class="cart-items" id="cart-items">
                <tr class=item-info>
                  <td><?php echo $values['item_name']; ?></td>
                  <td>$<?php echo $values['item_price'];?></td>
                  <!-- Quantity -->
                  <td>
                    <form method="POST" action="display-products.php?action=subtractFromQuantity&id=<?php echo $values['item_id']; ?>" >
                      <button type="submit" name="subtractButton" class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
                    </form>
                    <?php echo $values['item_quantity'];?>
                    <form method="POST" action="display-products.php?action=addToQuantity&id=<?php echo $values['item_id']; ?>">
                      <button type="submit" name="addButton" class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
                    </form>
                  </td>
                  <td>$<?php echo number_format($values['item_quantity'] * $values['item_price'], 2);?></td>
                  <td><a href="display-products.php?action=delete&id=<?php echo $values['item_id']; ?>"><span class="bi bi-trash" style="color:red;"></span></a></td>
                </tr>
        <?php 
                  $total = $total + ($values['item_quantity'] * $values['item_price']); 
        ?> 
              </tbody>

        <?php 
          } 
        ?>
              <!-- CART FOOTER -->
              <tfoot class="cart-footer"> 
              <th>
                <tr class="col cart-subtotal" scope="col">
                <td><strong>Subtotal: $<?php echo number_format($total, 2); ?></strong></td>
                  
                  <!-- <button type="submit" name="emptycart" class="emptycart" value="Empty Cart">Empty Cart</button> -->
                  <td><a href="display-products.php?action=emptycart&id=<?php echo $values['item_id']; ?>">Empty</a></td>
                </tr>
              </th>
            </tfoot>
          </table>
          <div class="shoppingCart-footer">
          <button type="button" class="btn checkout-btn" onclick="OpenCheckout()">Checkout</button>
        </div>
        <?php
               
        } else
          {
            $total = 0;
            echo '<tr><td><h5>Your cart is empty</td></tr></h5>';
          }
      ?>
        
        </div>
      </div>
    </div>
