<?php
	$availableRequests;
	selectAvailableRequest();

	function selectAvailableRequest(){
		global $availableRequests, $pdo;
		try{
			$servicesSelect = $pdo->prepare('SELECT R.requestID, R.requestName, P.priorityID, R.startDate, Z.zone FROM REQUEST R INNER JOIN PRIORITY P 
				ON R.priorityID = P.priorityID 
				INNER JOIN ADDRESS A 
				ON R.locationID = A.addressID 
				INNER JOIN ZONES Z 
				ON Z.zoneID = A.zoneID 
				WHERE R.statusID = 1
				ORDER BY A.zoneID');
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetchAll();
			$availableRequests = $resultService;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>