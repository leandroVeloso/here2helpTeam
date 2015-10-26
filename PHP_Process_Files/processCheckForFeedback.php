<?php
	 // Includes pdo file 
    checkFeedback();

	// Function to check if a request has already been reviewed
	function checkFeedback(){
		global $feedback, $myRequest, $pdo;
		try{

			$feedbackInfo = $pdo->prepare('SELECT feedbackID FROM servicefeedback WHERE requestID = :requestID');
			$feedbackInfo->bindValue(':requestID', $myRequest['requestID']);
			$feedbackInfo->execute();
			$resultFeedback = $feedbackInfo->fetchAll();
			$feedback = $resultFeedback;

			} 

		catch (PDOException $e)
			{echo $e->getMessage();}
	}

?>