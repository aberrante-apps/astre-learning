<?php
// This is a webpage for Biology Products 
include ('header.php');
include ('connection.php');

?>

<!-------------------------------------------------------------------
 *  COVER - for Biology
 --------------------------------------------------------------------->
 <div class="container zone green cover">Biology</div>


 <!-------------------------------------------------------------------
 *  PRODUCTS - for Biology
 --------------------------------------------------------------------->
   <?php
$sql = 'SELECT Products.id, Products.name, Products.price, ProductCategories.category_id
        FROM Products
        LEFT JOIN ProductCategories ON Products.id=ProductCategories.product_id
        WHERE ProductCategories.category_id = 2;';
$result = mysqli_query($dbc, $sql);
?>
<!-- HTML container for catalogue -->
<div class="container">
            <section id="catalogue" class="section">
                <!--Insert cards here-->
                        <div class="row" id="cards">
<?php
// 
while ($row = $result -> fetch_assoc()) 
{

// Render Product Cards
echo "<div class='col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch' id='card-container'>";
// id
echo "<div class='card text-center' id='" . $row['id'] . "' style='width: 18rem;'>";
// image
echo "<img class ='img card-img-top' src='https://www.grouphealth.ca/wp-content/uploads/2018/05/placeholder-image.png' alt='...'>";
// button
echo "<button class='btn add-to-cart' data-id='" . $row['id'] . "' onclick='AddToCart(" . $row['id'] .  ")'>Add To Cart</button>";
echo "<div class='card-body'>";
// name
echo "<h5 class='card-title' id='card-title'>" . $row['name'] . "</h5>";
# echo "<p class='card-text'>" . $row['description'] . "</p>";
// price
echo "<p class='card-price'>" . $row['price'] . "</p>";
echo        "</div>";
echo    "</div>";
echo "</div>";

} // END of while loop
  
?>
<!-- closing tags for HTML container and Catalogue -->
</div>
              </div>
            </section>
          </div>

<!-- END --------------------------------------------------------------------------------- -->

<?php
include ('footer.php');
?>



  
  

</body>
</html>
<?php
// include ('footer.php');
?>