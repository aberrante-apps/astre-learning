

<?php 
$userid = $_SESSION['Account']['id'];
$sql = ("SELECT id, login_id, timestamp 
        FROM Orders
        WHERE login_id = " . $userid . "
        ORDER BY timestamp DESC;");

// $sql2 = ("SELECT Orders.id, 
//                 Orders.login_id, 
//                 Orders.timestamp, 
//                 OrderedProducts.product_id, 
//                 OrderedProducts.price, 
//                 OrderedProducts.quantity, 
//                 Products.name
//         FROM Orders
//         INNER JOIN OrderedProducts ON Orders.id = OrderedProducts.order_id 
//         INNER JOIN Products ON OrderedProducts.product_id = Products.id
//         WHERE Orders.login_id = " . $userid . "
//         ORDER BY timestamp DESC;");
$result = mysqli_query($dbc, $sql);
if(mysqli_num_rows($result) > 0) {


    foreach($result as $keys => $values)
    {
        $taxRate = '13.00';
        $this_total += ($values['quantity'] * $values['price']);
        $tax=$this_total*$taxRate/100;
        $order_total = $this_total+$tax;
        ?>
        <div class="col-12 t-white-block p-4">
            <h5><strong>Complete</strong></h5>
            <div class="row">
                <div class="row col-12">
                    <div class="col-3 is-gray "> Order Number:</div><span class="col-9"> <?php echo $values['id'];?></span>
                </div>
                <div class="row col-12">
                    <div class="col-3 is-gray">Order Date: </div>
                        <span class="col-5"><?php echo $values[timestamp];?></span> 
                        <p class="col-4 is-right"> 
                            <a class="view-order" data-toggle="collapse" href="#orderDetails" role="button" aria-expanded="false" aria-controls="orderDetails">View Order</a>
                        </p> 
                    </div>
                </div>
            
                <p class="col-12 "></p>
                <!-- Collpased Order Details -->
                <div class="col-12">
                    <div class="collapse multi-collapse" id="orderDetails">
                        <div class="col-12 card card-body">
                            <div class="row">
                                <div class="col-2 is-gray">Qty</div>
                                <div class="col-7 is-gray">Description</div>
                                <div class="col-3 is-gray">Price</div>
                            </div>

                            <?php
                            
                            
                            
                                $OrderId = $values['id'];
                                $sql_two = ("SELECT OrderedProducts.order_id, 
                                                    OrderedProducts.product_id, 
                                                    OrderedProducts.price, 
                                                    OrderedProducts.quantity,  
                                                    Products.name
                                            FROM OrderedProducts
                                            INNER JOIN Products ON OrderedProducts.product_id = Products.id
                                            WHERE OrderedProducts.order_id = " . $OrderId . ";");
            
                                $result2 = mysqli_query($dbc, $sql_two);
                                foreach($result2 as $keys => $values)
                                {
                                    $taxRate = '13.00';
                            $this_total += ($values['quantity'] * $values['price']);
                            $tax=$this_total*$taxRate/100;
                            $order_total = $this_total+$tax;
                            ?>
                            <div class="row">
                                <p class="col-12 c-account-line-title"></p> 
                                <div class="col-2"><?php echo $values['quantity'];?></div>
                                <div class="col-7"><?php echo $values['name'];?></div>
                                <div class="col-3"><?php echo $values['price'];?></div>                           
                            </div>

                            <?php
                                }
                            ?>
                            <div class="row">
                                <p class="col-12 c-account-line-title"></p> 
                                <div class="col-2">Shipping<br>
                                                    Tax<br>
                                                    Total
                                </div>
                                <div class="col-7"></div>
                                <div class="col-3">FREE<br>
                                    $<?php echo number_format($tax, 2);?><br>
                                    $<?php echo number_format($order_total, 2);?>
                                </div>                           
                            </div>
            <p class="col-12 c-account-line-title"></p>
                        </div> <!-- End of Card body -->
                    </div> <!-- End of collpase multi-collapse-->
           

                </div> <!-- COLLAPSE col-12 -->
                
            </div> <!-- End of ORDER row -->
            <p class="col-12 c-account-line-title"></p>
<?php
    }

?>
        </div> <!-- End of twhiteblock -->  
<?php 
}  else {
    ?>
<div class="col-12 t-white-block p-4">
<p>You currently have no order history.</p>
<a href="homepage.php" style="color:#4b8cd1;">Keep Shopping?</a>
</div>
<?php
}
?>      


