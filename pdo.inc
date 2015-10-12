<?php
	//Defining constants
	define("CUSTOMER", "1");
	define("VOLUNTEER", "2");
	define("APPLICANT", "4");
	define("ADMIN", "5");

	// Creates a new global pdo variable
	$pdo = new PDO('mysql:host=localhost;dbname=helpdesk', 'root', '');
	//$pdo = new PDO('mysql:host=localhost;dbname=Helpdesk', 'root', 'root');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// Starts session
	session_start();
	// Verifies if user is signed in, if so return true else false
	function verifyIfUserIsSignedIn(){
		if(isset($_SESSION['signin']) &&  $_SESSION['signin'] == 1)
			return true;
		else{
			header('Location: /index.php');
			exit();
			return false;
		}
	}

	function verifyUserType($expectedType){
		if(isset($_SESSION['signin']) &&  isset($_SESSION['typeID']) && $_SESSION['typeID'] == $expectedType)
			return true;
		else
			return false;
	}

	function redirectUser($redirect, $url){
		//if false then redirect
		if(!$redirect){
			header('Location:'.$url);
			exit();
		}
	}
?>