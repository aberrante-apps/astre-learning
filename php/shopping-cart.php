<?php 
include ('connection.php');
session_start();
include ('header.php');

// SHOPPING CART

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
        echo '<script>window.location="shopping-cart.php"</script>';
      }
    }

//----------------------------------------------------
// Update CART IN DATABASE - R10 R09
// ----------------------------------------------------

    // if(isset($_SESSION['Account'])) {
    //   $productremoval_product = $_GET["id"];
    //   $productremoval_login = $_SESSION['Account']['id'];
    //   $productremoval = "DELETE FROM Cart WHERE (product_id = '$productremoval_product' AND login_id = '$productremoval_login');";
    //   mysqli_query($dbc, $productremoval);
    // }
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
            echo '<script>window.location="shopping-cart.php"</script>';
        }
//----------------------------------------------------
// Update CART IN DATABASE - R10 R09
// ----------------------------------------------------
    // if(isset($_SESSION['Account'])) {

    //   $cartremoval_login = $_SESSION['Account']['id'];
    //   $cartremoval = "DELETE FROM Cart WHERE login_id = '$cartremoval_login';";
    //   mysqli_query($dbc, $cartremoval);
    // }
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
       
// DATABASE 
        // $passthroughquantity = $_SESSION['cart'][$i]['item_quantity'];

        echo '<script>window.location="shopping-cart.php"</script>';

//----------------------------------------------------
// Update CART IN DATABASE - R10 R09
// ----------------------------------------------------

        // if(isset($_SESSION['Account'])) {

  
        //   $quantityincreasecheck_product = $_GET["id"];
        //   $quantityincreasecheck_login = $_SESSION['Account']['id'];
        //   $quantityincreasecheck = "SELECT * FROM Cart WHERE product_id = '$quantityincreasecheck_product' AND login_id = '$quantityincreasecheck_login';";
        //   $quantityincreasecheck_result = mysqli_query($dbc, $quantityincreasecheck);

        //   if (@mysqli_num_rows($quantityincreasecheck_result) == 1) {
    
        //     $quantityincrease_update = "UPDATE Cart SET quantity = '$passthroughquantity' WHERE (product_id = '$quantityincreasecheck_product' AND login_id = '$quantityincreasecheck_login');";
        //     mysqli_query($dbc, $quantityincrease_update);     
    
        //   } else {
        //     $quantityincrease_new = "INSERT INTO Cart (login_id, product_id, quantity) VALUES ('$quantityincreasecheck_login', '$quantityincreasecheck_product', '$passthroughquantity');";
        //     mysqli_query($dbc, $quantityincrease_new);
        //   }
        // }

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
      echo '<script>window.location="shopping-cart.php"</script>';

//----------------------------------------------------
// Update CART IN DATABASE - R10 R09
// ----------------------------------------------------

    // $passthroughquantity = $_SESSION['cart'][$i]['item_quantity'];

    // if(isset($_SESSION['Account'])) {

    //   $quantitydecreasecheck_product = $_GET["id"];
    //   $quantitydecreasecheck_login = $_SESSION['Account']['id'];
    //   $quantitydecreasecheck = "SELECT * FROM Cart WHERE product_id = '$quantitydecreasecheck_product' AND login_id = '$quantitydecreasecheck_login';";
    //   $quantitydecreasecheck_result = mysqli_query($dbc, $quantitydecreasecheck);


    //   if (@mysqli_num_rows($quantitydecreasecheck_result) == 1) {


    //     if ($passthroughquantity != 0) {

    //       $quantitydecrease_update = "UPDATE Cart SET quantity = '$passthroughquantity' WHERE (product_id = '$quantitydecreasecheck_product' AND login_id = '$quantitydecreasecheck_login');";
    //       mysqli_query($dbc, $quantitydecrease_update);     
    //     }
    //     else {
    //       $quantitydecrease_removal = "DELETE FROM Cart WHERE (product_id = '$quantitydecreasecheck_product' AND login_id = '$quantitydecreasecheck_login');";
    //       mysqli_query($dbc, $quantitydecrease_removal);
    //     }

    //   } else {
    //     $quantitydecrease_removal = "DELETE FROM Cart WHERE (product_id = '$quantitydecreasecheck_product' AND login_id = '$quantitydecreasecheck_login');";
    //     mysqli_query($dbc, $quantitydecrease_removal);
    //   }
    // }

    }
  }
}
?>

