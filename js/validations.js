// Function to valide password (If is greater then 5 characteres and confirmation matche)
function checkPassword(){
    var pass = document.getElementById("password").value;
    var confPass = document.getElementById("conpassword").value
    // Verifies if password is greater or equal than 6 
    if(pass.length >= 6){
        //  If passwords don't match then change label style and show error message
        if(pass != confPass && confPass != ""){
            document.getElementById("passwordError").innerHTML = "Passwords don't match";
            document.getElementById('divconpass').className = "form-group has-error col-xs-8 label-form-group controls";
            
        }else{
            //  If passwords match then change label style and hide error message
            document.getElementById("passwordError").innerHTML = "";
            document.getElementById('divconpass').className = "form-group col-xs-8 label-form-group controls";
            document.getElementById('divpass').className = "form-group col-xs-8 label-form-group controls";
            
        }
    }else{
        //  If password is less than 6 then change label style and show error message
        document.getElementById("passwordError").innerHTML = "Passwords must contain at least 6 characteres!";
        document.getElementById('divpass').className = "form-group has-error col-xs-8 label-form-group controls";
        
    }
}

// Function to change email style
function changeEmailStyle(){
        document.getElementById("emailError").innerHTML = "";
        document.getElementById('emaildiv').className = "form-group col-xs-8 label-form-group controls";
         
}

// Function to change password style
function changePasswordStyle(){
        document.getElementById("emailError").innerHTML = "";
        document.getElementById('passworddiv').className = "form-group col-xs-8 label-form-group controls";
         
}

// Function to check if there's message (hash) in the URL
function checkForUrlMessages(){
    // If there's a hash in the URL then check for its messages
    if(window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        if(hash == "signin=email"){
            document.getElementById("emailError").innerHTML = "E-mail is already in use. Please try another.";
            document.getElementById('divemail').className = "form-group has-error col-xs-8 label-form-group controls";
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modal-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modal-content').modal({
                show: true
            });

            
            $('#modal-content').modal({
                show: true
            });
        }

        if(hash == "signin=warning"){
            document.getElementById("emailError").innerHTML = "Email or password wrong";
            document.getElementById('emaildiv').className = "form-group has-error col-xs-8 label-form-group controls";
            document.getElementById('passworddiv').className = "form-group has-error col-xs-8 label-form-group controls";
            history.pushState('', document.title, window.location.pathname);
        }

        if(hash == "signin=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modal-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modal-content').modal({
                show: true
            });

            
            $('#modal-content').modal({
                show: true
            });
        }

        if(hash == "signup=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalSignUp-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalSignUp-content').modal({
                show: true
            });

            
            $('#modalSignUp-content').modal({
                show: true
            });
        }

        if(hash == "signout=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalSignOut-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalSignOut-content').modal({
                show: true
            });

            
            $('#modalSignOut-content').modal({
                show: true
            });
        }

        if(hash == "signin=failed"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalSignIn-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalSignOut-content').modal({
                show: true
            });

            
            $('#modalSignOut-content').modal({
                show: true
            });
        }

   }
}

//Fuction which only allows user to type numbers
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

// When page is loaded call function to check for messsages
window.onload = checkForUrlMessages;