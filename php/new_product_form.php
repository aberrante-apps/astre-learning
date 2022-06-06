<div class="form-inner">
<form name="addProduct" action="acctmenu_admin.php" method="POST" enctype="multipart/form-data">
            <div class="col-12 vert-margin-lg">
                <div class="t-white-block row">

                    <!-- Product Name -->
                    <div class="col-12 t-field-container field">
                    <span class="error_form" id="prodName_error_message"></span>
                        <div>
                            <input class="text-box col-12 text-box single-line" id="prodName" name="ProdName" type="text" Placeholder="Product Name" required>
                            
                        </div>
                        
                    </div>

                    <!-- Category -->
                    <div class="col-6 t-field-container field">
                    <span class="error_form" id="prodCat_error_message"></span>
                        <div>
                            <select class="text-box col-12 text-box single-line" id="prodCat" name="ProdCat" required>
                                <option value="Product Category">Product Category</option>
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
                        <span class="error_form" id="prodType_error_message"></span>
                        <div>
                            <select class="text-box col-12 text-box single-line" id="prodType" name="ProdType" required>
                                <option value="Product Type">Product Type</option>
                                <option value="Book">Book</option>
                                <option value="Kit">Kit</option>
                                <!-- <option value="Software">Software</option>
                                <option value="Software">Toys</option> -->
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12 t-field-container field">
                    <span class="error_form" id="prodDesc_error_message"></span>
                        <div>
                            <textarea class="text-box col-12 text-box single-line" id="prodDesc" name="ProdDesc" type="text-area" placeholder="Describe the Product..." required></textarea>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-12 t-field-container field">
                    <span class="error_form" id="prodImg_error_message"></span>
                        <div>
                            <!-- <label class="float-left is-darkteal" for="prodImg">Image</label> -->
                            <input type="file" id="prodImg" name="ProdImg" accept="image/*" placeholder="Image" required>
                        </div>
                       
                    </div>

                    <!-- Price -->
                    <div class="col-6 t-field-container field">
                        
                        <span class="error_form" id="prodPrice_error_message"></span>
                        <div>
                            <input type="number" pattern="^[0-9]*.[0-9][0-9]" id="prodPrice" name="ProdPrice" min="1" step="any" placeholder="Add Price" required>
                        </div>
                    </div>

                    <!-- Stock Amount -->
                    <div class="col-6 t-field-container field">
                        <span class="error_form" id="prodStock_error_message"></span>
                        <div>
                            <input type="number" name="ProdStock" id="prodStock" min="1" placeholder="Add Quantity" required>
                        </div>
                    </div>
                    



                    <input type="hidden" name="MAX_FILE_SIZE" value="100000"><BR><BR>
                    <button type="submit" class="btn validate-productform-btn btn-light btn-outline-dark" name="productSubmit" value="SUBMIT">Submit</button>

                    
                </div>
                <span class="error_form" id="prodValidateForm_error_message" style="color:red; font-size:20px;"></span>
            </div>
        </form>
</div>