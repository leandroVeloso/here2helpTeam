// Function to check if there's message (hash) in the URL
function checkForUrlMessages(){
    // If there's a hash in the URL then check for its messages
    if(window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character

	// Volunteer account successfully assigned help request message
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

	// Volunteer account assigned help request failed message
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

// When page is loaded call function to check for messsages
window.onload = checkForUrlMessages;
