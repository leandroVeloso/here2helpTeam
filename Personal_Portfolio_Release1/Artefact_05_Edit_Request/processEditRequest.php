<?php
 	// Includes pdo file
    include_once('../pdo.inc');
	$requestInputs = array();
	$requestInputs = $_POST;
	if($_SERVER['REQUEST_METHOD'] == 'POST' )
		editRequest();

	function editRequest(){
		global $pdo, $requestInputs;
		try{
			$resultAddress = false;
			// If request has not the same address compared to user's address, then select the other address ID
			if(!isset($requestInputs['addressCheckBox'])){
				// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
				$servicesSelect = $pdo->prepare('SELECT ADDRESS.addressID FROM ADDRESS INNER JOIN REQUEST R ON R.locationID = ADDRESS.addressID INNER JOIN USER U ON R.clientID = U.userID WHERE R.requestID = :requestID');
				$servicesSelect->bindValue(':requestID', $requestInputs['editID']);
				$servicesSelect->execute();
				$resultAdress = $servicesSelect->fetch();

				// If the stored request address is the same of the account, then create a new address row instead of only updating it (else) 
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
			    	$requestAddress = $pdo->prepare('UPDATE `ADDRESS` SET `unitNumber` = :unitNumber, `street` = :street, `suburb` = :suburb, `state` = :state, `postcode` = :postcode WHERE addressID = :adressID ');
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

			$request = $pdo->prepare('UPDATE `REQUEST` SET `clientID` = :clientID, `requestName`= :requestName, `startDate` = :startDate, `endDate` = :endDate, `lastModified` = NOW(),`startTime` = :startTime, `endTime` = :endTime, `minPrice` = :minPrice, `maxPrice` = :maxPrice, `comment` = :comment, `priorityID` = :priorityID, `locationID` = :locationID, `serviceID` = :serviceID WHERE requestID = :requestID');
			$request->bindValue(':clientID', $_SESSION['userID']);
			$request->bindValue(':requestName', $requestInputs['requestName']);
			$request->bindValue(':startDate',  date("Y-m-d", strtotime($requestInputs['startDate'])));
			$request->bindValue(':endDate', date("Y-m-d", strtotime($requestInputs['endDate'])));
			$request->bindValue(':startTime', $requestInputs['startTime']);
			$request->bindValue(':endTime', $requestInputs['endTime']);
			$request->bindValue(':minPrice', $requestInputs['minPrice']);
			$request->bindValue(':maxPrice', $requestInputs['maxPrice']);
			$request->bindValue(':comment', $requestInputs['requestDescription']);
			$request->bindValue(':priorityID', $requestInputs['priorityID']);
			$request->bindValue(':serviceID', $requestInputs['serviceID']);
			$request->bindValue(':requestID', $requestInputs['editID']);

			// If user is not using the registered address store the ID of the new address, otherwise store the ID of the user's address
			if(!isset($requestInputs['addressCheckBox']))
				$request->bindValue(':locationID', $addressID);
			else
				$request->bindValue(':locationID', $_SESSION['userAccountInfo']['addressID']);

			$result = $request->execute();
			
			if ($result) {
			    header('Location: ../editRequest.php?request='.$requestInputs['editID'].'#editRequest=success');
			    exit();
			} else {
			   	header('Location: ../editRequest.php?request='.$requestInputs['editID'].'#editRequest=failed');
			    exit();
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
