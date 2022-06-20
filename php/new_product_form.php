<div class="form-inner">
    <form name="addProduct" action="acctmenu_admin.php" method="POST" enctype="multipart/form-data">
            <div class="col-12 vert-margin-lg">
                <div class="t-white-block row">

                    <!-- Product Name -->
                    <div class="col-12 t-field-container field">
                        <h3 class="push-center"><strong>New Product Form</strong></h3><br>
                        <label for="prodName"><strong>Product Name: </strong> </label>
                        <span class="error_form" id="prodName_error_message"></span>
                        <div>
                            <input class="text-box col-12 text-box single-line" id="prodName" name="ProdName" type="text" Placeholder="" required> 
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="col-6 t-field-container field">
                    <label for="prodCat"><strong>Product Category: </strong> </label>
                    <span class="error_form" id="prodCat_error_message"></span>
                        <div>
                            <select class="text-box col-12 text-box single-line" id="prodCat" name="ProdCat" required>
                                <option value="Product Category" id="cat-error">Choose...</option>
                                <option value="Astronomy">Astronomy</option>
                                <option value="Biology">Biology</option>
                                <option value="Chemistry">Chemisty</option>
                                <option value="Math">Math</option>
                                <option value="Physics">Physics</option>
                                <option value="Technology">Technology</option>
                            </select>   
                        </div>
                    </div>

                    <!-- Product Type -->
                    <div class="col-6 t-field-container field">
                    <label for="prodType"><strong>Product Type: </strong> </label>
                        <span class="error_form" id="prodType_error_message"></span>
                        <div>
                            <select class="text-box col-12 text-box single-line" id="prodType" name="ProdType" required>
                                <option value="Product Type" id="type-error">Choose...</option>
                                <option value="Book">Book</option>
                                <option value="Kit">Kit</option>
                                <!-- <option value="Software">Software</option>
                                <option value="Software">Toys</option> -->
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12 t-field-container field">
                    <label for="prodName"><strong>Product Description:</strong></label>
                    <span class="error_form" id="prodDesc_error_message"></span>
                        <div>
                            <textarea class="text-box col-12 text-box single-line" id="prodDesc" name="ProdDesc" type="text-area" placeholder="Write a brief description of the product..." required></textarea>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-12 t-field-container field">
                    <label for="prodImg"><strong>Product Image: </strong> </label>
                    <span class="error_form" id="prodImg_error_message"></span>
                        <div>
                            <!-- <label class="float-left is-darkteal" for="prodImg">Image</label> -->
                            <input type="file" id="prodImg" name="ProdImg" accept="image/*" placeholder="Image" required>
                        </div>
                       
                    </div>

                    <!-- Price -->
                    <div class="col-6 t-field-container field">
                    <label for="prodPrice"><strong>Product Price: </strong> </label>
                        <span class="error_form" id="prodPrice_error_message"></span>
                        <div>
                            <input type="number" pattern="^[0-9]*.[0-9][0-9]" id="prodPrice" name="ProdPrice" min="1" step="any" placeholder="0.00" required>
                        </div>
                    </div>

                    <!-- Stock Amount -->
                    <div class="col-6 t-field-container field">
                    <label for="prodStock"><strong>Product Quantity: </strong> </label>
                        <span class="error_form" id="prodStock_error_message"></span>
                        <div>
                            <input type="number" name="ProdStock" id="prodStock" min="1" placeholder="How many...?" required>
                        </div>
                    </div>
                    
                    <span style="color:black;"> <?php echo $add_error; ?></span><br>

                    
                    <input type="hidden" name="MAX_FILE_SIZE" value="100000"><BR><BR>
                    <button type="submit" class="btn validate-productform-btn btn-light btn-outline-dark" name="productSubmit" value="SUBMIT">Add Product</button>
                    
                    <!-- MySQL INSERT statement into Product Database -->

                    

                </div>
                <span class="error_form" id="prodValidateForm_error_message" style="color:red; font-size:20px;"></span>
            </div>
        </form>
        
</div>