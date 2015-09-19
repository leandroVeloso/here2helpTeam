<?php
	$myRequest;
	selectMyRequest();

	function selectMyRequest(){
		global $myRequest, $pdo;
		try{
			$servicesSelect = $pdo->prepare('SELECT *  FROM REQUEST R INNER JOIN USER U ON R.clientID = U.userID INNER JOIN PRIORITY P ON P.priorityID = R.priorityID INNER JOIN STATUS S ON S.statusID = R.statusID WHERE U.userID = :userID');
			$servicesSelect->bindValue(':userID', $_SESSION['userID']);
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetchAll();
			$myRequest = $resultService;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
