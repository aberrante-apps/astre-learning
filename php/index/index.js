

/***************************************************************
* LOGIN / REGISTER 
****************************************************************/
/* Forms */
const loginForm = document.querySelector("form.login"); 
const registerForm = document.querySelector("form.register");
/* Labels */
const loginBtn = document.querySelector("label.login"); 
const registerBtn = document.querySelector("label.register");
/* Links*/
const loginLink = document.querySelector(".login-link a");
const registerLink = document.querySelector(".register-link a"); 
/* Text */
const loginTitle = document.querySelector(".title-text .login");
const registerTitle = document.querySelector(".title-text .register");


// /******* LABELS *******/
$(registerBtn).click(function(){
    loginForm.style.marginLeft = "-50%";
    loginTitle.style.marginLeft = "-50%";
}); // display register form when register label is clicked

$(loginBtn).click(function(){
    loginForm.style.marginLeft = "0%";
     loginTitle.style.marginLeft = "0%";
}); // display login form when login label is clicked


// /******** LINKS *********/
$(registerLink).click (function(){
    registerBtn.click();
});

$(loginLink).click(function(){
    loginBtn.click();
});

/***************************************************************
* LOGIN VALIDATION *******************************/

$(function(){
    $("#email_error_message").hide();
    $("#password_error_message").hide();

    var error_email = false;
    var error_password = false;

    $("#email").focusout(function(){
        check_email();
    });

    $("#password").focusout(function(){
        check_password();
    });

    function check_email() {
        var email = $("#email").val();
        const emailRGX = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
        if (emailRGX.test(email) && email !== "") {
            $("#email_error_message").hide();
            $("#email").css("border-bottom","2px solid #34F458");

        } else {
            $("#email_error_message").html("Please enter a valid email address");
            $("#email_error_message").show();
            $("#email").css("border-bottom","2px solid #F90A0A");
               error_email = true;
        }
    }

    function check_password() {
        var password = $("#password").val();

        if (password !== "") {
            $("#password_error_message").hide();
            $("#password").css("border-bottom","2px solid #34F458");

        } else {
            $("#password_error_message").html("Please enter your password");
            $("#password_error_message").show();
            $("#password").css("border-bottom","2px solid #F90A0A");
               error_password = true;
        }
    }

})


/***************************************************************
* REGISTER VALIDATION *******************************/

$(function(){
$("#firstname_error_message").hide();
$("#lastname_error_message").hide();
$("#registerEmail_error_message").hide();
$("#registerPassword_error_message").hide();
$("#samepass_error_message").hide();

var error_firstname = false;
var error_lastname = false;
var error_registerEmail = false;
var error_registerPassword = false;
var error_samepass = false;

$("#firstname").focusout(function(){
    check_firstname();
});

$("#lastname").focusout(function(){
    check_lastname();
});

$("#register_email").focusout(function(){
    check_registerEmail();
});

$("#register_password").focusout(function(){
    check_registerPassword();
});

$("#samepass").focusout(function(){
    check_samepass();
});

function check_firstname() {
    var firstname = $("#firstname").val();

    if (firstname !== "") {
        $("#firstname_error_message").hide();
        $("#firstname").css("border-bottom","2px solid #34F458");

    } else {
        $("#firstname_error_message").html("Please enter your first name");
        $("#firstname_error_message").show();
        $("#firstname").css("border-bottom","2px solid #F90A0A");
           error_firstname = true;
    }
}

function check_lastname() {
    var lastname = $("#lastname").val();

    if (lastname !== "") {
        $("#lastname_error_message").hide();
        $("#lastname").css("border-bottom","2px solid #34F458");

    } else {
        $("#lastname_error_message").html("Please enter your last name");
        $("#lastname_error_message").show();
        $("#lastname").css("border-bottom","2px solid #F90A0A");
           error_lastname = true;
    }
}

function check_registerEmail() {
    var registerEmail = $("#register_email").val();
    const registerEmailRGX = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    if (registerEmailRGX.test(registerEmail) && registerEmail !== "") {
        $("#registerEmail_error_message").hide();
        $("#register_email").css("border-bottom","2px solid #34F458");

    } else {
        $("#registerEmail_error_message").html("Please enter a valid email address");
        $("#registerEmail_error_message").show();
        $("#register_email").css("border-bottom","2px solid #F90A0A");
           error_registerEmail = true;
    }
}

function check_registerPassword() {
    var registerPassword = $("#register_password").val();

    if (registerPassword !== "") {
        $("#registerPassword_error_message").hide();
        $("#register_password").css("border-bottom","2px solid #34F458");

    } else {
        $("#registerPassword_error_message").html("Please enter your password");
        $("#registerPassword_error_message").show();
        $("#register_password").css("border-bottom","2px solid #F90A0A");
           error_registerPassword = true;
    }
}

function check_samepass() {
    var samepass = $("#samepass").val();
    var passcheck = $("#register_password").val();
    if (samepass === passcheck && samepass !== "") {
        $("#samepass_error_message").hide();
        $("#samepass").css("border-bottom","2px solid #34F458");

    } else {
        $("#samepass_error_message").html("Passwords must match");
        $("#samepass_error_message").show();
        $("#samepass").css("border-bottom","2px solid #F90A0A");
           error_samepass = true;
    }
}

$(".validate-registration").click(function(){

error_firstname = false;
error_lastname = false;
error_registerEmail = false;
error_registerPassword = false;
error_samepass = false;

check_firstname();
check_lastname();
check_registerEmail();
check_registerPassword();
check_samepass();

if (error_firstname === false &&
    error_lastname === false &&
    error_registerEmail === false &&
    error_registerPassword === false &&
    error_samepass === false) 
    {
        $("#registerValidateForm_error_message").hide();
        return true;
    } else {
        $("#registerValidateForm_error_message").html("Please fill out all fields of the form correctly");
        $("#registerValidateForm_error_message").show();
        return false;
    }

});
})

   

