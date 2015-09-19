<?php
	$myRequest;

	if(isset($_GET["request"]))
		selectMyRequestMoreDetails();
	else{
		header('Location: ../requests.php');
		exit();
	}


	// Function to search for a user with a given email and password
	function selectMyRequestMoreDetails(){
		// Inform global variables
		global $myRequest, $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
			$servicesSelect = $pdo->prepare('SELECT * FROM ADDRESS A INNER JOIN REQUEST R ON R.locationID = A.addressID INNER JOIN USER U ON R.clientID = U.userID INNER JOIN PRIORITY P ON P.priorityID = R.priorityID INNER JOIN SERVICE SE ON SE.serviceID = R.serviceID INNER JOIN STATUS S
    ON S.statusID = R.statusID WHERE U.userID = :userID AND R.requestID = :requestID');
			$servicesSelect->bindValue(':userID', $_SESSION['userID']);
			$servicesSelect->bindValue(':requestID', $_GET["request"]);
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetch();

			// If result is different than null then creates some session variables informing user ID and type
			if ($resultService == null) {
			    header('Location: ../requests.php#select=warning');
			    exit();
			}else{
				$myRequest = $resultService;
			}
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
