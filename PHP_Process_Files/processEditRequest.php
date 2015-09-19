<?php
 	// Includes pdo file
    include_once('../pdo.inc');
	// If page has a POST content then check it and after that insert user into the database
	$requestInputs = array();
	$requestInputs = $_POST;
	if($_SERVER['REQUEST_METHOD'] == 'POST' )
		editRequest();


	// Function to search for a user with a given email and password
	function editRequest(){
		// Inform global variables
		global $pdo, $requestInputs;
		try{
			$resultAddress = false;
			if(!isset($requestInputs['addressCheckBox'])){
				// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
				$servicesSelect = $pdo->prepare('SELECT ADDRESS.addressID FROM ADDRESS INNER JOIN REQUEST R ON R.locationID = ADDRESS.addressID INNER JOIN USER U ON R.clientID = U.userID WHERE R.requestID = :requestID');
				$servicesSelect->bindValue(':requestID', $requestInputs['editID']);
				$servicesSelect->execute();
				$resultAdress = $servicesSelect->fetch();

				if( $resultAdress['addressID'] == $_SESSION['userAccountInfo']['addressID']){
			        $requestAddress = $pdo->prepare('INSERT INTO `ADDRESS` (`unitNumber`, `street`, `suburb`, `state`, `postcode`) VALUES (:unitNumber, :street, :suburb, :state, :postcode)');
			        $requestAddress->bindValue(':unitNumber', $requestInputs['unumber']);
			        $requestAddress->bindValue(':street', $requestInputs['street']);
			        $requestAddress->bindValue(':suburb', $requestInputs['suburb']);
			        $requestAddress->bindValue(':state', $requestInputs['state']);
			        $requestAddress->bindValue(':postcode', $requestInputs['postcode']);
			        $resultAddress = $requestAddress->execute();
			        $addressID = $pdo->lastInsertId();
			    }else{
			    	$requestAddress = $pdo->prepare('UPDATE `ADDRESS` SET `unitNumber` = :unitNumber, `street` = :street, `suburb` = :suburb, `state` = :state, `postcode` = :postcode WHERE addressID = :adressID');
			        $requestAddress->bindValue(':unitNumber', $requestInputs['unumber']);
			        $requestAddress->bindValue(':street', $requestInputs['street']);
			        $requestAddress->bindValue(':suburb', $requestInputs['suburb']);
			        $requestAddress->bindValue(':state', $requestInputs['state']);
			        $requestAddress->bindValue(':postcode', $requestInputs['postcode']);
			        $requestAddress->bindValue(':adressID', $resultAdress['addressID']);
			        $resultAddress = $requestAddress->execute();
			        $addressID = $resultAdress['addressID'];
			    }
		    }

			$request = $pdo->prepare('UPDATE `REQUEST` SET `clientID` = :clientID, `requestName`= :requestName, `startDate` = :startDate, `endDate` = :endDate, `startTime` = :startTime, `endTime` = :endTime, `minPrice` = :minPrice, `maxPrice` = :maxPrice, `comment` = :comment, `priorityID` = :priorityID, `locationID` = :locationID, `serviceID` = :serviceID WHERE requestID = :requestID');
			$request->bindValue(':clientID', $_SESSION['userID']);
			$request->bindValue(':requestName', $requestInputs['requestName']);
			$request->bindValue(':startDate', $requestInputs['startDate']);
			$request->bindValue(':endDate', $requestInputs['endDate']);
			$request->bindValue(':startTime', $requestInputs['startTime']);
			$request->bindValue(':endTime', $requestInputs['endTime']);
			$request->bindValue(':minPrice', $requestInputs['minPrice']);
			$request->bindValue(':maxPrice', $requestInputs['maxPrice']);
			$request->bindValue(':comment', $requestInputs['requestDescription']);
			$request->bindValue(':priorityID', $requestInputs['priorityID']);
			$request->bindValue(':serviceID', $requestInputs['serviceID']);
			$request->bindValue(':requestID', $requestInputs['editID']);

			if(!isset($requestInputs['addressCheckBox']))
				$request->bindValue(':locationID', $addressID);
			else
				$request->bindValue(':locationID', $_SESSION['userAccountInfo']['addressID']);

			$result = $request->execute();

				// If result is different than null then creates some session variables informing user ID and type
				if ($result) {
					// Redirects user to index page with a success message
				    header('Location: ../editRequest.php?request='.$requestInputs['editID'].'#editRequest=success');
				    exit();

				} else {
					// Redirects user to index page with an error message
				   	header('Location: ../editeRequest.php?request='.$requestInputs['editID'].'#editRequest=failed');
				    exit();
				}

		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
