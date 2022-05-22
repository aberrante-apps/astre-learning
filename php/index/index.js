

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
const registerTitle = document.querySelector(".title-text .register")


/******* LABELS *******/

registerBtn.onclick = (()=>{
    loginForm.style.marginLeft = "-50%";
    loginTitle.style.marginLeft = "-50%";
}); // display register form when register label is clicked

loginBtn.onclick = (()=>{
    loginForm.style.marginLeft = "0%";
    loginTitle.style.marginLeft = "0%";
}); // display login form when login label is clicked


/******** LINKS *********/

registerLink.onclick = (()=>{
    registerBtn.click();
    
});

loginLink.onclick = (()=>{
    loginBtn.click();
    
});

/***************************************************************
* SHOPPING CART - Open and close side nav when Cart is clicked
****************************************************************/
// open
function openNav(){
    $(".sidenav").toggle();
}
// close
function closeNav() {
    $(".sidenav").css("display", "none");    
}

/***************************************************************
* CHECK OUT - Form Verification, Modal Switch
****************************************************************/
// FUNCTION - OPEN-CLOSE CHECKOUT MODAL
function OpenCheckout() {
    $(".modal").css("display", "block");
    $("#billing-address-form").css("display", "none");
    $("#payment-form").css("display", "none");
    $("#orderSummary-form").css("display", "none");
    $(".sidenav").css("display", "none");
}
function CloseModal() {
    $(".modal").css("display", "none");
}

// -------------------------------------------------------------------------------------------------

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
            $("#fname").css("border-bottom","2px solid #F90A0A");
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
            $("#lname").css("border-bottom","2px solid #F90A0A");
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
            $("#email").css("border-bottom","2px solid #F90A0A");
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
            $("#phone").css("border-bottom","2px solid #F90A0A");
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
            $("#adr").css("border-bottom","2px solid #F90A0A");
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
            $("#city").css("border-bottom","2px solid #F90A0A");
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
            $("#province").css("border-bottom","2px solid #F90A0A");
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
            $("#postalcode").css("border-bottom","2px solid #F90A0A");
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
// -------------------------------------------------------------------------------------------------

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
// -------------------------------------------------------------------------------------------------

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
            $("#cname").css("border-bottom","2px solid #F90A0A");
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
                    $("#ccnum_error_message").html("(please provide a valid credit card number. Do not include spaces.)");
                    $("#ccnum_error_message").show();
                    $("#ccnum").css("border-bottom","2px solid #F90A0A");
                    error_ccnum = true;
                }
        }

        function check_expdate() {
            var expdate = $("#expdate").val();
            var expdateRGX =  /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/;
            if (expdateRGX.test(expdate) && expdate !== "") {
                $("#expdate_error_message").hide();
                $("#expdate").css("border-bottom","2px solid #34F458");
            } else {
                $("#expdate_error_message").html("(This is a required field)");
                $("#expdate_error_message").show();
                $("#expdate").css("border-bottom","2px solid #F90A0A");
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
                $("#cvc_error_message").html("(This is a required field)");
                $("#cvc_error_message").show();
                $("#cvc").css("border-bottom","2px solid #F90A0A");
                error_cvc = true;
            }
        }
// -------------------------------------------------------------------------------------------------
        // VAIDATE PAYMENT FORM WHEN "ORDER SUMMARY" BTN IS CLICKED
        $(".validatePayment-btn").click(function() {
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