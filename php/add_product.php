<?php require 'connection.php'; ?>
<?php include 'header.php'; ?>

<!-----------------------------------------------------------------
 *  ADD NEW PRODUCT TO CATALOGUE - Form
 ----------------------------------------------------------------->

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

    <!-- MIDDLE ACCOUNT COLUMN -->
    <div class="col-12 col-4-md col-3-lg">
        <div class="">
            <p>
                <strong>My Account</strong>
            </p>
            <div class="c-account-line-title"></div>
        </div>
        <h2>Add a New Product</h2>
        <form name="addProduct" action="add_product_to_database.php" method="post" enctype="multipart/form-data">
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
                            <select class="text-box col-12 text-box single-line" id="ProdCat" name="ProdCat"  value="">
                                <option value="">Pick a Category</option>
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
                            <select class="text-box col-12 text-box single-line" id="ProdType" name="ProdType"  value="">
                                <option value="">Pick a Type</option>
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
                    <input type="submit" class="btn btn-light btn-outline-dark" name="productSubmit"value="SUBMIT" role="button"></input>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>