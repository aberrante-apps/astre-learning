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

    <!-- MIDDLE COLUMN TO DISPLAY CONFIRMATION OF PRODUCT ENTRY INTO DATABASE-->
    <div class="col-12 col-4-md col-3-lg">
        <div class="">
            <p>
                <strong>My Account</strong>
            </p>
            <div class="c-account-line-title"></div>
        </div>
        <div class="col-12 vert-margin-lg">
            <div class="t-white-block row">
                <div class="col-12 t-field-container">

                    <!-- PHP process for placing item into database and showing confirmation item is in database after.-->
                    <?php
                    // Variables for product info
                    $productName = $_POST['ProdName'];
                    $productCategory = $_POST['ProdCat'];
                    $productType = $_POST['ProdType'];
                    $productDescription = $_POST['ProdDesc'];
                    $productPrice = $_POST['ProdPrice'];

                    // Handles Image Upload
                    if ($_FILES['ProdImg']['error'] > 0){
                        $Valid_Input = FALSE;
                        ?>  <script>
                                window.alert("Image file not uploaded to server.");
                            </script>
                        <?php
                    } else {
                        if (is_uploaded_file($_FILES['ProdImg']['tmp_name'])) {
                            $filename = $_FILES['ProdImg']['name'];
                            $upfile = "product_images//" . $filename;
                            $filename = "'" . $filename . "'";
                            if (!move_uploaded_file($_FILES['ProdImg']['tmp_name'], $upfile)) {
                                $Valid_Input = FALSE;
                                ?> <script>
                                    window.alert("Image file move failed on server.");
                                </script> <?php
                            }
                        } else {
                            $Valid_Input = FALSE;
                            ?> <script>
                            window.alert("Image file not uploaded to temp file on server.");
                            </script><?php
                        }
                    }


                    echo "<p>The name of the product is $productName.</p><br>";
                    echo "<p>The category of the product is $productCategory.</p><br>";
                    echo "<p>The type of the product is $productType.</p><br>";
                    echo "<p>The description of the product is: '$productDescription'</p><br>";
                    // echo "<p>The image of the product is $filename, and is located at $upfile.</p>"
                    echo "<p>The price of the product is $$productPrice.</p><br>";
                    phpinfo();
                    ?>

                </div>
                <div class="col-12 t-field-container">
                    <a class="btn btn-light btn-outline-dark" href="add_product.php" role="button">Add Another Product</a>
                    <a class="btn btn-light btn-outline-dark" href="homepage.php" role="button">Home Page</a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'footer.php'; ?>