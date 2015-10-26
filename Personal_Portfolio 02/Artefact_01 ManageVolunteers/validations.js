// Function to check if there's message (hash) in the URL
function checkForUrlMessages(){
    // If there's a hash in the URL then check for its messages
    if(window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character

	// Volunteer Approval Succeeded
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
	// Volunteer Approval Failed
	// Set modal to pop up if Volunteer approved successfully
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

	// Volunteer Denial Succeeded
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

	// Volunteer Denial Failed
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

	// Volunteer Delete Succeeded
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

	// Volunteer Delete Failed
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

   }
}

// When page is loaded call function to check for messsages
window.onload = checkForUrlMessages;
