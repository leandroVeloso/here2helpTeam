<?php

	$serviceList;
	selectAvailableRequest();

	function selectAvailableRequest(){
		global $pdo, $serviceList;
		try{
			$servicesSelect = $pdo->prepare('SELECT SP.name, A.suburb, SP.website, SP.serviceProviderID, SP.phoneNo, S.service, ROUND(AVG(F.rating),0) AS avgRating
																			FROM SERVICEPROVIDER SP
																			INNER JOIN
																			ADDRESS A
																			ON SP.addressID = A.addressID
																			INNER JOIN SERVICE S
																			ON SP.serviceID = S.serviceID
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
