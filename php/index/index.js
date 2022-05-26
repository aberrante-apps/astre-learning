

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

