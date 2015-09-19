<?php
	$priorities;
	$services;
	selectRequestCombosValues();

	function selectRequestCombosValues(){
		global $services, $pdo, $priorities;
		try{
			$serviceSelect = $pdo->prepare('SELECT * FROM `SERVICE`');
			$serviceSelect->execute();
			$resultService = $serviceSelect->fetchAll();

			$prioritySelect = $pdo->prepare('SELECT * FROM `PRIORITY`');
			$prioritySelect->execute();
			$resultPriority = $prioritySelect->fetchAll();

			if ($resultPriority == null && $resultService == null) {
			    header('Location: ../createRequest.php#select=warning');
			    exit();
			}else{
				$priorities = $resultPriority;
				$services = $resultService;
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
