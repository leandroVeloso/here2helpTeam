<?php
	// Includes PDO file
	include_once('pdo.inc');
	verifyIfUserIsSignedIn();
	// If is a signed in user then destroy session and redirect user to index page with a successful message
	if(verifyIfUserIsSignedIn()){
		session_destroy();
		header('Location: index.php#signout=success');
		exit();
	}
	// Else redirects user to index page
	else {
		header('Location: index.php');
		exit();
	} 
?>