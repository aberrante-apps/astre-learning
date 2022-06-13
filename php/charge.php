<?php
    include ('connection.php');
    session_start();
    include ('header.php');

    require_once('shopping-cart/config.php');



  // Basic POST variables
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail']; // Also used as the billing email

  // POST variables for the price of the order
  $grandTotal = $_POST['stripeTotal'];
  $grandTotalPrice = number_format(($grandTotal/100),2);
      
  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);
      
  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => "$grandTotal",
      'currency' => 'cad',
  ]);

  // POST variables for customer billing address
  $billingFirstName = strip_tags($_POST['billing_fname']);
  $billingLastName = strip_tags($_POST['billing_lname']);
  $billingPhone = strip_tags($_POST['billing_phone']);
  $billingAddress1 = strip_tags($_POST['billing_adr']);
  $billingAddress2 = strip_tags($_POST['billing_adr2']);
  $billingCity = strip_tags($_POST['billing_city']);
  $billingProvince = strip_tags($_POST['billing_province']);
  $billingCountry = strip_tags($_POST['billing_country']);
  $billingPostalCode = strip_tags($_POST['billing_postalcode']);

  // POST variables for shipping address
  $shippingFirstName = strip_tags($_POST['fname']);
  $shippingLastName = strip_tags($_POST['lname']);
  $shippingPhone = strip_tags($_POST['phone']);
  $shippingEmail = strip_tags($_POST['email']);
  $shippingAddress1 = strip_tags($_POST['adr']);
  $shippingAddress2 = strip_tags($_POST['adr2']);
  $shippingCity = strip_tags($_POST['city']);
  $shippingProvince = strip_tags($_POST['province']);
  $shippingCountry = strip_tags($_POST['country']);
  $shippingPostalCode = strip_tags($_POST['postalcode']);
  


  // Stores order information into the Orders and OrderedProducts tables //
  // Orders table
  $unixTime = time();

  $userID = $_SESSION['Account']['id'];
  $orderQuery = "INSERT INTO Orders (login_id, timestamp) VALUES ($userID, FROM_UNIXTIME($unixTime));";
  $result = mysqli_query($dbc, $orderQuery);

  //// NOTE: WHILE ENTERING DATA INTO THE ORDERS TABLE WORKS, TRYING TO GET THE ORDER ID AND THE ACTUAL TIMESTAMO IS A PAIN IN THE REAR. ////
  //// I'VE TRIED EVERYTHING I CAN THINK OF TO GET THE ORDER ID AND THE TIMESTAMP TO USE IN STORING THINGS INTO THE ORDER PRODUCTS TABLE, ////
  //// BUT EVERYTHING I'VE TRIED FAILED. AS SUCH, I'LL LEAVE IT TO EITHER ONE OF YOU TO FIGURE OUT HOW TO MAKE THE WHOLE COMMENTED-OUT ////
  //// SECTION BELOW (LINES 67 TO 92) WORK AS IT SHOULD. OTHERWISE, I'LL ASK DOUG IN CLASS TOMORROW. -MZ ////

  $orderTimeQuery = "SELECT FROM_UNIXTIME($unixTime);";
  $orderTime = "";
  $result0 = mysqli_query($dbc, $orderTimeQuery);
  if ($result0) {
    $row = $result0 -> fetch_array(MYSQLI_NUM);
    $orderTime = $row[0];
  } else {
    print "<h3>SQL ERROR: " . $orderTimeQuery . "<br></h3>";
    print mysqli_error($dbc);
  }

  $orderInfoQuery = "SELECT id FROM Orders WHERE login_id = $userID AND timestamp = '$orderTime;'";
  $orderID = 0;
  $result1 = mysqli_query($dbc, $orderInfoQuery);
  if ($result1) {
    $row = $result1 -> fetch_array(MYSQLI_NUM);
    $orderID = $row[0];
    
  } else {
    print "<h3>SQL ERROR: " . $orderInfoQuery . "<br></h3>";
    print mysqli_error($dbc);
  }

  // OrderedProducts table
  for ($i = 0; $i < count($_SESSION['cart']); $i++) {
      // Get information for each product
      $productID = $_SESSION['cart'][$i]["item_id"];
      $productPrice = $_SESSION['cart'][$i]['item_price'];
      $productQuantity = $_SESSION['cart'][$i]['item_quantity'];
      
      // Insert the product into the OrderedProducts table
      $orderedProductsQuery = "INSERT INTO OrderedProducts (order_id, product_id, price, quantity) VALUES ($orderID, $productID, $productPrice, $productQuantity);";
      $result2 = mysqli_query($dbc, $orderedProductsQuery);
  }