/***************************************************************
* ACCOUNT MENU
****************************************************************/

$('.privacy-btn').click(function(){
    $(".content-orderHistory").css("display","none");
    $(".content-productForm").css("display","none");
    $(".content-privacyTerms").css("display","block");

    $(".orders-btn").css("color", "black");
    $(".new-product-btn").css("color", "black");
    $(".privacy-btn").css("color", "#4f3dee");

    
    $(".account_title").html("Privacy Settings");

});

$('.new-product-btn').click(function(){
    $(".content-orderHistory").css("display","none");
    $(".content-productForm").css("display","block");
    $(".content-privacyTerms").css("display","none");
    
    $(".orders-btn").css("color", "black");
    $(".new-product-btn").css("color", "#4f3dee");
    $(".privacy-btn").css("color", "black");
    

    $(".account_title").html("Add a New Product");
});

$('.orders-btn').click(function(){
    $(".content-orderHistory").css("display","block");
    $(".content-productForm").css("display","none");
    $(".content-privacyTerms").css("display","none");

    $(".orders-btn").css("color", "#4f3dee");
    $(".privacy-btn").css("color", "black");
    $(".new-product-btn").css("color", "black");
    
    $(".account_title").html("Order History");
});

$("#rejectConditions").click(function(){
    let text = "Are you sure you want to decline the agreement?\nYou will be logged out and you won't have full site functionality until you agree later.";
    if (confirm(text)) {
        window.location.href="decline-privacy-terms.php";
    }
});


$(".view-order").click(function(){
    $(".collapse").toggle();
});


/***************************************************************
* Product Form Verification - 
****************************************************************/

