function volunteerSignupCheck(){

	if (document.getElementById('volunteer').checked){

		document.getElementById('typeID').setAttribute('value', parseInt(4));

		return true;
	}

	document.getElementById('typeID').setAttribute('value', parseInt(1));
	
	return true;
}