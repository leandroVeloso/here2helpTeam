<?php
	 // Includes pdo file 
    include_once('../Inc_Files/pdo.inc');
	// Declare global variables
	$signInInputs = $_POST;

	signIn();

	// Function to search for a user with a given email and password
	function signIn(){
		// Inform global variables
		global $signInInputs, $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
			$signIn = $pdo->prepare('SELECT email, hash FROM user WHERE email = :email AND hash = :password');
			$signIn->bindValue(':email', $signInInputs['email']);
			$signIn->bindValue(':password', md5($signInInputs['password']));
			$signIn->execute();
			$result = $signIn->fetchColumn();
			$signIn->execute();

			// If result is different than null then creates some session variables informing user ID and type
			if ($result != null) {
				$_SESSION['signin'] = "1";
				// Redirects user to index page with a success message 
			    header('Location: ../requests.php#signin=success');
			    exit();

			} else {
				// Redirects user to index page with an error message
			    header('Location: ../signin.php#signin=warning');
			    exit();
			} 
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
