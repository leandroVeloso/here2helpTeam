<?php
	 
	include_once('../pdo.inc');
	
	updateAccountInfo();
	
	function updateAccountInfo(){
		// Inform global variables
		global $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to get all user's information
			$updateAccountInfo = $pdo->prepare('UPDATE `USER` SET  `hash` = :hash,`email`= :email, `firstName` = :firstName, `lastName`= :lastName, `phone` = :phone, `unitNumber` = :unitNumber,`street` = :street, `suburb` = :suburb, `state` = :state, `postcode` = :postcode WHERE userID = :userID');
			$updateAccountInfo->bindValue(':hash',md5($_POST['password']));
			$updateAccountInfo->bindValue(':email', $_POST['email']);
			$updateAccountInfo->bindValue(':firstName', $_POST['fname']);
			$updateAccountInfo->bindValue(':lastName', $_POST['lname']);
			$updateAccountInfo->bindValue(':phone', $_POST['pnumber']);
			$updateAccountInfo->bindValue(':unitNumber', $_POST['unumber']);
			$updateAccountInfo->bindValue(':street', $_POST['street']);
			$updateAccountInfo->bindValue(':suburb', $_POST['suburb']);
			$updateAccountInfo->bindValue(':state', $_POST['state']);
			$updateAccountInfo->bindValue(':postcode', $_POST['postcode']);
			$updateAccountInfo->bindValue(':userID', $_SESSION['userID']);
			$result = $updateAccountInfo->execute();

			$accountInfo = $pdo->prepare('SELECT * FROM USER WHERE userID = :userID');
			$accountInfo->bindValue(':userID', $_SESSION['userID']);
			$accountInfo->execute();
			$result2 = $accountInfo->fetch();

			$_SESSION['userAccountInfo'] = $result2;
		
			if ($result && $result2) {
					// Redirects user to index page with a success message 
				    header('Location: ../editAccount.php#updateAccount=success');
				    exit();

				} else {
					// Redirects user to index page with an error message
				    header('Location: ../editAccount.php#updateAccount=failed');
				    exit();
				}
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
