<?php
include ('connection.php');
session_start();
# Home page for Astre Learning

include ('header.php');

?>
<div class="page-contents">
<!-------------------------------------------------------------------------
 *  COVER 
 ------------------------------------------------------------------------->
<div class="container zone grey cover">Shop All</div>

<!-- Add image into cover -->

<!-------------------------------------------------------------------------
 *  Catalogue Preview 
 ------------------------------------------------------------------------->

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
        <div class="card text-center" style="width: 18rem;">
        <form method="POST" action="homepage.php?action=add&id=<?php echo $row['id']; ?>">
        <img class ="img card-img-top" src=" <?php echo $row['picture']; ?>" alt="https://www.grouphealth.ca/wp-content/uploads/2018/05/placeholder-image.png">
        <div class="card-body">
        <h5 class="card-price">$<?php echo $row['price']; ?></h5>
        <h6 class="card-title" id="card-title"><?php echo $row['name']; ?></h6>
        <input type="hidden" name="quantity" value="1" class="form-control">
        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" >
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" >
        <button type="submit" name="add_to_cart" class="btn add-to-cart text-center" value="Add to Cart">Add to Cart</button>

        </div>
        </form>
        </div>
        </div>
<?php
    }
}
?>
        </div>
        </section>
        </div>
</div>
<?php
include ('footer.php');
?>

