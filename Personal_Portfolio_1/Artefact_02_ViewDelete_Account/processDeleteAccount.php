<?php
	include_once('../pdo.inc');
	deleteAccount();
	
	function deleteAccount(){
		// Inform global variables
		global $pdo;
		try{
			$deleteAccount = $pdo->prepare('DELETE FROM USER WHERE userID = :userID');
			$deleteAccount->bindValue(':userID', $_SESSION['userID']);

			$deleteAddress = $pdo->prepare('DELETE FROM ADDRESS WHERE addressID = :addressID');
			$deleteAddress->bindValue(':addressID', $_SESSION['userAccountInfo']['addressID']);

			$result = $deleteAccount->execute();
			$addressResult = $deleteAddress->execute();
		
			if ($result && $addressResult) {
				session_destroy();
			    header('Location: ../index.php#deleteAccount=success');
			    exit();
			}else {
			    header('Location: ../editAccount.php#deleteAccount=failed');
			    exit();
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
