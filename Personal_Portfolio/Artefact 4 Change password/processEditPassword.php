<?php
	include_once('../pdo.inc');
	changePassword();
	
	function changePassword(){
		global $pdo;
		try{
			$changePassword = $pdo->prepare('UPDATE `USER` SET  `hash` = :hash WHERE userID = :userID');
			$changePassword->bindValue(':hash',md5($_POST['password']));
			$changePassword->bindValue(':userID', $_SESSION['userID']);
			$result = $changePassword->execute();
		
			if ($result) {
			    header('Location: ../editPassword.php#passChange=success');
			    exit();
			}else {
			    header('Location: ../editPassword.php#passChange=failed');
			    exit();
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