$(function() {
    $("#prodName_error_message").hide();
    $("#prodCat_error_message").hide();
    $("#prodType_error_message").hide();
    $("#prodDesc_error_message").hide();
    $("#prodImg_error_message").hide();
    $("#prodPrice_error_message").hide();
    $("#prodStock_error_message").hide();

    var error_prodName = false;
    var error_prodCat = false;
    var error_prodType = false;
    var error_prodDesc = false;
    var error_prodImg = false;
    var error_prodPrice = false;
    var error_prodStock = false;

    $("#prodName").focusout(function(){
        check_prodName();
    });

    $("#prodCat").focusout(function(){
            check_prodCat();
        });
    
        $("#prodType").focusout(function(){
            check_prodType();
        });
    
        $("#prodDesc").focusout(function(){
            check_prodDesc();
        });
    
        $("#prodImg").focusout(function(){
            check_prodImg();
        });
    
        $("#prodPrice").focusout(function(){
            check_prodPrice();
        });
    
        $("#prodStock").focusout(function(){
            check_prodStock();
        });
    
    function check_prodName() {
        var prodName = $("#prodName").val();
        if (prodName !== "") {
            $("#prodName_error_message").hide();
            $("#prodName").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodName_error_message").html("* This field cannot be empty");
            $("#prodName_error_message").css("color", "#fa2f2f");
            $("#prodName_error_message").show();
            $("#prodName").css("border-bottom","2px solid #F90A0A");
               error_prodName = true;
        }
    }

    function check_prodCat() {
        var prodCat = $("#prodCat").val();
        if (prodCat !== "Product Category") {
            $("#prodCat_error_message").hide();
            $("#prodCat").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodCat_error_message").html("* Choose the product's category.");
            $("#prodCat_error_message").css("color", "#fa2f2f");
            $("#prodCat_error_message").show();
            $("#prodCat").css("border-bottom","2px solid #F90A0A");
            error_prodCat = true;
        }
    }

    function check_prodType() {
        var prodType = $("#prodType").val();
        if (prodType !== "Product Type") {
            $("#prodType_error_message").hide();
            $("#prodType").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodType_error_message").html("* Choose the product's type.");
            $("#prodType_error_message").css("color", "#fa2f2f");
            $("#prodType_error_message").show();
            $("#prodType").css("border-bottom","2px solid #F90A0A");
            error_prodType = true;
        }
    }

    function check_prodDesc() {
        var prodDesc = $("#prodDesc").val();
        if (prodDesc !== "") {
            $("#prodDesc_error_message").hide();
            $("#prodDesc").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodDesc_error_message").html("* Describe the product.");
            $("#prodDesc_error_message").css("color", "#fa2f2f");
            $("#prodDesc_error_message").show();
            $("#prodDesc").css("border-bottom","2px solid #F90A0A");
            error_prodDesc = true;
        }
    }

    function check_prodImg() {
        var prodImg = $("#prodImg").val();
        if (prodImg !== "") {
            $("#prodImg_error_message").hide();
            $("#prodImg").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodImg_error_message").html("* Upload an image with a unique file name.");
            $("#prodImg_error_message").css("color", "#fa2f2f");
            $("#prodImg_error_message").show();
            $("#prodImg").css("border-bottom","2px solid #F90A0A");
            error_prodImg = true;
        }
    }

    function check_prodPrice() {
        var prodPrice = $("#prodPrice").val();
        const priceRGX = /^(\$|)([1-9]\d{0,2}(\,\d{3})*|([1-9]\d*))(\.\d{2})?$/;
        if (priceRGX.test(prodPrice)) {
            $("#prodPrice_error_message").hide();
            $("#prodPrice").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodPrice_error_message").html("Input the price.");
            $("#prodPrice_error_message").css("color", "#fa2f2f");
            $("#prodPrice_error_message").show();
            $("#prodPrice").css("border-bottom","2px solid #F90A0A");
            error_prodPrice = true;
        }
    }

    function check_prodStock() {
        var prodStock = $("#prodStock").val();
        if (prodStock !== "" && prodStock > 0 ) {
            $("#prodStock_error_message").hide();
            $("#prodStock").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodStock_error_message").html("Input the quantity");
            $("#prodStock_error_message").css("color", "#fa2f2f");
            $("#prodStock_error_message").show();
            $("#prodStock").css("border-bottom","2px solid #F90A0A");
            error_prodStock = true;
        }
    }
   
$(".validate-productform-btn").click(function(){
    error_prodName = false;
    error_prodCat = false;
    error_prodType = false;
    error_prodDesc = false;
    error_prodImg = false;
    error_prodPrice = false;
    error_prodStock = false;

    check_prodName();
    check_prodCat();
    check_prodType();
    check_prodDesc();
    check_prodImg();
    check_prodPrice();
    check_prodStock();

    if (error_prodName === false && error_prodCat === false && error_prodType === false && error_prodType === false && error_prodDesc === false && error_prodImg === false && error_prodPrice === false && error_prodStock === false) 
    {
        $("#prodValidateForm_error_message").hide();
        return true;
    } else {
        $("#prodValidateForm_error_message").html("Please fill out all fields of the form correctly");
        $("#prodValidateForm_error_message").show();
        return false;
    }
});
})

/***************************************************************
* CHECKOUT- Open and close side nav when Cart is clicked
****************************************************************/

