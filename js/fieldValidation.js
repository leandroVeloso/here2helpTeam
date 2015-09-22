// Calls individual checking functions, prints error messages
function validateRequestDetails(){
			
	var values = document.getElementById("createBtn");
	
	fields = new Array(3);
	
	fields[0] = checkPrice(values.form.minPrice.value, values.form.maxPrice.value);
	fields[1] = checkDate();
	fields[2] = checkTime();
	
	for (i = 0; i < fields.length; i++) { 
		if (fields[1] != ""){
			// set focus when modal is opened
            $('#dateError-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#dateError-content').modal({
                show: true
            });
			return false;	
		}
			if (fields[0] != ""){
			// set focus when modal is opened
            $('#priceError-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#priceError-content').modal({
                show: true
            });
			return false;	
		}
			if (fields[2] != ""){
			// set focus when modal is opened
            $('#timeError-content').on('shown.bs.modal', function () {
                $("#txtname").focus();
            });

            // show the modal onload
            $('#timeError-content').modal({
                show: true
            });
			return false;	
		}
	}
	return true;
}

// Check if the minimum price is higher than the maximum price
function checkPrice(minPrice, maxPrice){
	
	if (minPrice >= maxPrice){
		return "The minimum price must be less than the maximum price.";
	}
	return "";
}

// Check if the end date is before the start date
function checkDate(){
	
	var startDate = new Date(jQuery('#startDate').datepicker('getDate'));
	var endDate = new Date(jQuery('#endDate').datepicker('getDate'));
	
	if (startDate > endDate){
		return "The starting date must occur before the end date.";
	}
	return "";
}

// Check the available hours
function checkTime(){
	
	var st = $('#startTime').val();
	var startTime = st.split(':');
	
	var et = $('#endTime').val();
	var endTime = et.split(':');
	
	if (startTime[2] >= endTime[2]){
		return "The start time must be before the end time.";
	}
	return "";
}