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
        document.getElementById("passwordError").innerHTML = "Passwords must contain at least 6 characters!";
        document.getElementById('divpass').className = "form-group has-error col-xs-8 label-form-group controls";

    }
}

// Function to change email style
function changeEmailStyle(){
        document.getElementById("errorSpan").innerHTML = "";
        document.getElementById('emaildiv').className = "form-group col-xs-8 label-form-group controls";

}

// Function to change password style
function changePasswordStyle(){
        document.getElementById("errorSpan").innerHTML = "";
        document.getElementById('passworddiv').className = "form-group col-xs-8 label-form-group controls";

}
// Function to change lastname style
function changeLastNameStyle(){
        document.getElementById("errorSpan").innerHTML = "";
        document.getElementById('lnamediv').className = "form-group col-xs-8 label-form-group controls";

}
// Function to change firstname style
function changeFirstNameStyle(){
        document.getElementById("errorSpan").innerHTML = "";
        document.getElementById('fnamediv').className = "form-group col-xs-8 label-form-group controls";

}

// Function to check if there's message (hash) in the URL
function checkForUrlMessages(){
    // If there's a hash in the URL then check for its messages
    if(window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        if(hash == "signup=email"){
            document.getElementById("errorSpan").innerHTML = "Email is already in use. Please try another.";
            document.getElementById('emaildiv').className = "form-group has-error col-xs-8 label-form-group controls";
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalEmail-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalEmail-content').modal({
                show: true
            });
        }

        if(hash == "signin=warning"){
            document.getElementById("errorSpan").innerHTML = "Email or password is wrong.";
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
        }

        if(hash == "createRequest=failed"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalFail-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalFail-content').modal({
                show: true
            });
        }

        if(hash == "createRequest=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalCreateRequestSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalCreateRequestSuccess-content').modal({
                show: true
            });
        }

        if(hash == "deleteRequest=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalDeleteRequestSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalDeleteRequestSuccess-content').modal({
                show: true
            });
        }

        if(hash == "deleteRequest=failed"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalDeleteRequestFail-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalDeleteRequestFail-content').modal({
                show: true
            });
        }

        if(hash == "editRequest=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalEditRequestSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalEditRequestSuccess-content').modal({
                show: true
            });
        }

        if(hash == "editRequest=failed"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalEditRequestFail-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalEditRequestFail-content').modal({
                show: true
            });
        }

        if(hash == "deleteAccount=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalDeleteAccount-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalDeleteAccount-content').modal({
                show: true
            });
        }

        if(hash == "updateAccount=failed"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalEditAccountFail-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalEditAccountFail-content').modal({
                show: true
            });
        }
        if(hash == "updateAccount=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalEditAccountSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalEditAccountSuccess-content').modal({
                show: true
            });
        }

        if(hash == "passChange=success"){
            history.pushState('', document.title, window.location.pathname);
            // set focus when modal is opened
            $('#modalPassSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalPassSuccess-content').modal({
                show: true
            });
        }

        if(hash == "passChange=failed"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalPassError-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalPassError-content').modal({
                show: true
            });
        }


        if(hash == "recoverPassword=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalRecoverSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalRecoverSuccess-content').modal({
                show: true
            });
        }

        if(hash == "recoverPassword=warning"){
            history.pushState('', document.title, window.location.pathname);
            document.getElementById('emaildiv').className = "form-group has-error col-xs-8 label-form-group controls";
            document.getElementById('fnamediv').className = "form-group has-error col-xs-8 label-form-group controls";
            document.getElementById('lnamediv').className = "form-group has-error col-xs-8 label-form-group controls";
            document.getElementById("errorSpan").innerHTML = "Invalid First name, Last name or Email. Please try again.";

            // set focus when modal is opened
            $('#modalRecoverWarning-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalRecoverWarning-content').modal({
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
        }

        if(hash == "approveVolunteer=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalApproveVolunteerSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalApproveVolunteerSuccess-content').modal({
                show: true
            });
        }

        if(hash == "approveVolunteer=failure"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalError-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalError-content').modal({
                show: true
            });
        }

        if(hash == "denyVolunteer=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalDenyVolunteerSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalDenyVolunteerSuccess-content').modal({
                show: true
            });
        }

        if(hash == "denyVolunteer=failure"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalError-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalError-content').modal({
                show: true
            });
        }

        if(hash == "deleteVolunteer=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalDeleteVolunteerSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalDeleteVolunteerSuccess-content').modal({
                show: true
            });
        }

        if(hash == "deleteVolunteer=failure"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalError-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalError-content').modal({
                show: true
            });
        }

        if(hash == "startRequest=success"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalStartRequestSuccess-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalStartRequestSuccess-content').modal({
                show: true
            });
        }

        if(hash == "startRequest=failure"){
            history.pushState('', document.title, window.location.pathname);

            // set focus when modal is opened
            $('#modalError-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#modalError-content').modal({
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
