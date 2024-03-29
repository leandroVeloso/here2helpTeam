<?php
 	// Includes pdo file
    include_once('../pdo.inc');
	$requestInputs = array();
	$requestInputs = $_POST;
	if($_SERVER['REQUEST_METHOD'] == 'POST' )
		createRequest();

	// Function to create the helprequest
	function createRequest(){
		global $pdo, $requestInputs;
		try{
			getAccountInfo();
			$resultAddress = false;
			// If the user is not using the registered address, then insert new address
			if(!isset($requestInputs['addressCheckBox'])){
		        $requestAddress = $pdo->prepare('INSERT INTO `ADDRESS` (`unitNumber`, `street`, `suburb`, `state`, `postcode`) VALUES (:unitNumber, :street, :suburb, :state, :postcode)');
		        $requestAddress->bindValue(':unitNumber', $requestInputs['unumber']);
		        $requestAddress->bindValue(':street', $requestInputs['street']);
		        $requestAddress->bindValue(':suburb', $requestInputs['suburb']);
		        $requestAddress->bindValue(':state', $requestInputs['state']);
		        $requestAddress->bindValue(':postcode', $requestInputs['postcode']);
		        $resultAddress = $requestAddress->execute();
		        $addressID = $pdo->lastInsertId();
		    }

			$request = $pdo->prepare('INSERT INTO `REQUEST` (`clientID`, `requestName`, `startDate`, `endDate`, `startTime`, `endTime`, `minPrice`, `maxPrice`, `comment`, `priorityID`, `locationID`, `statusID`, `serviceID`, `creationDate`, `lastModified`)
			VALUES (:clientID, :requestName, :startDate, :endDate, :startTime, :endTime, :minPrice, :maxPrice, :comment, :priorityID, :locationID, 1, :serviceID, NOW(), NOW())');
			$request->bindValue(':clientID', $_SESSION['userAccountInfo']['userID']);
			$request->bindValue(':requestName', $requestInputs['requestName']);
			$request->bindValue(':startDate',date("Y-m-d", strtotime($requestInputs['startDate'])));
			$request->bindValue(':endDate', date("Y-m-d", strtotime($requestInputs['endDate'])));
			$request->bindValue(':startTime', $requestInputs['startTime']);
			$request->bindValue(':endTime', $requestInputs['endTime']);
			$request->bindValue(':minPrice', $requestInputs['minPrice']);
			$request->bindValue(':maxPrice', $requestInputs['maxPrice']);
			$request->bindValue(':comment', $requestInputs['requestDescription']);
			$request->bindValue(':priorityID', $requestInputs['priorityID']);
			$request->bindValue(':serviceID', $requestInputs['serviceID']);

			// If user is not using the registered address store the ID of the new address, otherwise store the ID of the user's address
			if(!isset($requestInputs['addressCheckBox']))
				$request->bindValue(':locationID', $addressID);
			else
				$request->bindValue(':locationID', $_SESSION['userAccountInfo']['addressID']);

			$result = $request->execute();

			if ($result) {
			    header('Location: ../listRequests.php#createRequest=success');
			    exit();
			} else {
			   	header('Location: ../createRequest.php#createRequest=failed');
			    exit();
			}

		}
		catch (PDOException $e)
			{echo $e->getMessage();}
		
	}

	function getAccountInfo(){
		global $pdo;
		try{
			$accountInfo = $pdo->prepare('SELECT * FROM ADDRESS A INNER JOIN USER U ON U.addressID = A.addressID INNER JOIN USERTYPE T ON U.typeID = T.typeID WHERE U.userID = :userID');
			$accountInfo->bindValue(':userID', $_SESSION['userID']);
			$accountInfo->execute();
			$result = $accountInfo->fetch();

			$_SESSION['userAccountInfo'] = $result;

		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
