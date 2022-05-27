<?php require 'connection.php'; ?>
<?php include 'header.php'; ?>

<!-----------------------------------------------------------------
 *  ADD NEW PRODUCT TO CATALOGUE - Form
 ----------------------------------------------------------------->

            <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    // Variables for product info
                    $productName = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['ProdName'])));
                    $productCategory = strip_tags($_POST['ProdCat']);
                    $productType = strip_tags($_POST['ProdType']);
                    $productDescription = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['ProdDesc'])));
                    $productImage = "";
                    $productPrice = strip_tags($_POST['ProdPrice']);
                    $productStock = strip_tags($_POST['ProdStock']);

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
                            $categoryCode = "Product Category Error";
                            break;
                    }

                    if ($productType == "Book") {
                        $typeCode = 1;
                    } else if ($productType == "Kit") {
                        $typeCode = 2;
                    } else {
                        $typeCode = "Product Type Error";
                    }

                    // MySQL queries to determine if a product already exists in the database
                    $query1 = "SELECT * FROM Products WHERE name = '$productName';";
                    $timesNameAppears = mysqli_num_rows(mysqli_query($dbc, $query1));

                    $filename = $_FILES['ProdImg']['name'];
                    $productImage = "product_images/" . $filename;
                    $query2 = "SELECT * FROM Products WHERE picture = '$productImage'";

                    // Handles Image Upload, starting with a check to see if a product already has the associated image
                    // If the image isn't already associated with an item, add the image to the server
                    if (!(mysqli_num_rows(mysqli_query($dbc, $query2)) >= 1)) {
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
                    }

                    // If the product being added already has the input name and image, display error.
                    if ((mysqli_num_rows(mysqli_query($dbc, $query1)) >= 1) && (mysqli_num_rows(mysqli_query($dbc, $query2)) >= 1)) {
                        echo "<p>It seems this product already exists in the database. Please enter in a different product. </p>";
                    }
                    // If there is a product by the same name in the database, display error
                    else if (mysqli_num_rows(mysqli_query($dbc, $query1)) >= 1) {
                        echo "<p>An item in the database already exists with this name. Please use a different name.</p>";
                    } 
                    // If there is a product with the same image in the database, display error
                    else if (mysqli_num_rows(mysqli_query($dbc, $query2)) >= 1) {
                        echo "<p> An item in the database already uses this image. Please use a different image.</p>"; 
                    }
                    // If both the name and image have never been used before, it's a new product that can be added in
                    else {
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
                    }
                }
            ?>

 <!-- LEFT-SIDE ACCOUNT DIRECTORY -->
 <!-- *** This still needs to be shut up in a hamburger menu when screen is mobile *** -->
 <div class="grid-container">
    <div class="grid-item">
        <div class="col-12 col-4-md col-3-lg">
            <h2 class="t-header-block">
                Account Menu
            </h2>
            <ul class="col-12 col-4-md col-3-lg">
                <li>
                    <a href="">Order History</a>
                </li>
                <li class="is-active">
                    <a href="add_product.php">Add a New Product</a>
                </li>
                <li>
                    <a href="<?php if (isset($logout)) session_destroy(); echo $logout ?>">Logout</a>
                </li>

            </ul>
        </div>
    </div>

    <!-- MIDDLE ACCOUNT COLUMN -->
    <div class="col-12 col-4-md col-3-lg">
        <div class="">
            <p>
                <strong>Admin Account</strong>
            </p>
            <div class="c-account-line-title"></div>
        </div>
        <h2>Add a New Product</h2>
        <form name="addProduct" action="acctmenu_admin.php" method="POST" enctype="multipart/form-data">
            <div class="col-12 vert-margin-lg">
                <div class="t-white-block row">

                    <!-- Product Name -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodName">Product Name <span class="is-light">*</span></label>
                        <div>
                            <input class="text-box col-12 text-box single-line" id="ProdName" name="ProdName" type="text" value="" required>
                            <span class="field-validation-valid"></span>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodCat">Product Category <span class="is-light"> *</span></label>
                        <div>
                            <select class="text-box col-12 text-box single-line" id="ProdCat" name="ProdCat" required>
                                <option>Pick a Category</option>
                                <option value="Astronomy">Astronomy</option>
                                <option value="Biology">Biology</option>
                                <option value="Chemistry">Chemisty</option>
                                <option value="Math">Math</option>
                                <option value="Physics">Physics</option>
                                <option value="Technology">Technology</option>
                            </select>
                            <span class="field-validation-valid"></span>
                        </div>
                    </div>

                    <!-- Product Type -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodType">Product Type <span class="is-light"> *</span></label>
                        <div>
                            <select class="text-box col-12 text-box single-line" id="ProdType" name="ProdType" required>
                                <option>Pick a Type</option>
                                <option value="Book">Book</option>
                                <option value="Kit">Kit</option>
                                <!-- <option value="Software">Software</option>
                                <option value="Software">Toys</option> -->
                            </select>
                            <span class="field-validation-valid "></span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodDesc">Product Description <span class="is-light"> *</span></label>
                        <div>
                            <textarea class="text-box col-12 text-box single-line" id="ProdDesc" name="ProdDesc" type="text-area" value="" required></textarea>
                            <span class="field-validation-valid "></span>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodImg">Image <span class="is-light"> *</span></label>
                        <div>
                            <input type="file" id="ProdImg" name="ProdImg" accept="image/*" required>
                        </div>
                        <span class="field-validation-valid "></span>
                    </div>

                    <!-- Price -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodPrice">Price <span class="is-light"> *</span></label>
                        <div>
                            <input type="text" pattern="^[0-9]*.[0-9][0-9]" name="ProdPrice" min="1" step="any" required>
                            <span class="field-validation-valid "></span>
                        </div>
                    </div>

                    <!-- Stock Amount -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodStock">Number in Stock <span class="is-light"> *</span></label>
                        <div>
                            <input type="number" name="ProdStock" min="1" required>
                            <span class="field-validation-valid "></span>
                        </div>
                    </div>

                    <input type="hidden" name="MAX_FILE_SIZE" value="100000"><BR><BR>
                    <input type="submit" class="btn btn-light btn-outline-dark" name="productSubmit"value="SUBMIT" role="button">
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>