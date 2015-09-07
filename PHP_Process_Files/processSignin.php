<?php
	
	// Creates a new global pdo variable
	$pdo = new PDO('mysql:host=localhost;dbname=helpdesk', 'root', '');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Starts session
	session_start();

	// Verifies if user is signed in, if so return true else false
	function verifyIfUserIsSignedIn(){
		if(isset($_SESSION['signin']) &&  $_SESSION['signin'] == 1)
			return true;
		else
			return false;
	}

	// Declare global variables
	$signInInputs = array();
	// If required inputs are not empy or nullset then search for a user with a given email and password
	if(checkNotEmptyOrNull())
		signIn();

	// Function to check if required inputs were set properly in the previous form
	function checkNotEmptyOrNull(){
		// Inform global variables
		global $signInInputs;
		$errorController = 0;

		// If email is set and it's not empty then store it
		if(isset($_POST['email']) && !empty($_POST['email']))
			$signInInputs['email'] = $_POST['email'];
		// Else errorController gets 1 as controller number for an error
		else
			$errorController = 1;

		// If password is set and it's not empty then store it using md5 encrypt function
		if(isset($_POST['password']) && !empty($_POST['password']))
			$signInInputs['password'] = md5($_POST['password']);
		// Else errorController gets 1 as controller number for an error
		else
			$errorController = 1;
		// If no error was caught then return true
		if($errorController == 0)
			return true;
		// Else returns false
		else
			return false;
	}

	// Function to search for a user with a given email and password
	function signIn(){
		// Inform global variables
		global $signInInputs, $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
			$signIn = $pdo->prepare('SELECT email, hash FROM user WHERE email = :email AND hash = :password');
			$signIn->bindValue(':email', $signInInputs['email']);
			$signIn->bindValue(':password', $signInInputs['password']);
			$signIn->execute();
			$result = $signIn->fetchColumn();
			$signIn->execute();

			// If result is different than null then creates some session variables informing user ID and type
			if ($result != null) {
				$_SESSION['signin'] = "1";
				// Redirects user to index page with a success message 
			    header('Location: index.html#signin=success');
			    exit();

			} else {
				// Redirects user to index page with an error message
			    header('Location: signIn.php#signin=warning');
			    exit();
			} 
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
