<?php
	 // Includes pdo file 
    include_once('../pdo.inc');
	rating();

	// Function to insert service provider review in database
	function rating(){
		global $serviceProviderInfo, $pdo;
		try{

			// retrieve service provider data
			$servicesInfo = $pdo->prepare('SELECT serviceProviderID FROM quote WHERE requestID = :requestID');
			$servicesInfo->bindValue(':requestID', $_POST['requestID']);
			$servicesInfo->execute();
			$resultServiceProvider = $servicesInfo->fetchAll();
			$serviceProviderInfo = $resultServiceProvider;

			// insert feedback data
			$rating = $pdo->prepare('INSERT INTO  `servicefeedback` (`requestID`, `serviceProviderID`, `rating`) VALUES (:requestID, :serviceProviderID, :rating)');
			$rating->bindValue(':requestID', $_POST['requestID']);
			$rating->bindValue(':serviceProviderID', (int)$serviceProviderInfo);
			$rating->bindValue(':rating', $_POST['rating']);
			$result = $rating->execute();

			} 

		catch (PDOException $e)
			{echo $e->getMessage();}
	}

	header("Location: ../listRequests.php");
	die();

?>