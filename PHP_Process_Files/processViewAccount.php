<?php
	 
	include_once('../pdo.inc');
	
	getAccountInfo();
	
	function getAccountInfo(){
		// Inform global variables
		global $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to get all user's information
			$accountInfo = $pdo->prepare('SELECT * FROM USER WHERE userID = :userID');
			$accountInfo->bindValue(':userID', $_SESSION['userID']);
			$accountInfo->execute();
			$result = $accountInfo->fetch();
			$accountInfo->execute();

			$_SESSION['viewAccountInfo'] = $result;
			header('Location: ../account.php');
		    exit();
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
