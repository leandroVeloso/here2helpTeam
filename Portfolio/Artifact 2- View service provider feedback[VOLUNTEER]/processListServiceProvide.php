<?php

	$serviceList;
	selectAvailableRequest();

	function selectAvailableRequest(){
		global $pdo, $serviceList;
		try{
			$servicesSelect = $pdo->prepare('SELECT SP.name, SP.addressID, SP.website, SP.serviceProviderID, SP.serviceID, SP.website, SP.phoneNo, ROUND(AVG(F.rating),0) AS avgRating
											FROM SERVICEPROVIDER SP 

											LEFT JOIN SERVICEFEEDBACK F 
											ON SP.serviceProviderID = F.serviceProviderID 
																			GROUP BY SP.serviceProviderID');

      		$servicesSelect->bindValue(':serviceProviderID', $_SESSION['userID']);
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetchAll();
			$serviceList = $resultService;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>