// FUNCTION - OPEN-CLOSE CHECKOUT MODAL
$('.open-checkout').click(function(){
    $(".modal").css("display", "block");
    $("#shipping-address-form").css("display", "block");
    $("#billing-address-form").css("display", "none");
    $("#payment-form").css("display", "none");
    $("#orderSummary-form").css("display", "none");
    
});
    

$('.closebtn').click(function(){
    $(".modal").css("display", "none");
    
})

// VAIDATE SHIPPING FORM DURING INPUT
$(function()  {

    $("#fname_error_message").hide();
    $("#lname_error_message").hide();
    $("#email_error_message").hide();
    $("#phone_error_message").hide();
    $("#address_error_message").hide();
    $("#city_error_message").hide();
    $("#province_error_message").hide();
    $("#pcode_error_message").hide();
    $("#validate_error_message").hide();

    var error_fname = false;
    var error_lname = false;
    var error_email = false;
    var error_phone = false;
    var error_address = false;
    var error_city = false;
    var error_province = false;
    var error_pcode = false;

    $("#fname").focusout(function(){
        check_fname();
    });

    $("#lname").focusout(function(){
        check_lname();
    });

    $("#email").focusout(function(){
        check_email();
    });

    $("#phone").focusout(function(){
        check_phone();
    });

    $("#adr").focusout(function(){
        check_adr();
    });

    $("#city").focusout(function(){
        check_city();
    });

    $("#province").focusout(function(){
        check_province();
    });

    $("#postalcode").focusout(function(){
        check_postalcode();
    });

    function check_fname() {
        var fname = $("#fname").val();
        if (fname !== "") {
            $("#fname_error_message").hide();
            $("#fname").css("border-bottom","2px solid #34F458");
        } else {
            $("#fname_error_message").html("(This is a required field)");
            $("#fname_error_message").show();
            $("#fname").css("border-bottom","2px solid #f25e83");
            error_fname = true;
        }
    }

    function check_lname() {
        var lname = $("#lname").val();
        if (lname !== "") {
            $("#lname_error_message").hide();
            $("#lname").css("border-bottom","2px solid #34F458");
        } else {
            $("#lname_error_message").html("(This is a required field)");
            $("#lname_error_message").show();
            $("#lname").css("border-bottom","2px solid #f25e83");
            error_lname = true;
        }
    }

    function check_email() {
        var email = $("#email").val();
        const emailRGX = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
        if (emailRGX.test(email) && email !== "") {
            $("#email_error_message").hide();
            $("#email").css("border-bottom","2px solid #34F458");
        } else {
            $("#email_error_message").html("(This is a required field)");
            $("#email_error_message").show();
            $("#email").css("border-bottom","2px solid #f25e83");
               error_email = true;
        }
    }

    function check_phone () {
        var phoneNumber = $("#phone").val(); 
        const phoneRGX = /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/; 
        if (phoneRGX.test(phoneNumber) && phoneNumber !== "") {
            $("#phone_error_message").hide();
            $("#phone").css("border-bottom","2px solid #34F458");
        } else {
            $("#phone_error_message").html("(This is a required field)");
            $("#phone_error_message").show();
            $("#phone").css("border-bottom","2px solid #f25e83");
               error_phone = true;
        }
    }

    function check_adr() {
        var address = $("#adr").val();
        if (address !== "") {
            $("#address_error_message").hide();
            $("#adr").css("border-bottom","2px solid #34F458");
        } else {
            $("#address_error_message").html("(This is a required field)");
            $("#address_error_message").show();
            $("#adr").css("border-bottom","2px solid #f25e83");
            error_address = true;
        }
    }

    function check_city() {
        var city = $("#city").val();
        if (city !== "") {
            $("#city_error_message").hide();
            $("#city").css("border-bottom","2px solid #34F458");
        }
        else {
            $("#city_error_message").html("(This is a required field)");
            $("#city_error_message").show();
            $("#city").css("border-bottom","2px solid #f25e83");
            error_city = true;
        }
    }

    function check_province() {
        var province = $("#province").val();
        if (province !== "") {
            $("#province_error_message").hide();
            $("#province").css("border-bottom","2px solid #34F458");
        }
        else {
            $("#province_error_message").html("(This is a required field)");
            $("#province_error_message").show();
            $("#province").css("border-bottom","2px solid #f25e83");
            error_province = true;
        }
    }

    function check_postalcode() {
        var postalCode = $("#postalcode").val();
        const postalcodeRGX = /^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i;
        if (postalcodeRGX.test(postalCode) && postalCode !== "") {
            $("#pcode_error_message").hide();
            $("#postalcode").css("border-bottom","2px solid #34F458");
        }
        else {
            $("#pcode_error_message").html("This is a required field");
            $("#pcode_error_message").show();
            $("#postalcode").css("border-bottom","2px solid #f25e83");
            error_pcode = true;
        }
    }
// -------------------------------------------------------------------------------------------------

    // VALIDATE SHIPPING FORM WHEN "CONTINUE" BTN IS CLICKED
    $(".validateShipping-btn").click(function(){
        error_fname = false;
        error_lname = false;
        error_email = false;
        error_phone = false;
        error_address = false;
        error_city = false;
        error_province = false;
        error_pcode = false;

        check_fname();
        check_lname();
        check_email();
        check_phone();
        check_adr();
        check_city();
        check_province();
        check_postalcode();

        if (error_fname === false && error_lname === false && error_email === false && error_phone === false && error_address === false && error_city === false && error_province === false && error_pcode === false) {
            $("#validate_error_message").hide();
            $("#shipping-address-form").hide();
            $("#payment-form").hide();
            $("#orderSummary-form").hide();
            $("#billing-address-form").show();
            $('.modal').scrollTop(0);
            return true;
        } else {
            $("#validate_error_message").html("Please fill the form correctly");
            $("#validate_error_message").show();
            return false;
        }
    });
})

