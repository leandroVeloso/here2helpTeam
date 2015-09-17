<?php
	 
	include_once('../pdo.inc');
	
	deleteAccount();
	
	function deleteAccount(){
		// Inform global variables
		global $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to get all user's information
			$deleteAccount = $pdo->prepare('DELETE FROM USER WHERE userID = :userID');
			$deleteAccount->bindValue(':userID', $_SESSION['userID']);
			$result = $deleteAccount->execute();
		
			if ($result) {
				// Redirects user to index page with a success message 
				session_destroy();
			    header('Location: ../index.php#deleteAccount=success');
			    exit();

			}else {
				// Redirects user to index page with an error message
			    header('Location: ../editAccount.php#deleteAccount=failed');
			    exit();
			}
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
