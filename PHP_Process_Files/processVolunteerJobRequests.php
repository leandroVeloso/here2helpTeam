<?php
	$availableRequests;
	selectAvailableRequest();

	function selectAvailableRequest(){
		global $availableRequests, $pdo;
		try{
			$servicesSelect = $pdo->prepare('SELECT * FROM REQUEST R INNER JOIN PRIORITY P ON P.priorityID = R.priorityID INNER JOIN STATUS S ON S.statusID = R.statusID WHERE volunteerID = :volunteerID');

      		$servicesSelect->bindValue(':volunteerID', $_SESSION['userID']);
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetchAll();
			$availableRequests = $resultService;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>