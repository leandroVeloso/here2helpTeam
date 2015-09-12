<?php
 	// Includes pdo file 
    include_once('../pdo.inc');
	// Declare global variables
	$signUpInputs = array();
	$signUpInputs = $_POST;
	// If page has a POST content then check it and after that insert user into the database
	if($_SERVER['REQUEST_METHOD'] == 'POST' ){
		if(!checkEmail())
			signUp();
		else{
			$_SESSION['errors'] = "true";
			$_SESSION['userInputs'] = $signUpInputs;
			// Redirects user to index page with an error message
		    header('Location: ../signup.php#signin=email');
		    exit();
		}
	}
	

	// Function to search for a user with a given email and password
	function signUp(){
		// Inform global variables
		global $signUpInputs, $pdo;
		try{

			if(!checkEmail()){
				// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
				$signUp = $pdo->prepare('INSERT INTO `USER` (`hash`,`email`, `firstName`, `lastName`, `phone`, `typeID`,`unitNumber`,`street`, `suburb`, `state`, `postcode`) VALUES (:hash, :email, :firstName, :lastName, :phone, 1, :unitNumber, :street, :suburb, :state, :postcode)');
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
				    header('Location: ../signin.php#signup=success');
				    exit();

				} else {
					// Redirects user to index page with an error message
				    header('Location: ../signup.php#signin=failed');
				    exit();
				}
			}
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	// Function to check if the email is already in use
	function checkEmail(){
		global $signUpInputs, $pdo;
		try{
			$checkEmailQuery = $pdo->prepare('SELECT email FROM USER WHERE email = :email');
			$checkEmailQuery->bindValue(':email', $_POST['email']);
			$checkEmailQuery->execute();
			$result = $checkEmailQuery->fetchColumn();

			if ($result != null) 
				return true;
			else
				return false;

		}
		catch (PDOException $e){
			echo $e->getMessage();
		}

	}

?>
