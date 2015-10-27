<?php
	 // Includes pdo file 
    include_once('../pdo.inc');
	$signInInputs = $_POST;
	signIn();

	// Function to search for a user with a given email and password
	function signIn(){
		global $signInInputs, $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
			$signIn = $pdo->prepare('SELECT email, hash, userID, typeID FROM USER WHERE email = :email AND hash = :password LIMIT 1');
			$signIn->bindValue(':email', $signInInputs['email']);
			$signIn->bindValue(':password', md5($signInInputs['password']));
			$signIn->execute();
			$result = $signIn->fetch();

			// If result is different than null then creates some session variables informing user ID and type
			if ($result != null) {

				$_SESSION['signin'] = "1";
				$_SESSION['userID'] = $result['userID'];
				$_SESSION['typeID'] = $result['typeID'];
				
				// Customer
				if ($result['typeID'] == 1){
				    header('Location: ../listRequests.php#signin=success');
				    exit();
				}

				// Volunteer
				if ($result['typeID'] == 2){
				    header('Location: ../listUnassignedRequests.php#signin=success');
				    exit();
				}

				// Applicant
				if ($result['typeID'] == 4){
				    header('Location: ../applicationStatus.php#signin=success');
				    exit();
				}

				// Admin
				if ($result['typeID'] == 5){
				    header('Location: ../listVolunteers.php#signin=success');
				    exit();
				}


			}else{
			    header('Location: ../signin.php#signin=warning');
			    exit();
			} 
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
