function setHIddenAttributes(){

	var tmp = volunteerSignupCheck();
	var tmp2 = setZone();


	return true;
}

function volunteerSignupCheck(){

	if (document.getElementById('volunteer').checked){

		document.getElementById('typeID').setAttribute('value', parseInt(4));

		return true;
	}

	document.getElementById('typeID').setAttribute('value', parseInt(1));
	
	return true;
}


function setZone(){

	var postcode = document.getElementById('postcode').value;

	var northernSuburbs = [4010, ]; 
	var southernSuburbs = [, ]; 
	var westernSuburbs = [, ]; 
	var easternSuburbs = [, ]; 
	var innerSuburbs = [];

	value = northernSuburbs.length + southernSuburbs.length + westernSuburbs.length + easternSuburbs.length;

	for (var i = 0; i < value; i++){

		if (postcode == northernSuburbs[i]){

			zone = 'North';
			break;
		}
		if (postcode == southernSuburbs[i]){

			zone = 'South';
			break;
		}
		if (postcode == westernSuburbs[i]){

			zone = 'East';
			break;
		}
		if (postcode == easternSuburbs[i]){

			zone = 'West';
			break;
		}
		if (postcode == innerSuburbs[i]){

			zone = 'Inner';
			break;
		}

	}


	document.getElementById('zone').setAttribute('value', zone);

	return true;
}