// -------------------------------------------------------------------------------------------------

// WHEN "BACK" BTN ON *BILLING MODAL IS CLICKED
$(".backToShipping-btn").click(function(){
    $("#validate_error_message").hide();
    $("#billing-address-form").hide();
    $("#payment-form").hide();
    $("#orderSummary-form").hide();
    // show shipping address form
    $("#shipping-address-form").show();
    $('.modal').scrollTop(0);
});

// -------------------------------------------------------------------------------------------------

// WHEN  "BACK" BTN ON *PAYMENT MODAL IS CLICKED
$(".backToBilling-btn").click(function(){
    $("#validate_error_message").hide();
    $("#payment-form").hide();
    $("#shipping-address-form").hide();
    $("#orderSummary-form").hide();
    // show billing address form
    $("#billing-address-form").show();
    $('.modal').scrollTop(0);
});

// -------------------------------------------------------------------------------------------------

// WHEN "CONTINE" BTN ON BILLING MODAL IS CLICKED
$(".validateBilling-btn").click(function() {
    $("#billing-address-form").hide()
    // show payment form
    $("#payment-form").show();
    $('.modal').scrollTop(0);
});

// WHEN "BACK" BTN ON SUMMARY ORDER MODAL IS CLICKED
$(".backToPayment-btn").click(function(){
    $("#validate_error_message").hide();
    $("#shipping-address-form").hide();
    $("#billing-address-form").hide();
    $("#orderSummary-form").hide();
    // show payment form
    $("#payment-form").show();
    $('.modal').scrollTop(0);
});

// CHECKBOX: CHECK IF "BILLING ADDRESS SAME AS SHIPPING" IS CLICKED
$('#check-address').click(function(){
    if ($("#check-address").is(":checked")) {
        $("#billing_fname").val($("#fname").val());
        $("#billing_lname").val($("#lname").val());
        $("#billing_email").val($("#email").val());
        $("#billing_phone").val($("#phone").val());
        $("#billing_adr").val($("#adr").val());
        $("#billing_adr2").val($("#adr2").val());
        $("#billing_city").val($("#city").val());
        $("#billing_province").val($("#province").val());
        $("#billing_postalcode").val($("#postalcode").val());
    } else { // Clear when user unchecks box
        $("#billing_fname").val($("").val());
        $("#billing_lname").val($("").val());
        $("#billing_email").val($("").val());
        $("#billing_phone").val($("").val());
        $("#billing_adr").val($("").val());
        $("#billing_adr2").val($("").val());
        $("#billing_city").val($("").val());
        $("#billing_province").val($("").val());
        $("#billing_postalcode").val($("").val());
    }
});

// -------------------------------------------------------------------------------------------------

