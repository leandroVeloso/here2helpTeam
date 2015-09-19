<?php
	$priorities;
	$services;

	selectRequestCombosValues();

	// Function to search for a user with a given email and password
	function selectRequestCombosValues(){
		// Inform global variables
		global $services, $pdo, $priorities;
		try{
			// Creates pdo query , prepare its variables and execute it in order to find a user that matches the password
			$serviceSelect = $pdo->prepare('SELECT * FROM `service`');
			$serviceSelect->execute();
			$resultService = $serviceSelect->fetchAll();

			$prioritySelect = $pdo->prepare('SELECT * FROM `priority`');
			$prioritySelect->execute();
			$resultPriority = $prioritySelect->fetchAll();

			// If result is different than null then creates some session variables informing user ID and type
			if ($resultPriority == null && $resultService == null) {
			    header('Location: ../createRequest.php#select=warning');
			    exit();
			}else{
				$priorities = $resultPriority;
				$services = $resultService;
			}
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
