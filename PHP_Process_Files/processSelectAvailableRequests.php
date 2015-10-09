<?php
	$availableRequests;
	selectAvailableRequest();

	function selectAvailableRequest(){
		global $availableRequests, $pdo;
		try{
			$servicesSelect = $pdo->prepare('SELECT * FROM REQUEST WHERE statusID = 1');
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetchAll();
			$availableRequests = $resultService;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>