<!--------------------------------------------------------------------------------
//  * SHOPPING CART
// ----------------------------------------------------------------------------------->

<div class="page-contents">
  <div class="container" id="shoppingcart">
    <div class="grid-container">
      <div id="shopping-cart" class="shoppingcart">
      <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times</a> -->
        <h4 class="cart-title"><strong>My Cart </strong></h4>
            
    
      <!-- CART TABLE START -->
      <div class="cart table-wrapper t-white-block"> 

      <?php
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
        {
      ?>
        <table id="myTable" class="cart-table">
          <div class="cart-header">

            <!-- CART HEADER -->
            <thead class="cart-header">
              <tr>
                <th class="col delete" scope="col"><a href="shopping-cart.php?action=emptycart&id=<?php echo $values['item_id']; ?>" style="color:grey;font-size:15px;" class="empty">Empty</a></th>
                <th class="col image" scope="col"></th>
                <th class="col item" scope="col">Product Details</th>
                <th class="col price" scope="col">Each</th>
                <th class="col qty" scope="col">Quantity</th>
                <th class="col total" scope="col">Total</th>
                  
              </tr>
            </thead>
        
      <?php
          foreach($_SESSION['cart'] as $keys => $values)
          {
      ?>
              <!-- CART BODY -->
              <tbody class="cart-items" id="cart-items">
                <tr class=item-info>
                  <!-- delete item -->
                  <td style="width:5%;"><a href="shopping-cart.php?action=delete&id=<?php echo $values['item_id']; ?>"><span style="color:grey;font-size:15px;" ><i class="bi bi-x-circle"></i></span></a></td>
                  <!-- Picture -->
                  <td><img src="<?php echo $values['item_picture']; ?>" height=125 width=125></img></td>
                  <!-- Name -->
                  <td class="text-left"><?php echo $values['item_name']; ?></td>
                  <!-- Price -->
                  <td style="width:5%;">$<?php echo $values['item_price'];?></td>

                  <!-- Quantity -->
                  <td style="width:15%;align-items:center;">
                  <div class= row>
                    <form method="POST" action="shopping-cart.php?action=subtractFromQuantity&id=<?php echo $values['item_id']; ?>" >
                    <!-- Subtract -->
                      <button type="submit" name="subtractButton" class="btn-update"><i class="bi bi-dash-circle" style="font-size:20px;"></i></button>
                    </form>

                    <?php echo $values['item_quantity'];?>
                    
                    <form method="POST" action="shopping-cart.php?action=addToQuantity&id=<?php echo $values['item_id']; ?>">
                    <!-- Add -->
                      <button type="submit" name="addButton" class="btn-update"><i class="bi bi-plus-circle-fill" style="font-size:20px;"></i></button>
                    </form>
                  </div>
                  </td>
                  <!-- Total -->
                  <td style="width:5%; ">$<?php echo number_format($values['item_quantity'] * $values['item_price'], 2);?></td>
                  
                </tr>
                
        <?php 
                  $total = $total + ($values['item_quantity'] * $values['item_price']); 
        ?> 
              </tbody>

        <?php 
          } 
        ?>
            <tr class="alt-option">
              <td></td>
              <!-- Keep-Shopping Option -->
              <td>
                <strong><a href="homepage.php" class="keep-shopping2"><i class="bi bi-arrow-left-circle-fill"> </i> Keep Shopping</a></strong>
              </td>
            </tr>
          </table>
        </div>
          <!-- Cart Total -->
        <div class="cart total-wrapper col-6 ">
        <h4><strong>Cart Total</strong></h4>
        <div class="t-white-block">
          <table class="cart-total">
          <tr>
          <td><strong>Subtotal: </strong></td>
          <td> <strong>$<?php echo number_format($total, 2); ?></strong></td>
          </tr>
          </table>
        </div>
        <button type="button" class="btn checkout-btn" onclick="OpenCheckout()">Proceed to Checkout</button>
        </div>
        
        <?php     
        } else
          {
            $total = 0;
            echo '<tr><td><h5>Your cart is empty</td></tr></h5>';
            echo '<br><br>';
            echo '<strong><a href="homepage.php" class="keep-shopping push-center"> Keep Shopping?</a></strong>';
          }
      ?>
        </div> <!-- .shoppingcart #shopping-cart -->
        </div> <!-- .grid-container end -->
        </div> <!-- .container  #shoppingcart  end -->
        </div> <!-- Page Contents end -->
        
