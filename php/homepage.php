<?php

# Home page for Astre Learning

include ('header.php');
include ('connection.php');
?>

<!-------------------------------------------------------------------------
 *  COVER 
 ------------------------------------------------------------------------->
<div class="container zone grey cover">Front page</div>

<!-- Add image into cover -->

<!-------------------------------------------------------------------------
 *  Catalogue Preview 
 ------------------------------------------------------------------------->

<?php
$sql = 'SELECT * FROM Products;';
$result = mysqli_query($dbc, $sql);
// $row = $result -> fetch_assoc();

// while ($row = $result -> fetch_assoc()) {
//   echo "Name: {$row['name']}<br>" .
//         "Price: {$row['price']} <br>" .
//         "-------------------------------<br>";
// }




while ($row = $result -> fetch_assoc()) 
{
echo "<div class='col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch' id='card-container'>";
echo    "<div class='card text-center' id='" . $row['id'] . "' style='width: 18rem;'>";
echo        "<img class ='img card-img-top' src='hi' alt='hi'>";
echo         "<div class='card-body'>";
echo            "<h5 class='card-title' id='card-title'>" . $row['name'] . "</h5>";
// echo            "<p class='card-text'>" . $row['description'] . "</p>";
echo            "<p class='card-price'>" . $row['price'] . "</p>";
echo            "<p class='center'>";
echo                "<button class='btn add-to-cart' data-id='" . $row['id'] . 
                    "' onclick='AddToCart(" . $row['id'] .  ")'>Add To Cart</button> </p>";
echo        "</div>";
echo    "</div>";
echo "</div>";

}
    
// echo $row['name'];
?>