?>

<div class="page-contents">
    <div class="container" id="order-success">
        <div class="grid-container ">
            <div class="row">

            <!-- ORDER SUCCESS STATEMENT -->
            <div class="col-6 ">

                <!-- Checkmark Bag & Header -->
                <div class="row">
                    <div class="col-12 push-center" ><i class="bi bi-bag-check" id="order-confirmed"></i></div>
                    <div class="col-12"><h3>Thank you for your purchase, <?php echo ($_SESSION['Account']['first_name']); ?>!</h3></div>
                </div>

                <!-- Order ID & Date -->
                <div class="row  pt-3">
                    <div class="col-12"><p>Your order is #<?php echo $orderID; ?> </p>
                    <p>Order date: <?php echo $orderTime; ?> </p></div>
                </div>

                <!-- Order Information -->
                <div class="row pt-3">
                    <div class="col-12"><h3>Order Information</h3></div>
                    <div class="col-11">
                        <table id="myTable" class="orderInfo-table">
                           <tr>
                                <td><h6><strong>Shipping Address</strong><br>
                                    <?php echo $shippingFirstName . " " . $shippingLastName; ?><br>
                                    <?php echo $shippingAddress1; ?><br>
                                    <?php if ($shippingAddress2 !== "") {
                                          echo $shippingAddress2; ?> <br> <?php
                                    }
                                    ?>
                                    <?php echo $shippingCity . ", " . $shippingProvince; ?><br>
                                    <?php echo $shippingCountry; ?><br>
                                    <?php echo $shippingPostalCode; ?><br>
                                    <?php echo $shippingPhone; ?>
                                </h6></td>
                            </tr>
                            <tr>
                            <td><h6><strong>Billing Address</strong><br>
                                    <?php echo $billingFirstName . " " . $billingLastName; ?><br>
                                    <?php echo $billingAddress1; ?><br>
                                    <?php if ($billingAddress2 !== "") {
                                          echo $billingAddress2; ?> <br> <?php
                                    }
                                    ?>
                                    <?php echo $billingCity . ", " . $billingProvince; ?><br>
                                    <?php echo $billingCountry; ?><br>
                                    <?php echo $billingPostalCode; ?><br>
                                    <?php echo $billingPhone; ?>
                                </h6></td>
                            </tr>   
                            <td><h6><strong>Payment Method</strong><br>
                                    STRIPE
                                </h6></td>
                            </tr>     
                        </table>
                    </div>
                </div>
                

            </div> <!-- End order success column -->

            <!-- ORDER SUMMARY -->
            <div class="col-6 pt-3">

            <div class="col-12 push-center"><h3>Items Ordered</h3></div>
      <div class="row order-summary t-white-block">
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

          

      <?php
      $total = $total + ($values['item_quantity'] * $values['item_price']); 
      $taxRate='13.00';
      $tax=$total*$taxRate/100;
      $orderTotal=$total+$tax;
        }
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
      <div class="col-12 pt-5 push-left"><strong><a href="homepage.php" class="keep-shopping2"> Keep Shopping <i class="bi bi-arrow-right-circle-fill"> </i></a></strong></div>
            </div>  <!-- end of col-6 for order summary-->

            </div> <!-- page row - separates order-success from order-summary -->
        </div> <!-- grid-container -->
    </div> <!-- container -->
<div> <!-- page-contents -->

<?php
  // Empty shopping cart once payment processing is done
  // Session variable emptying
  foreach($_SESSION["cart"] as $keys => $values)
      {
        unset($_SESSION["cart"][$keys]);
      }
  // Database variable emptying
  if(isset($_SESSION['Account'])) {
    $cartremoval_login = $_SESSION['Account']['id'];
    $cartremoval = "DELETE FROM Cart WHERE login_id = '$cartremoval_login';";
    mysqli_query($dbc, $cartremoval);
  }
  
?>

