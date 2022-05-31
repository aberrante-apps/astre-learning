<?php 
include 'connection.php';
session_start();
 if (isset($_SESSION['Account']) && $_SESSION['Account']['admin'] == 0)
  {
      header('location:acctmenu_customer.php');
  } 
  else if (!isset($_SESSION['Account'])) 
  {
      header('location:login_register.php');
  }
  else {
    session_start();
  }

include 'header.php';
 ?>

<!-----------------------------------------------------------------
 *  ADD NEW PRODUCT TO CATALOGUE - Form
 ----------------------------------------------------------------->

            <?php
                // Function for adding product to database
                function AddProductToDatabase($productName, $categoryCode, $typeCode, $productDescription, $productImage, $productPrice, $productStock, $query1, $query2, $dbc) {
                    if ($categoryCode === "Product Category Error" && $typeCode === "Product Type Error") {
                        echo "<p>You selected neither a product category nor product type. Please select a category and a type.</p>";
                    }
                    // Handles errors if the category is not selected upon submission
                    else if ($categoryCode === "Product Category Error")
                    {
                        echo "<p>You did not select a product category. Please select a category.</p>";
                    // Handles errors if the type is not selected upon submission
                    } else if ($typeCode === "Product Type Error") {
                        echo "<p>You did not select a product type. Please select a type.</p>";
                    }
                    // If the product being added already has the input name and image, display error.
                    else if ((mysqli_num_rows(mysqli_query($dbc, $query1)) >= 1) && (mysqli_num_rows(mysqli_query($dbc, $query2)) >= 1)) {
                        echo "<p>It seems this product already exists in the database. Please enter in a different product.</p>";
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

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    // Variables for product info
                    $productName = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['ProdName'])));
                    $productCategory = strip_tags($_POST['ProdCat']);
                    $productType = strip_tags($_POST['ProdType']);
                    $productDescription = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['ProdDesc'])));
                    $productImage = "";
                    $productPrice = strip_tags($_POST['ProdPrice']);
                    $productStock = strip_tags($_POST['ProdStock']);

                    $Valid_Input = TRUE;

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

                    if ($Valid_Input) {
                        AddProductToDatabase($productName, $categoryCode, $typeCode, $productDescription, $productImage, $productPrice, $productStock, $query1, $query2, $dbc);
                    } else {
                        echo "<p>Image handling error. Please check if the image is already in the Deepblue folder and that folder permissions are properly set.</p>";
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
                    <a href="acctmenu_admin.php">Add a New Product</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                    
                    
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
                    <label class="float-left is-darkteal" for="prodName">Product Name <span class="is-light"> * </span>
                    </label>
                        <div>
                            <input class="text-box col-12 text-box single-line" id="prodName" name="ProdName" type="text" required>
                        </div>
                        <span class="error_form" id="prodName_error_message"></span>
                    </div>

                    <!-- Category -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodCat">Product Category <span class="is-light"> *</span></label>
                        <div>
                            <select class="text-box col-12 text-box single-line" id="prodCat" name="ProdCat" required>
                                <option value="Pick a Category">Pick a Category</option>
                                <option value="Astronomy">Astronomy</option>
                                <option value="Biology">Biology</option>
                                <option value="Chemistry">Chemisty</option>
                                <option value="Math">Math</option>
                                <option value="Physics">Physics</option>
                                <option value="Technology">Technology</option>
                            </select>
                            
                        </div>
                        <span class="error_form" id="prodCat_error_message"></span>
                    </div>

                    <!-- Product Type -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodType">Product Type <span class="is-light"> *</span></label>
                        <span class="error_form" id="prodType_error_message"></span>
                        <div>
                            <select class="text-box col-12 text-box single-line" id="prodType" name="ProdType" required>
                                <option value="Pick a Type">Pick a Type</option>
                                <option value="Book">Book</option>
                                <option value="Kit">Kit</option>
                                <!-- <option value="Software">Software</option>
                                <option value="Software">Toys</option> -->
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodDesc">Product Description <span class="is-light"> *</span></label>
                        <div>
                            <textarea class="text-box col-12 text-box single-line" id="prodDesc" name="ProdDesc" type="text-area" value="" required></textarea>
                            
                        </div>
                        <span class="error_form" id="prodDesc_error_message"></span>
                    </div>

                    <!-- Image -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodImg">Image <span class="is-light"> *</span></label>
                        <div>
                            <input type="file" id="prodImg" name="ProdImg" accept="image/*" required>
                        </div>
                        <span class="error_form" id="prodImg_error_message"></span>
                    </div>

                    <!-- Price -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodPrice">Price <span class="is-light"> *</span></label>
                        <span class="error_form" id="prodPrice_error_message"></span>
                        <div>
                            <input type="number" pattern="^[0-9]*.[0-9][0-9]" id="prodPrice" name="ProdPrice" min="1" step="any" required>
                        </div>
                    </div>

                    <!-- Stock Amount -->
                    <div class="col-12 t-field-container">
                        <label class="float-left is-darkteal" for="prodStock">Number in Stock <span class="is-light"> *</span></label>
                        <span class="error_form" id="prodStock_error_message"></span>
                        <div>
                            <input type="number" name="ProdStock" id="prodStock" min="1" required>
                        </div>
                    </div>

                    <input type="hidden" name="MAX_FILE_SIZE" value="100000"><BR><BR>
                    <button type="submit" class="btn validate-productform-btn btn-light btn-outline-dark" name="productSubmit"value="SUBMIT">Submit</button>

                    
                </div>
                <span class="error_form" id="prodValidateForm_error_message" style="color:red; font-size:20px;"></span>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>