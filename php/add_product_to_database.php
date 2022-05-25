<?php require 'connection.php'; ?>
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
                    // Prevents MySQL syntax errors from stray apostrophes in the product name
                    $productName = str_ireplace("'", "\'", $productName);
                    $productCategory = $_POST['ProdCat'];
                    $productType = $_POST['ProdType'];
                    $productDescription = $_POST['ProdDesc'];
                    // Prevents MySQL syntax errors from stray apostrophes in the product description
                    $productDescription = str_ireplace("'", "\'", $productDescription);
                    $productImage = "";
                    $productPrice = $_POST['ProdPrice'];
                    $productStock = $_POST['ProdStock'];

                    // Set up for category and type codes
                    $categoryCode = 1;
                    $typeCode = 1;

                    switch ($productCategory) {
                        case "Astronomy":
                            $categoryCode = 1;
                            break;
                        case "Biology":
                            $categoryCode = 2;
                            break;
                        case "Chemistry":
                            $categoryCode = 3;
                            break;
                        case "Math":
                            $categoryCode = 4;
                            break;
                        case "Physics":
                            $categoryCode = 5;
                            break;
                        case "Technology":
                            $categoryCode = 6;
                            break;
                        default:
                            $categoryCode = "Category Error";
                    }

                    if ($productType == "Book") {
                        $typeCode = 1;
                    } else if ($productType == "Kit") {
                        $typeCode = 2;
                    }

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
                            $productImage = "product_images/" . $filename;
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

                    // MySQL INSERT statement into Product Database
                    $productSQLTable = "INSERT INTO Products (name, description, picture, price, stock) VALUES ('$productName', '$productDescription', '$productImage', $productPrice, $productStock);";
                    $result1 = mysqli_query($dbc, $productSQLTable);
                    if ($result1) {
                        echo "<p>Main Product Table successfully inserted.</p>";
                    } else {
                        print "<h3>SQL ERROR: " . $productSQLTable . "<br></h3>";
                        print mysqli_error($dbc);
                    }

                    // Retrieve product ID of the newly inserted product
                    $productIDQuery = "SELECT id from Products WHERE name = '$productName';";
                    $productID = 0;
                    $result2 = mysqli_query($dbc, $productIDQuery);
                    if ($result2) {
                        $row = $result2 -> fetch_array(MYSQLI_NUM);
                        $productID = $row[0];
                        echo "<p>Product ID retrieved</p>";
                    } else {
                        print "<h3>SQL ERROR: " . $productIDQuery . "<br></h3>";
                        print mysqli_error($dbc);
                    }

                    // INSERT product category info into the Product Category table
                    $categorySQLTable = "INSERT INTO ProductCategories (product_id, category_id) VALUES ($productID, $categoryCode);";
                    $result3 = mysqli_query($dbc, $categorySQLTable);
                    if ($result3) {
                        echo "<p>Product Category Table successfully inserted.</p>";
                    } else {
                        print "<h3>SQL ERROR: " . $categorySQLTable . "<br></h3>";
                        print mysqli_error($dbc);
                    }

                    // Insert product type info into the Product Type table
                    $typeSQLTable = "INSERT INTO ProductTypes (product_id, type_id) VALUES ($productID, $typeCode);";
                    $result4 = mysqli_query($dbc, $typeSQLTable);
                    if ($result4) {
                        echo "<p>Product Type Table successfully inserted.</p>";
                    } else {
                        print "<h3>SQL ERROR: " . $typeSQLTable . "<br></h3>";
                        print mysqli_error($dbc);
                    }


                    // Display confirmation details of the product.
                    echo "<p>The name of the product is $productName.</p><br>";
                    echo "<p>The product ID is $productID</p><br>";
                    echo "<p>The category of the product is $productCategory.</p><br>";
                    echo "<p>The type of the product is $productType.</p><br>";
                    echo "<p>The description of the product is: '$productDescription'</p><br>";
                    echo "<p>The price of the product is $$productPrice.</p><br>";
                    echo "<p>There are $productStock units of the product in stock.</p>"
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