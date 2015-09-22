// Calls individual checking functions, prints error messages
function validateRequestDetails(){
			
	
	isValid = checkPrice(document.getElementById("minPrice").value, document.getElementById("maxPrice").value);
	
	if (isValid == 1){
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

	isValid = checkDate();
	
	if (isValid == 1){
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
		
	isValid = checkTime();
	
	if (isValid == 1){
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

	return true;
}

// Check if the minimum price is higher than the maximum price
function checkPrice(minPrice, maxPrice){
	
	if (minPrice > maxPrice){
		return 1;
	}
	return 0;
}

// Check if the end date is before the start date
function checkDate(){
	
	var startDate = new Date(jQuery('#startDate').datepicker('getDate'));
	var endDate = new Date(jQuery('#endDate').datepicker('getDate'));
	
	if (startDate > endDate){
		return 1;
	}
	return 0;
}

// Check the available hours
function checkTime(){
	
	var st = document.getElementById("startTime").value; //$('#startTime').val()
	var et = document.getElementById("endTime").value; //$('#endTime').val()

	var hourStartTime = st.substring(0, 2);
	var minuteStartTime = st.substring(3, 5);

	var hourEndTime = et.substring(0, 2);
	var minuteEndTime = et.substring(3, 5);
	
	if (hourStartTime < hourEndTime)
		return 1;
	else{
		if (minuteStartTime < minuteEndTime)
			return 1;
	}


	return 0;
}