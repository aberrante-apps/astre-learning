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
                        // echo "<p>You selected neither a product category nor product type. Please select a category and a type.</p>";
                        $add_error = "You selected neither a product category nor product type. Please select a category and a type.";
                    }
                    // Handles errors if the category is not selected upon submission
                    else if ($categoryCode === "Product Category Error")
                    {
                        // echo "<p>You did not select a product category. Please select a category.</p>";
                        $add_error = "You did not select a product category. Please select a category.";

                    // Handles errors if the type is not selected upon submission
                    } else if ($typeCode === "Product Type Error") {
                        // echo "<p>You did not select a product type. Please select a type.</p>";
                        $add_error = "You did not select a product type. Please select a type.";
                    }
                    // If the product being added already has the input name and image, display error.
                    else if ((mysqli_num_rows(mysqli_query($dbc, $query1)) >= 1) && (mysqli_num_rows(mysqli_query($dbc, $query2)) >= 1)) {
                        // echo "<p>It seems this product already exists in the database. Please enter in a different product.</p>";
                        $add_error = "It seems this product already exists in the database. Please enter in a different product.";
                    }
                    // If there is a product by the same name in the database, display error
                    else if (mysqli_num_rows(mysqli_query($dbc, $query1)) >= 1) {
                        // echo "<p>An item in the database already exists with this name. Please use a different name.</p>";
                        $add_error = "An item in the database already exists with this name. Please use a different name.";
                       
                        
                    } 
                    // If there is a product with the same image in the database, display error
                    else if (mysqli_num_rows(mysqli_query($dbc, $query2)) >= 1) {
                        // echo "<p> An item in the database already uses this image. Please use a different image.</p>"; 
                        $add_error = "An item in the database already uses this image. Please use a different image.";
                        
                    }
                    // If both the name and image have never been used before, it's a new product that can be added in
                    else {
                        // MySQL INSERT statement into Product Database
                        $productSQLTable = "INSERT INTO Products (name, description, picture, price, stock) VALUES ('$productName', '$productDescription', '$productImage', $productPrice, $productStock);";
                        $result1 = mysqli_query($dbc, $productSQLTable);
                        if ($result1) {
                                // echo "<p>Main Product Table successfully inserted.</p>";
                            $SQL_Success1 = 'Main Product Table successfully inserted.';
                        } else {
                            // print "<h3>SQL ERROR: " . $productSQLTable . "<br></h3>";
                                // print mysqli_error($dbc);
                            $SQL_Error1 = 'SQL ERROR1: ' . $productSQLTable . '<br>';
                            $SQL_Error2 = 'SQL ERROR2: ' . mysqli_error($dbc);
                        }

                        // Retrieve product ID of the newly inserted product
                        $productIDQuery = "SELECT id from Products WHERE name = '$productName';";
                        $productID = 0;
                        $result2 = mysqli_query($dbc, $productIDQuery);
                        if ($result2) {
                            $row = $result2 -> fetch_array(MYSQLI_NUM);
                            $productID = $row[0];
                        } else {
                            // print "<h3>SQL ERROR: " . $productIDQuery . "<br></h3>";
                            // print mysqli_error($dbc);
                            $SQL_Error3 = 'SQL ERROR3: ' . $productIDQuery . '<br>';
                            $SQL_Error4 = 'SQL ERROR4: ' . mysqli_error($dbc);
                        }

                        // INSERT product category info into the Product Category table
                        $categorySQLTable = "INSERT INTO ProductCategories (product_id, category_id) VALUES ($productID, $categoryCode);";
                        $result3 = mysqli_query($dbc, $categorySQLTable);
                        if ($result3) {
                            // echo "<p>Product Category Table successfully inserted.</p>";
                            $SQL_Success2 = 'Product Category Table successfully inserted.';
                        } else {
                            // print "<h3>SQL ERROR: " . $categorySQLTable . "<br></h3>";
                            // print mysqli_error($dbc);
                            $SQL_Error5 = 'SQL ERROR5: ' . $categorySQLTable . '<br>';
                            $SQL_Error6 = 'SQL ERROR6: ' . mysqli_error($dbc);
                        }

                        // Insert product type info into the Product Type table
                        $typeSQLTable = "INSERT INTO ProductTypes (product_id, type_id) VALUES ($productID, $typeCode);";
                        $result4 = mysqli_query($dbc, $typeSQLTable);
                        if ($result4) {
                            // echo "<p>Product Type Table successfully inserted.</p>";
                            $SQL_Success3 = 'Product Type Table successfully inserted.';
                        } else {
                            // print "<h3>SQL ERROR: " . $typeSQLTable . "<br></h3>";
                            // print mysqli_error($dbc);
                            $SQL_Error7 = 'SQL ERROR7: ' . $typeSQLTable . '<br>';
                            $SQL_Error8 = 'SQL ERROR8: ' . mysqli_error($dbc);
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
                        // echo "<p>Image handling error. Please check if the image is already in the Deepblue folder and that folder permissions are properly set.</p>";
                        $SQL_Error9 = 'Image handling error. Please check if the image is already in the Deepblue folder and that folder permissions are properly set.';
                    }
                }
            ?>

<!------------------------------------------------------------------------------------- 
     LEFT-SIDE MENU DIRECTORY 
    ------------------------------------------------------------------------------------- -->
 <!-- *** This still needs to be shut up in a hamburger menu when screen is mobile *** -->
 <div class="container menu">
    <div class="grid-container">

        <div class="account-sidenav t-white-block">
        <h5 class="t-header-block">Account Menu</h5>
            <ul class="">
                <li class="is-active"><a href="javascript:void(0)" class="orders-btn ">Order History</a></li>
                <li ><a href="javascript:void(0)" class="new-product-btn">Add a New Product</a></li>
                <li><a href="javascript:void(0)"class="privacy-btn">Privacy Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!--------------------------------------------------------------------------------------- 
         MIDDLE ACCOUNT COLUMN 
        ------------------------------------------------------------------------------------- -->

        <div class="account-header">
            <p class="c-account-line-title"><strong>My Account</strong></p>
            <!-- Function for adding product to database -->

    <span style="color:black;"> <?php echo $add_error; ?></span><br>

            <h3><span class="account_title">Order History</span></h3>

            <div class="account-content">
        <!-- Orders -->
        <span class="content-orderHistory"><?php include ('order_history.php');?></span>

        <!-- Privacy Agreement -->
        <span class="content-privacyTerms"><?php include ('privacy-terms1.php');?></span>

        <!-- Add New Product -->
        <span class="content-productForm"><?php include ('new_product_form.php');?></span>

        </div>
        </div>
    </div>
</div>



<script src="index/index.js"></script>
</body>
</html>

