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
		    header('Location: ../signup.php#signup=email');
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
		        $signUpAddress = $pdo->prepare('INSERT INTO `ADDRESS` (`unitNumber`, `street`, `suburb`, `state`, `postcode`) VALUES (:unitNumber, :street, :suburb, :state, :postcode)');
		        $signUpAddress->bindValue(':unitNumber', $_POST['unumber']);
		        $signUpAddress->bindValue(':street', $_POST['street']);
		        $signUpAddress->bindValue(':suburb', $_POST['suburb']);
		        $signUpAddress->bindValue(':state', $_POST['state']);
		        $signUpAddress->bindValue(':postcode', $_POST['postcode']);
		        $resultAddress = $signUpAddress->execute();
		        $addressID = $pdo->lastInsertId();

		        $signUpUser = $pdo->prepare('INSERT INTO `USER` (`email`, `hash`, `firstName`, `lastName`, `addressID`, `phoneNo`, `typeID`) VALUES (:email, :hash, :firstName, :lastName, :addressID, :phone, 1)');
		        $signUpUser->bindValue(':hash',md5($_POST['password']));
		        $signUpUser->bindValue(':addressID', $addressID);
		        $signUpUser->bindValue(':email', $_POST['email']);
		        $signUpUser->bindValue(':firstName', $_POST['fname']);
		        $signUpUser->bindValue(':lastName', $_POST['lname']);
		        $signUpUser->bindValue(':phone', $_POST['pnumber']);
				$result = $signUpUser->execute();

				// If result is different than null then creates some session variables informing user ID and type
				if ($result && $resultAddress ) {
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
