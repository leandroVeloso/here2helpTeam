
var CBD = [4000,4005,4006,4007,4009,4010,4011,4030,4051,4059,4060,4064,4065,4067,4072,4101,4102,4169,4170,4171,4172];
var northernSuburbs = [4008,4012,4014,4017,4018,4019,4020,4021,4022,4025,4032,4034,4035,4036,4037,4500,4501,4502,4503,4504,4505,4506,4507,4508,4509,4510,4511,4512,4514,4516,4520,4521]; 
var southernSuburbs = [4112,4114,4115,4116,4117,4118,4119,4124,4125,4127,4128,4129,4130,4131,4132,4133,4163,4164,4165,4183,4184,4205,4207,4280]; 
var ipswich = [4300,4301,4303,4304,4305]; 
var southEasternSuburbs = [4153,4154,4155,4156,4157,4158,4159,4160,4161,4173,4174,4178,4179]; 
var innerSuburbs = [4031,4053,4054,4055,4061,4066,4068,4069,4073,4074,4075,4076,4077,4078,4103,4104,4105,4106,4107,4108,4109,4110,4111,4113,4120,4121,4122,4123,4151,4152];

function setHIddenAttributes(){

	volunteerSignupCheck();
	setZone();

	return true;
}

function volunteerSignupCheck(){

	if (document.getElementById('volunteer').checked){

		document.getElementById('typeID').setAttribute('value', 4);
	}

}

function setZone(){

	var postcode = document.getElementById('postcode').value;
	var zone = 0;

	for (var i = 0; i < CBD.length; i++){

		if (postcode == CBD[i]){

			zone = 1;
			break;
		}
	}

	if (zone == 0){
		for (var i = 0; i < northernSuburbs.length; i++){
			if (postcode == northernSuburbs[i]){

				zone = 2;
				break;
			}
		}
	}

	if (zone == 0){
		for (var i = 0; i < southernSuburbs.length; i++){	
			if (postcode == southernSuburbs[i]){

				zone = 3;
				break;
			}
		}	
	}

	if (zone == 0){
		for (var i = 0; i < ipswich.length; i++){		
			if (postcode == ipswich[i]){

				zone = 4;
				break;
			}
		}	
	}

	if (zone == 0){
		for (var i = 0; i < southEasternSuburbs.length; i++){		
			if (postcode == southEasternSuburbs[i]){

				zone = 5;
				break;
			}
		}	
	}

	if (zone == 0){
		for (var i = 0; i < innerSuburbs.length; i++){		
			if (postcode == innerSuburbs[i]){

				zone = 6;
				break;
			}
		}	
	}

	document.getElementById('zone').setAttribute('value', zone);
}