<?php
    include ('connection.php');
    session_start();
    require_once('shopping-cart/config.php');
    include ('header.php');

  // Basic POST variables
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail']; // Also used as the billing email

  // POST variables for customer billing address
  $billingFirstName = strip_tags($_POST['billing_fname']);
  $billingLastName = strip_tags($_POST['billing_lname']);
  $billingPhone = strip_tags($_POST['billing_phone']);
  $billingAddress1 = strip_tags($_POST['billing_address1']);
  $billingAddress2 = strip_tags($_POST['billing_address2']);
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

  // Stores order information into the Orders and OrderedProducts tables
  // Orders table. First, insert the order id with the user id and the current time, then get the order id
  $currentTime = date("Y-m-d H-i-s");
  $userID = $_SESSION['Account']['id'];
  $orderQuery = "INSERT INTO Orders (login_id, timestamp) VALUES ($userID, '$currentTime');";
  mysqli_query($dbc, $orderQuery);
//   $orderIDQuery = "SELECT id FROM Orders WHERE login_id = $userID AND timestamp = '$currentTime';";
//   $orderID = mysqli_query($dbc, $orderIDQuery);
//   if ($orderID) {
//     echo "The order number is $orderID";
// } else {
//     print "<h3>SQL ERROR: " . $productSQLTable . "<br></h3>";
//     print mysqli_error($dbc);
// }
  

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
                    <div class="col-12"><p>Your order is #<?php echo $orderID ?> </p>
                    <p>Order date is: <!--INSERT PHP CALL FOR ORDER DATE HERE --> Month DD, YYYY </p></div>
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
<!-- ORDER SUCCESS PAGE -->

