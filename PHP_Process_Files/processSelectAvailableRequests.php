<?php
	$availableRequests;
	selectAvailableRequest();

	function selectAvailableRequest(){
		global $availableRequests, $pdo;
		try{
			$servicesSelect = $pdo->prepare('SELECT * FROM REQUEST R INNER JOIN PRIORITY P ON P.priorityID = R.priorityID WHERE statusID = 1');
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetchAll();
			$availableRequests = $resultService;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>