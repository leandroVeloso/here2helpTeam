<?php
	// Includes PDO file
<<<<<<< HEAD
	include_once($_SERVER['DOCUMENT_ROOT'] . 'Inc_files/pdo.inc');
=======
	include_once('pdo.inc');
>>>>>>> 386015224b93546ddc67dea88990955c718f15d5
	
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