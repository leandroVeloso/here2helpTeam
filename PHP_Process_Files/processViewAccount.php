<?php
	seletcAccountInfo();

	function seletcAccountInfo(){
		// Inform global variables
		global $pdo;
		try{
			$accountInfo = $pdo->prepare('SELECT * FROM ADDRESS A INNER JOIN USER U ON U.addressID = A.addressID INNER JOIN USERTYPE T ON U.typeID = T.typeID WHERE U.userID = :userID');
			$accountInfo->bindValue(':userID', $_SESSION['userID']);
			$accountInfo->execute();
			$result2 = $accountInfo->fetch();
			$_SESSION['userAccountInfo'] = $result2;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
