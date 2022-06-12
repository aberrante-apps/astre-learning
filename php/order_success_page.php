<?php 
include ('connection.php');
session_start();
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
                    <div class="col-12"><p>Your order # is: <!--INSERT PHP CALL FOR ORDER ID HERE  --> </p>
                    <p>Order date is: <!--INSERT PHP CALL FOR ORDER DATE HERE --> Month DD, YYYY </p></div>
                </div>

                <!-- Order Information -->
                <div class="row pt-3">
                    <div class="col-12"><h3>Order Information</h3></div>
                    <div class="col-11">
                        <table id="myTable" class="orderInfo-table">
                           <tr>
                                <td><h6><strong>Shipping Address</strong><br>
                                    </br>
                                    address<br>
                                    city, province, postalcode<br>
                                    country<br>
                                    phone
                                </h6></td>
                            </tr>
                            <tr>
                            <td><h6><strong>Billing Address</strong><br>
                                    The above name codes,<br>
                                     except with 'billing_'added <br>
                                     before each name.
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