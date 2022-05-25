<?php

# Home page for Astre Learning

include ('header.php');
include ('connection.php');
?>

<!-------------------------------------------------------------------------
 *  COVER 
 ------------------------------------------------------------------------->
<div class="container zone grey cover">Shop All</div>

<!-- Add image into cover -->

<!-------------------------------------------------------------------------
 *  Catalogue Preview 
 ------------------------------------------------------------------------->

<?php
$sql = 'SELECT * FROM Products;';
$result = mysqli_query($dbc, $sql);
?>

<!-- HTML container for catalogue -->
<div class="container">
            <section id="catalogue" class="section">
                <!--Insert cards here-->
                        <div class="row" id="cards">
<?php
while ($row = $result -> fetch_assoc()) 
{
echo "<div class='col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch' id='card-container'>";
echo    "<div class='card text-center' id='" . $row['id'] . "' style='width: 18rem;'>";
echo        "<img class ='img card-img-top' src='https://www.grouphealth.ca/wp-content/uploads/2018/05/placeholder-image.png' alt='...'>";
echo                "<button class='btn add-to-cart' data-id='" . $row['id'] . 
                    "' onclick='AddToCart(" . $row['id'] .  ")'>Add To Cart</button> </p>";
echo         "<div class='card-body'>";
echo            "<h5 class='card-title' id='card-title'>" . $row['name'] . "</h5>";
// echo            "<p class='card-text'>" . $row['description'] . "</p>";
echo            "<p class='card-price'>" . $row['price'] . "</p>";
echo            "<p class='center'>";

echo        "</div>";
echo    "</div>";
echo "</div>";


// echo "<div class='grid-wrapper'>";
// echo "<div class='box'>";
// echo    "<div class='card' id='" . $row['id'] . "'style='width: 18rem;'";
// echo        "<img class ='img card-img-top' src='hi' alt='hi'>";
// echo         "<div class='card-body'>";
// echo            "<h5 class='card-title' id='card-title'>" . $row['name'] . "</h5>";
// // echo            "<p class='card-text'>" . $row['description'] . "</p>";
// echo            "<p class='card-price'>" . $row['price'] . "</p>";
// echo            "<p class='text-center'>";
// echo                "<button class='btn add-to-cart' data-id='" . $row['id'] . 
//                     "' onclick='AddToCart(" . $row['id'] .  ")'>Add To Cart</button> </p>";
// echo        "</div>";
// echo        "</div>";
// echo    "</div>";
// echo "</div>";
}
    
?>
</div>
              </div>
            </section>
          </div>

</body>
</html>

<?php
include ('footer.php');
?>

