<?php
	$myRequest;

	selectMyRequest();

	// Function to search for a user with a given email and password
	function selectMyRequest(){
		// Inform global variables
		global $myRequest, $pdo;
		try{
			// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
			$servicesSelect = $pdo->prepare('SELECT *  FROM REQUEST R INNER JOIN USER U ON R.clientID = U.userID INNER JOIN PRIORITY P ON P.priorityID = R.priorityID INNER JOIN STATUS S
    ON S.statusID = R.statusID WHERE U.userID = :userID');
			$servicesSelect->bindValue(':userID', $_SESSION['userID']);
			$servicesSelect->execute();
			$resultService = $servicesSelect->fetchAll();

			$myRequest = $resultService;
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
