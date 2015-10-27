<?php
	$myRequest;
	requestDetails();

  // Selects help request details from DB
	function requestDetails(){
		global $myRequest, $pdo;
		try{
			$selectRequest = $pdo->prepare('SELECT * FROM ADDRESS A
        INNER JOIN REQUEST R ON R.locationID = A.addressID
        INNER JOIN USER U ON R.clientID = U.userID
        INNER JOIN PRIORITY P ON P.priorityID = R.priorityID
        INNER JOIN SERVICE SE ON SE.serviceID = R.serviceID
        INNER JOIN STATUS S ON S.statusID = R.statusID
        WHERE R.requestID = :requestID');
			$selectRequest->bindValue(':requestID', $_GET['request']);
			$selectRequest->execute();
			$myRequest = $selectRequest->fetch();
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
