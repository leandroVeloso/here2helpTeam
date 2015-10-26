<?php
 	// Includes pdo file
    include_once('../pdo.inc');
	$quoteInputs = array();
	$quoteInputs = $_POST;


	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])){
		if($_POST['action'] == "Add")
			addQuote();
		if($_POST['action'] == "Remove")
			removeQuote();
		if($_POST['action'] == "FinishBooking")
			finishBooking();
	}


	// Function to add quote
	function addQuote(){
		global $pdo, $quoteInputs;
		try{
			$request = $pdo->prepare('INSERT INTO `QUOTE`(`requestID`,  `startDateTime`, `endDateTime`, `description`, `minPrice`, `maxPrice`, `creationDate`, `lastModified`, `startTime`, `endTime`, `serviceProviderID`) 
				VALUES (:requestID ,:startDateTime, :endDateTime, :description, :minPrice, :maxPrice, NOW(), NOW(), :startTime, :endTime, :serviceProviderID)');

			
			$request->bindValue(':requestID', $quoteInputs['requestID']);
			$request->bindValue(':description', $quoteInputs['description']);
			$request->bindValue(':startDateTime',date("Y-m-d", strtotime($quoteInputs['startDate'])));
			$request->bindValue(':endDateTime', date("Y-m-d", strtotime($quoteInputs['endDate'])));
			$request->bindValue(':startTime', $quoteInputs['startTime']);
			$request->bindValue(':endTime', $quoteInputs['endTime']);
			$request->bindValue(':minPrice', $quoteInputs['minPrice']);
			$request->bindValue(':maxPrice', $quoteInputs['maxPrice']);
			$request->bindValue(':serviceProviderID', $quoteInputs['serviceProvider']);

			$result = $request->execute();

			if ($result) {
			    header('Location: ../workOnRequest.php?request='.$quoteInputs['requestID'].'#quoteAdded=success');
			    exit();
			} else {
			   	header('Location: ../workOnRequest.php?request='.$quoteInputs['requestID'].'#quoteAdded=failed');
			    exit();
			}

		}
		catch (PDOException $e)
			{echo $e->getMessage();}
		
	}

	function removeQuote(){
		global $pdo, $quoteInputs;
		try{
			$request = $pdo->prepare('DELETE FROM `QUOTE` WHERE `quoteID`= :quoteID');
			$request->bindValue(':quoteID', $quoteInputs['quoteID']);

			$result = $request->execute();

			if ($result) {
			    header('Location: ../workOnRequest.php?request='.$quoteInputs['requestID'].'#quoteRemoved=success');
			    exit();
			} else {
			   	header('Location: ../workOnRequest.php?request='.$quoteInputs['requestID'].'#quoteRemoved=failed');
			    exit();
			}

		}
		catch (PDOException $e)
			{echo $e->getMessage();}
		
	}

?>
