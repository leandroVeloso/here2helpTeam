<?php
 	// Includes pdo file
    include_once('../pdo.inc');
	$signUpInputs = array();
	$signUpInputs = $_POST;

	// If page has a POST content then check it and after that insert user into the database
	if($_SERVER['REQUEST_METHOD'] == 'POST' ){
		if(!checkEmail())
			signUp();
		else{
			$_SESSION['errors'] = "true";
			$_SESSION['userInputs'] = $signUpInputs;
		    header('Location: ../signup.php#signup=email');
		    exit();
		}
	}

	function signUp(){
		global $signUpInputs, $pdo;
		try{

			if(!checkEmail()){
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

				if ($result && $resultAddress ) {
				    header('Location: ../signin.php#signup=success');
				    exit();
				}else{
				    header('Location: ../signup.php#signin=failed');
				    exit();
				}
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
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
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
