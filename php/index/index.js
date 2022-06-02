

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
            $("#prodName_error_message").html("Please input the product's name.");
            $("#prodName_error_message").show();
            $("#prodName").css("border-bottom","2px solid #F90A0A");
               error_prodName = true;
        }
    }

    function check_prodCat() {
        var prodCat = $("#prodCat").val();
        if (prodCat !== "Pick a Category") {
            $("#prodCat_error_message").hide();
            $("#prodCat").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodCat_error_message").html("Please choose the product's category.");
            $("#prodCat_error_message").show();
            $("#prodCat").css("border-bottom","2px solid #F90A0A");
            error_prodCat = true;
        }
    }

    function check_prodType() {
        var prodType = $("#prodType").val();
        if (prodType !== "Pick a Type") {
            $("#prodType_error_message").hide();
            $("#prodType").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodType_error_message").html("Please choose the product's type.");
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
            $("#prodDesc_error_message").html("Please describe the product.");
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
            $("#prodImg_error_message").html("Please upload an image with a file name that has not been used before.");
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
            $("#prodPrice_error_message").html("Please input a valid price for the product.");
            $("#prodPrice_error_message").show();
            $("#prodPrice").css("border-bottom","2px solid #F90A0A");
            error_prodPrice = true;
        }
    }

    function check_prodStock() {
        var prodStock = $("#prodStock").val();
        if (prodStock !== "" || prodStock > 0 ) {
            $("#prodStock_error_message").hide();
            $("#prodStock").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodStock_error_message").html("Please input how many of this product are in stock.");
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