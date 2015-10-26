<?php

	$serviceList;
	selectAvailableRequest();

	function selectAvailableRequest(){
		global $pdo, $serviceList;
		try{
			$servicesSelect = $pdo->prepare('SELECT SP.name, SP.addressID, SP.website, SP.serviceProviderID, SP.serviceID, SP.website, SP.phoneNo, (SELECT CASE WHEN  ROUND(AVG(F.rating),0) IS NULL THEN \'None\' ELSE  ROUND(AVG(F.rating),0) END AS avgRating FROM SERVICEPROVIDER SP INNER JOIN SERVICEFEEDBACK F ON SP.serviceProviderID = F.serviceProviderID');

      		$servicesSelect->bindValue(':serviceProviderID', $_SESSION['userID']);
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetchAll();
			$serviceList = $resultService;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>