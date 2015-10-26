<?php
	 // Includes pdo file 
    checkFeedback();
    $feedbackSP;
    $feedbackVolunteer;


	// Function to check if a request has already been reviewed
	function checkFeedback(){
		global $feedbackSP, $feedbackVolunteer, $myRequest, $pdo;
		try{

			$feedbackSPInfo = $pdo->prepare('SELECT rating FROM SERVICEFEEDBACK WHERE requestID = :requestID');
			$feedbackVolunteerInfo = $pdo->prepare('SELECT rating FROM VOLUNTEERFEEDBACK WHERE requestID = :requestID');
			$feedbackSPInfo->bindValue(':requestID', $myRequest['requestID']);
			$feedbackVolunteerInfo->bindValue(':requestID', $myRequest['requestID']);
			$feedbackSPInfo->execute();
			$feedbackVolunteerInfo->execute();

			
			$resultSPFeedback = $feedbackSPInfo->fetchAll();
			$resultVolunteerFeedback = $feedbackVolunteerInfo->fetchAll();
			$feedbackSP = $resultSPFeedback;
			$feedbackVolunteer = $resultVolunteerFeedback;

			} 

		catch (PDOException $e)
			{echo $e->getMessage();}
	}

?>