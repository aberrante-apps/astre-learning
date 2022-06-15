<?php 
include ('connection.php');
session_start();
include ('header.php');

// Preparation for Stripe Payment Handling
require_once('shopping-cart/config.php');

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

    if(isset($_SESSION['Account'])) {
      $productremoval_product = $_GET["id"];
      $productremoval_login = $_SESSION['Account']['id'];
      $productremoval = "DELETE FROM Cart WHERE (product_id = '$productremoval_product' AND login_id = '$productremoval_login');";
      mysqli_query($dbc, $productremoval);
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
        echo '<script>window.location="shopping-cart.php"</script>';
      }
//----------------------------------------------------
// Update CART IN DATABASE - R10 R09
// ----------------------------------------------------
    if(isset($_SESSION['Account'])) {
      $cartremoval_login = $_SESSION['Account']['id'];
      $cartremoval = "DELETE FROM Cart WHERE login_id = '$cartremoval_login';";
      mysqli_query($dbc, $cartremoval);
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
       
// DATABASE 
        $passthroughquantity = $_SESSION['cart'][$i]['item_quantity'];
        echo '<script>window.location="shopping-cart.php"</script>';

//----------------------------------------------------
// Update CART IN DATABASE - R10 R09
// ----------------------------------------------------

      if(isset($_SESSION['Account'])) {
        $quantityincreasecheck_product = $_GET["id"];
        $quantityincreasecheck_login = $_SESSION['Account']['id'];
        $quantityincreasecheck = "SELECT * FROM Cart WHERE product_id = '$quantityincreasecheck_product' AND login_id = '$quantityincreasecheck_login';";
        $quantityincreasecheck_result = mysqli_query($dbc, $quantityincreasecheck);

        if (@mysqli_num_rows($quantityincreasecheck_result) == 1) {
          $quantityincrease_update = "UPDATE Cart SET quantity = '$passthroughquantity' WHERE (product_id = '$quantityincreasecheck_product' AND login_id = '$quantityincreasecheck_login');";
          mysqli_query($dbc, $quantityincrease_update);     

          } else {
            $quantityincrease_new = "INSERT INTO Cart (login_id, product_id, quantity) VALUES ('$quantityincreasecheck_login', '$quantityincreasecheck_product', '$passthroughquantity');";
            mysqli_query($dbc, $quantityincrease_new);
          }
        }
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

$passthroughquantity = $_SESSION['cart'][$i]['item_quantity'];

if(isset($_SESSION['Account'])) {

  $quantitydecreasecheck_product = $_GET["id"];
  $quantitydecreasecheck_login = $_SESSION['Account']['id'];
  $quantitydecreasecheck = "SELECT * FROM Cart WHERE product_id = '$quantitydecreasecheck_product' AND login_id = '$quantitydecreasecheck_login';";
  $quantitydecreasecheck_result = mysqli_query($dbc, $quantitydecreasecheck);


  if (@mysqli_num_rows($quantitydecreasecheck_result) == 1) {


    if ($passthroughquantity != 0) {

      $quantitydecrease_update = "UPDATE Cart SET quantity = '$passthroughquantity' WHERE (product_id = '$quantitydecreasecheck_product' AND login_id = '$quantitydecreasecheck_login');";
      mysqli_query($dbc, $quantitydecrease_update);     
    }
    else {
      $quantitydecrease_removal = "DELETE FROM Cart WHERE (product_id = '$quantitydecreasecheck_product' AND login_id = '$quantitydecreasecheck_login');";
      mysqli_query($dbc, $quantitydecrease_removal);
    }

  } else {
    $quantitydecrease_removal = "DELETE FROM Cart WHERE (product_id = '$quantitydecreasecheck_product' AND login_id = '$quantitydecreasecheck_login');";
    mysqli_query($dbc, $quantitydecrease_removal);
  }
}

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
                <tr class="item-info">
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
        // 
        // CALCULATING - Total, Tax, Final Order Total and what to send to Stripe
        // 
                  $total = $total + ($values['item_quantity'] * $values['item_price']);
                  $taxRate='13.00';
                  $tax=$total*$taxRate/100;
                  $orderTotal=$total+$tax;
                  // Because Stripe does things in terms of cents, not dollars
                  $stripeTotal = round(($orderTotal * 100));

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
        <?php 
        if (isset($_SESSION['Account'])){
          ?>
          <button type="button" class="btn checkout-btn open-checkout">Proceed to Checkout</button>
          <?php
        } else {
          ?>
          <a href="login_register.php" class="btn checkout-btn">Login to Checkout</a>
          <?php
        }
        ?>
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
        </form>
        </div> <!-- .shoppingcart #shopping-cart -->
        </div> <!-- .grid-container end -->
        </div> <!-- .container  #shoppingcart  end -->
        </div> <!-- Page Contents end -->

<!--------------------------------------------------------------------------------
//  * CHECKOUT MODAL - Shipping Address
// ----------------------------------------------------------------------------------->

<div id="checkoutModal" class="modal" tabindex="-1" >
  <div class="modal-content"style="width:75%;">
    <div class="modal-header">
      <a href="javascript:void(0)" class="closebtn">&times</a>
    </div>

    <div class="col-100 container ">
    <form method="POST" action="charge.php" id="checkoutModalForm" name="checkoutModalForm">

      <!-- MODAL 1 SHIPPING ADDRESS -->
      <div class="modal-body" id="shipping-address-form">
        <div class="row">
          <h3 class="title col-12">Shipping Address </h3>
          <p class="subtext col-12">All fields with an astrix(*) must be filled out</p>
        </div> 
      

        <!-- Name -->
        <div class="row">
          <div class="col-6">
            <label for="fname" class="required"><i class="bi bi-person-fill"></i> First Name</label>
            <span class="error_form" id="fname_error_message"></span>
            <input type="text" id="fname" name="fname" required>
          </div>
          <div class="col-6">
            <label for="lname" class="required"><i class="bi bi-person-fill"> </i> Last Name</label>
            <span class="error_form" id="lname_error_message"></span>
            <input type="text" id="lname" name="lname" required>
          </div>
        </div>
      

      <!-- Email -->
        <div class="row">
          <div class="col-6">
            <label for="email" class="required"><i class="bi bi-envelope-fill"></i> Email</label> 
            <span class="error_form" id="email_error_message"></span>
            <input type="text" id="email" name="email" placeholder="you@example.com" required>
          </div>

          <!-- Phone -->
          <div class="col-6">
            <label for="phone" class="required"><i class="bi bi-telephone-fill"></i> Phone Number</label>
            <span class="error_form" id="phone_error_message"></span>
            <input type="text" id="phone" name="phone" placeholder="(___) ___-____" required>
          </div>
        </div>
          <!-- Address -->
      <div class="row">
        <div class="col-12">
        <label for="adr" class="required"><i class="bi bi-house-door-fill"></i> Street Address</label>
        <span class="error_form" id="address_error_message"></span>
        <input type="text" id="adr" name="adr" placeholder="123 Example St S" required>
        
        <input type="text" id="adr2" name="adr2" placeholder="Apartment, suite, unit, etc (optional)">
        </div>
      </div>

      <div class="row">
        <!-- City -->
        <div class="col-8">
          <label for="city" class="required"><i class="bi bi-building"></i> City</label>
          <span class="error_form" id="city_error_message"></span>
          <input type="text" id="city" name="city" placeholder="City..." required>
        </div>

        <!-- Country -->
        <div class="col-4">
        <label for="country" class="required"><i class="bi bi-flag-fill"></i> Country</label>
        <select id="country" name="country">
          <option value="Canada">Canada</option>
        </select>
        </div>
        </div>

        <div class="row">
        <!-- Province -->
        <div class="col-5">
        <label for="province" class="required">Province</label>
        <span class="error_form" id="province_error_message"></span>
        <select id="province" name="province">
                  <option value="">Select a Province..</option>
                  <option value="AB">Alberta</option>
                  <option value="BC">British Columbia</option>
                  <option value="MB">Manitoba</option>
                  <option value="NB">New Brunswick</option>
                  <option value="NL">Newfoundland and Labrador</option>
                  <option value="NS">Nova Scotia</option>
                  <option value="ON">Ontario</option>
                  <option value="PE">Prince Edward Island</option>
                  <option value="QC">Quebec</option>
                  <option value="SK">Saskatchewan</option>
                  <option value="NT">Northwest Territories</option>
                  <option value="NU">Nunavut</option>
                  <option value="YT">Yukon</option>
        </select>
        </div>
    
      <!-- Postal Code -->
      <div class="col-5">
      <label for="postalcode" class="required">Postal Code</label>
        <span class="error_form" id="pcode_error_message"></span>
        <input type="text" id="postalcode" name="postalcode" placeholder="A1A 1A1" required>
        </select>
      </div>
      </div>
      <div class="col-12">
      <button type="button" class="btn validateShipping-btn push-left">Continue</button>
          <span class="error_form" id="validate_error_message"></span>
        </div>
        </div> <!-- modal body-->  <!-- Shipping MODAL END -->

<!--------------------------------------------------------------------------------
//  * CHECKOUT MODAL 2 - Billing Address
// ----------------------------------------------------------------------------------->

<div class="modal-body" id="billing-address-form">
  <div class="row">
    <h3 class="title col-12">Billing Address </h3>
    <p class="subtext col-6">All fields with an astrix(*) must be filled out</p>
    <label class="col-6 push-left check-address"> <input type="checkbox"  value="" id="check-address"> Same as Shipping?</label></b></p>
  </div> 
      

  <!-- Name -->
  <div class="row">
    <div class="col-6">
      <label for="fname" class="required"><i class="bi bi-person-fill"></i> First Name</label>
      <span class="error_form" id="fname_error_message"></span>
      <input type="text" id="billing_fname" name="billing_fname" required>
    </div>
    <div class="col-6">
      <label for="lname" class="required"><i class="bi bi-person-fill"> </i> Last Name</label>
      <span class="error_form" id="lname_error_message"></span>
      <input type="text" id="billing_lname" name="billing_lname" required>
    </div>
  </div>
      

  <!-- Phone -->
  <div class="row">
    <div class="col-12">
      <label for="phone" class="required"><i class="bi bi-telephone-fill"></i> Phone Number</label>
      <span class="error_form" id="phone_error_message"></span>
      <input type="text" id="billing_phone" name="billing_phone" placeholder="(___) ___-____" required>
    </div>
  </div>

  <!-- Street Address -->
  <div class="row">
    <div class="col-12">
    <label for="adr" class="required"><i class="bi bi-house-door-fill"></i> Street Address</label>
    <span class="error_form" id="address_error_message"></span>
    <input type="text" id="billing_adr" name="billing_adr" placeholder="123 Example St S" required>
        
    <input type="text" id="billing_adr2" name="billing_adr2" placeholder="Apartment, suite, unit, etc (optional)">
    </div>
  </div>

  <!-- City -->
  <div class="row">
    <div class="col-8">
      <label for="city" class="required"><i class="bi bi-building"></i> City</label>
      <span class="error_form" id="city_error_message"></span>
      <input type="text" id="billing_city" name="billing_city" placeholder="City..." required>
    </div>

    <!-- Country -->
    <div class="col-4">
      <label for="country" class="required"><i class="bi bi-flag-fill"></i> Country</label>
    <select id="billing_country" name="billing_country">
      <option value="Canada">Canada</option>
    </select>
    </div>
  </div>

  <!-- Province -->
  <div class="row">
    <div class="col-5">
      <label for="province" class="required">Province</label>
      <span class="error_form" id="province_error_message"></span>
      <select id="billing_province" name="billing_province">
        <option value="">Select a Province..</option>
        <option value="AB">Alberta</option>
        <option value="BC">British Columbia</option>
        <option value="MB">Manitoba</option>
        <option value="NB">New Brunswick</option>
        <option value="NL">Newfoundland and Labrador</option>
        <option value="NS">Nova Scotia</option>
        <option value="ON">Ontario</option>
        <option value="PE">Prince Edward Island</option>
        <option value="QC">Quebec</option>
        <option value="SK">Saskatchewan</option>
        <option value="NT">Northwest Territories</option>
        <option value="NU">Nunavut</option>
        <option value="YT">Yukon</option>
      </select>
    </div>
    
      <!-- Postal Code -->
    <div class="col-5">
      <label for="postalcode" class="required">Postal Code</label>
      <span class="error_form" id="pcode_error_message"></span>
      <input type="text" id="billing_postalcode" name="billing_postalcode" placeholder="A1A 1A1" required>
      </select>
    </div>

    <span class="error_form" id="validate_error_message"></span>
  </div>
        
  <!-- Back / Continue Buttons -->
  <div class="row">
    <div class="col-6">
      <button type="button" class="btn backToShipping-btn"><i class="bi bi-arrow-left-circle"></i> Shipping Information</button>
    </div>
    <div class="col-6">
      <button type="button" class="btn validateBilling-btn push-left "> Continue </button>
    </div>
  </div>
      
         
</div> <!-- modal body --> <!-- BILLING MODAL END -->

<!--------------------------------------------------------------------------------
//  * CHECKOUT MODAL 3 - Order summary
// ----------------------------------------------------------------------------------->

<div class="modal-body" id="payment-form">
  <div class="row">

    <div class="col-12">
      <!-- Header -->
      <div class="row">
        <div class="col-12 push-center"><h3>Order Summary</h3></div>
        <div class="col-12 push-center" style="color:grey;"><p><?php echo $total_count ?> items</p></div>
      </div>

      <div class="row order-summary">
        <div class="col-12">
        <table id="myTable" class="orderSummary-table">
        <?php
          foreach($_SESSION['cart'] as $keys => $values)
          { 
        ?>
          <tbody class="order-items">
            <tr class="item-info">
              <!-- Picture -->
              <td><img src="<?php echo $values['item_picture']; ?>" height=75 width=75></img></td>
              <!-- Name -->
              <td class="text-left"><?php echo $values['item_name']; ?></td>
              <!-- Quantity -->
              <td><?php echo $values['item_quantity'];?>x</td>
              <!-- Price -->
              <td style="text-align:end;">$<?php echo $values['item_price'];?></td>
            </tr>
          </tbody>

      <?php }

      
      ?>
          <tfoot>
            <tr>
              <td>
                Subtotal:<br>
                Shipping:<br>
                Tax:<br>
              </td>
              <td></td><td></td>
              <!-- SUBTOTAL -->
              <td class="push-left">$<?php echo number_format($total, 2); ?><br>
                FREE <br>
                <!-- TAX -->
                $<?php echo number_format($tax, 2); ?> <br>
              </td>
            </tr>
            <tr class="order-total">
              <td><h4><strong>Total:</strong></h4></td>
              <td></td><td></td>
              <!-- ORDER TOTAL -->
              <td><h4><strong>$<?php echo number_format($orderTotal,2); ?></strong></h4></td>
            </tr>
          </tfoot>
          </table>
          
        </div> <!-- end of col-12 -->
      </div> <!-- end of row -->

      <!-- Back / Continue Buttons -->
      <div class="row">
        <div class="col-6">
          <button type="button" class="btn backToBilling-btn"><i class="bi bi-arrow-left-circle"></i> Billing Information</button>
        </div>
      </div>  

      <div class="col-12 pt-3">
      <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-description="Checkout"
            data-amount= <?php echo $stripeTotal; ?>
            data-locale="auto"></script>      
          <input type="hidden" id="stripeTotal" name="stripeTotal" value="<?php echo $stripeTotal; ?>">
      </div>

      


    </div> <!-- End of Col Order Summary  -->

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional JavaScript -->
    <script src="index/index.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>