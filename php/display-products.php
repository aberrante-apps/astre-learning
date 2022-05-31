<?php
session_start();
include ('connection.php');
include ('header.php');

# Display Products for Astre Learning
 

 



?>

<!-- HTML container for catalogue -->
<div class="container">
            <section id="catalogue" class="section">
                <!--Insert cards here-->
                        <div class="row" id="cards">
<?php
$sql = 'SELECT * FROM Products ORDER BY id ASC';
$result = mysqli_query($dbc, $sql);

if(mysqli_num_rows($result) > 0) 
{
    while ($row = mysqli_fetch_assoc($result))
    {
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch"  id="card-container">
        <form method="POST" action="display-products.php?action=add&id=<?php echo $row['id']; ?>">
        <div class="card text-center" style="width: 18rem;">
        <img class ="img card-img-top" src=" <?php echo $row['picture']; ?>" alt="https://www.grouphealth.ca/wp-content/uploads/2018/05/placeholder-image.png">
        <div class="card-body">
        <h5 class="card-title" id="card-title"><?php echo $row['name']; ?></h5>
        <p class="card-price"><?php echo $row['price']; ?></p>

        <input type="hidden" name="quantity" value="1" class="form-control">
        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" >
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" >
        <!-- add-to-cart button -->
        <!-- <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart"> -->
        <button type="submit" name="add_to_cart" class="btn add-to-cart" value="Add to Cart">Add to Cart</button>

        </div>
        </div>
        </form>
        </div>
<?php
    }
}
?>

<!-- Optional JavaScript -->
<script src="index/index.js"></script>
</body>
</html>