// VALIDATE PAYMENT FORM DURING INPUT
$(function() {
    $("#cname_error_message").hide();
    $("#ccnum_error_message").hide();
    $("#expdate_error_message").hide();
    $("#cvc_error_message").hide();
    $("#validatePay_error_message").hide();

    var error_cname = false;
    var error_ccnum = false;
    var error_expdate = false;
    var error_cvc = false;

    $("#cname").focusout(function(){
        check_cname();
    });

    $("#ccnum").focusout(function(){
        check_ccnum();
    });

    $("#expdate").focusout(function(){
        check_expdate();
    });

    $("#cvc").focusout(function(){
        check_cvc();
    });

    function check_cname() {
        var cname = $("#cname").val();
        if (cname !== "") {
            $("#cname_error_message").hide();
            $("#cname").css("border-bottom","2px solid #34F458");
        } else {
            $("#cname_error_message").html("(This is a required field)");
            $("#cname_error_message").show();
            $("#cname").css("border-bottom","2px solid #f25e83");
            error_cname = true;
        }
    }

        function check_ccnum() {
            var ccnum = $("#ccnum").val();
            var visaRGX = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
            var amexpRGX = /^(?:3[47][0-9]{13})$/;
            var discovRGX = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
            var mastercrdRGX = /^(?:5[1-5][0-9]{14})$/;
            var isValid = false;

            if (visaRGX.test(ccnum) && ccnum !== "") {
                isValid = true;
                $(".fa-cc-visa").css("color", "navy");
            } else if (mastercrdRGX.test(ccnum) && ccnum !== "") {
                isValid = true;
                $(".fa-cc-mastercard").css("color", "red");
                } else if (amexpRGX.test(ccnum) && ccnum !== "") {
                    isValid = true
                    $(".fa-cc-amex").css("color", "blue");
                } else if (discovRGX.test(ccnum) && ccnum !== ""){
                    isValid = true;
                    $(".fa-cc-discover").css("color", "orange");
                }
                
                if (isValid) {
                    $("#ccnum_error_message").hide();
                    $("#ccnum").css("border-bottom","2px solid #34F458");
                } else {
                    $("#ccnum_error_message").html("");
                    $("#ccnum_error_message").show();
                    $("#ccnum").css("border-bottom","2px solid #f25e83");
                    error_ccnum = true;
                }
        }

        function check_expdate() {
            // var today = new Date();
            // var someday = new Date();
            // var expireMM = $('#exMonth').val;
            // var expireYY = $('#exYear').val;
            // someday.someday.setFullYear(expireMM, expireYY - 1, someday.getDate());

            var expdate = $("#expdate").val();
            var expdateRGX =  /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/;
            if (expdateRGX.test(expdate) && expdate !== "") {
                $("#expdate_error_message").hide();
                $("#expdate").css("border-bottom","2px solid #34F458");
            } else {
                $("#expdate_error_message").html("");
                $("#expdate_error_message").show();
                $("#expdate").css("border-bottom","2px solid #f25e83");
                error_expdate = true;
            }
        }

        function check_cvc() {
            var cvc = $("#cvc").val();
            var cvcRGX = /^[0-9]{3,4}$/;

            if (cvcRGX.test(cvc) && cvc !== "") {
                $("#cvc_error_message").hide();
                $("#cvc").css("border-bottom","2px solid #34F458");
            } else {
                $("#cvc_error_message").html("");
                $("#cvc_error_message").show();
                $("#cvc").css("border-bottom","2px solid #f25e83");
                error_cvc = true;
            }
        }
// -------------------------------------------------------------------------------------------------
        // VAIDATE PAYMENT FORM WHEN "ORDER SUMMARY" BTN IS CLICKED
        $(".confirmOrder-btn").click(function() {
            error_cname = false;
            error_ccnum = false;
            error_expdate = false;
            error_cvc = false;
        
            check_cname();
            check_ccnum();
            check_expdate();
            check_cvc();
        
            if (error_cname === false && error_ccnum === false && error_expdate === false && error_cvc === false) {
                $("#validate_error_message").hide();
                $("#shipping-address-form").hide();
                $("#billing-address-form").hide();
                $("#payment-form").hide();
                // This function will display order summary resluts
                RenderOrderSummary();
                $('.modal').scrollTop(0);
            } else {
                $("#validatePay_error_message").html("Please enter your payment info correctly.");
                $("#validatePay_error_message").show();
            }
            
        });
})
// -------------------------------------------------------------------------------------------------