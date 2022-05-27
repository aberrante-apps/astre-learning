

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
* LOGIN / REGISTER - verificatio *******************************/

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
    

    $("#ProdName").focusout(function(){
        check_prodName();
    });

    $("#ProdCat").focusout(function(){
        check_prodCat();
    });

    $("#ProdType").focusout(function(){
        check_prodType();
    });

    $("#ProdDesc").focusout(function(){
        check_prodDesc();
    });

    $("#ProdImg").focusout(function(){
        check_prodImg();
    });

    $("#ProdPrice").focusout(function(){
        check_prodPrice();
    });

    $("#ProdStock").focusout(function(){
        check_prodStock();
    });

    function check_prodName() {
        var prodName = $("#ProdName").val();
        if (prodName !== "") {
            $("#prodName_error_message").hide();
            $("#ProdName").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodName_error_message").html("Please choose a name");
            $("#prodName_error_message").show();
            $("#ProdName").css("border-bottom","2px solid #F90A0A");
               error_prodName = true;
        }
    }

    function check_prodCat() {
        var prodCat = $("#ProdCat").val();
        if (prodCat !== "") {
            $("#prodCat_error_message").hide();
            $("#ProdCat").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodCat_error_message").html("Please choose the category");
            $("#prodCat_error_message").show();
            $("#ProdCat").css("border-bottom","2px solid #F90A0A");
            error_prodCat = true;
        }
    }

    function check_prodType() {
        var prodType = $("#ProdType").val();
        if (prodType !== "") {
            $("#prodType_error_message").hide();
            $("#ProdType").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodType_error_message").html("Please choose the type");
            $("#prodType_error_message").show();
            $("#ProdType").css("border-bottom","2px solid #F90A0A");
            error_prodType = true;
        }
    }

    function check_prodDesc() {
        var prodDesc = $("#ProdDesc").val();
        if (prodDesc !== "") {
            $("#prodDesc_error_message").hide();
            $("#ProdDesc").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodDesc_error_message").html("Please desribe the product");
            $("#prodDesc_error_message").show();
            $("#ProdDesc").css("border-bottom","2px solid #F90A0A");
            error_prodDesc = true;
        }
    }

    function check_prodImg() {
        var prodImg = $("#ProdImg").val();
        if (prodImg !== "") {
            $("#prodImg_error_message").hide();
            $("#ProdImg").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodImg_error_message").html("Please upload an image");
            $("#prodImg_error_message").show();
            $("#ProdImg").css("border-bottom","2px solid #F90A0A");
            error_prodImg = true;
        }
    }

    function check_prodPrice() {
        var prodPrice = $("#ProdPrice").val();
        if (prodPrice !== "") {
            $("#prodPrice_error_message").hide();
            $("#ProdPrice").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodPrice_error_message").html("Please choose a price for the Product");
            $("#prodPrice_error_message").show();
            $("#ProdPrice").css("border-bottom","2px solid #F90A0A");
            error_prodPrice = true;
        }
    }

    function check_prodStock() {
        var prodStock = $("#ProdStock").val();
        if (prodStock !== "") {
            $("#prodStock_error_message").hide();
            $("#ProdStock").css("border-bottom","2px solid #34F458");

        } else {
            $("#prodStock_error_message").html("Please choose a price for the Product");
            $("#prodStock_error_message").show();
            $("#ProdStock").css("border-bottom","2px solid #F90A0A");
            error_prodStock = true;
        }
    }

})