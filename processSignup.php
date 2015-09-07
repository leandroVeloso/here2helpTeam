<?php
	
	// Creates a new global pdo variable
	$pdo = new PDO('mysql:host=localhost;dbname=helpdesk', 'root', '');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Starts session
	session_start();

	// Declare global variables
	$signUpInputs = array();
		signUp();

	// Function to search for a user with a given email and password
	function signUp(){
		// Inform global variables
		global $signUpInputs, $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
			$signUp = $pdo->prepare('INSERT INTO `user` (`hash`,`email`, `firstName`, `lastName`, `phone`, `typeID`,`unitNumber`,`street`, `suburb`, `state`, `postcode`) VALUES (:hash, :email, :firstName, :lastName, :phone, 1, :unitNumber, :street, :suburb, :state, :postcode)');
			$signUp->bindValue(':hash',md5($_POST['password']));
			$signUp->bindValue(':email', $_POST['email']);
			$signUp->bindValue(':firstName', $_POST['fname']);
			$signUp->bindValue(':lastName', $_POST['email']);
			$signUp->bindValue(':phone', $_POST['pnumber']);
			$signUp->bindValue(':unitNumber', $_POST['unumber']);
			$signUp->bindValue(':street', $_POST['street']);
			$signUp->bindValue(':suburb', $_POST['suburb']);
			$signUp->bindValue(':state', $_POST['state']);
			$signUp->bindValue(':postcode', $_POST['postcode']);
				
			$result = $signUp->execute();

			// If result is different than null then creates some session variables informing user ID and type
			if ($result) {
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
