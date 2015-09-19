<?php
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
?>