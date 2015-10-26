<?php
	include_once('../pdo.inc');
	requestCount();

	function requestCount(){
		global $numRequests, $numJobs ,$pdo;
		try{

				$newRequestCount = $pdo->prepare('SELECT COUNT(*) FROM REQUEST WHERE statusID = 1');
				$newRequestCount->execute();
				$numRequestsResult = $newRequestCount->fetch();
				$numRequests = $numRequestsResult;

				$jobCount = $pdo->prepare('SELECT COUNT(*) FROM REQUEST WHERE volunteerID = :volunteerID');
				$jobCount->bindValue(':volunteerID', $_SESSION['userID']);
				$jobCount->execute();
				$numJobssResult = $jobCount->fetch();
				$numJobs = $numJobssResult;				

			}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
