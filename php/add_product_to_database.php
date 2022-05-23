<?php include 'header.php'; ?>

 <!-- LEFT-SIDE ACCOUNT DIRECTORY -->
 <!-- *** This still needs to be shut up in a hamburger menu when screen is mobile *** -->
<div class="grid-container">
    <div class="grid-item">
        <div class="col-12 col-4-md col-3-lg">
            <h2 class="t-header-block">
                Account Menu
            </h2>
            <ul class="col-12 col-4-md col-3-lg">
                <li class="is-active">
                    <a href="add_product.php">Add a New Product</a>
                </li>
                <li>
                    <a href="">Order History</a>
                </li>
                <li>
                    <a href="">Logout</a>
                </li>

            </ul>
        </div>
    </div>

    <!-- MIDDLE COLUMN -->
    <div class="col-12 col-4-md col-3-lg">
        <div class="">
            <p>
                <strong>My Account</strong>
            </p>
            <div class="c-account-line-title"></div>
        </div>
        <div class="col-12 vert-margin-lg">
            <div class="t-white-block row">
                <?php
                $productName = $_POST['ProdName'];
                $productCategory = $_POST['ProdCat'];
                $productType = $_POST['ProdType'];
                $productDescription = $_POST['ProdDesc'];
                $productPrice = $_POST['ProdPrice'];

                echo "<p>The name of the product is $productName.</p><br>";
                echo "<p>The category of the product is $productCategory.</p><br>";
                echo "<p>The type of the product is $productType.</p><br>";
                echo "<p>The description of the product is: '$productDescription'</p><br>";
                echo "<p>The price of the product is $productPrice.</p><br>";
                ?>
            </div>
        </div>
    </div>
</div>



<?php include 'footer.php'; ?>