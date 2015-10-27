<?php
	 
	include_once('../pdo.inc');
	
	changePassword();
	
	function changePassword(){
		// Inform global variables
		global $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to get all user's information
			$changePassword = $pdo->prepare('UPDATE `USER` SET  `hash` = :hash WHERE userID = :userID');
			$changePassword->bindValue(':hash',md5($_POST['password']));
			$changePassword->bindValue(':userID', $_SESSION['userID']);
			$result = $changePassword->execute();
		
			if ($result) {
					// Redirects user to index page with a success message 
				    header('Location: ../changePassword.php#passChange=success');
				    exit();

				} else {
					// Redirects user to index page with an error message
				    header('Location: ../changePassword.php#passChange=failed');
				    exit();
				}
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
