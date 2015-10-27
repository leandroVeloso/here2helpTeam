<?php
	$myRequest;
	if(isset($_GET["request"]))
		selectMyRequestMoreDetails();
	else{
		header('Location: ../requests.php');
		exit();
	}

	function selectMyRequestMoreDetails(){
		global $myRequest, $pdo;
		try{
			$servicesSelect = $pdo->prepare('SELECT * FROM ADDRESS A INNER JOIN REQUEST R ON R.locationID = A.addressID INNER JOIN USER U ON R.clientID = U.userID INNER JOIN PRIORITY P ON P.priorityID = R.priorityID INNER JOIN SERVICE SE ON SE.serviceID = R.serviceID INNER JOIN STATUS S ON S.statusID = R.statusID WHERE U.userID = :userID AND R.requestID = :requestID');
			$servicesSelect->bindValue(':userID', $_SESSION['userID']);
			$servicesSelect->bindValue(':requestID', $_GET["request"]);
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetch();

			if ($resultService == null) {
			    header('Location: ../listRequests.php#select=warning');
			    exit();
			}else
				$myRequest = $resultService;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
