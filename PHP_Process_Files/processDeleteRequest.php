<?php
	 
	include_once('../pdo.inc');
	$requestID = array();
	$requestID = $_POST;
	if($_SERVER['REQUEST_METHOD'] == 'POST' )
		deleteRequest();
	
	function deleteRequest(){
		// Inform global variables
		global $pdo, $requestID;
		try{
			// Creates pdo query , prepare its variables and execute it in order to get all user's information
			$deleteRequest = $pdo->prepare('DELETE FROM REQUEST WHERE requestID = :requestID');
			$deleteRequest->bindValue(':requestID', $requestID['requestID']);
			$result = $deleteRequest->execute();


			if( $requestID['locationID'] != $_SESSION['userAccountInfo']['addressID']){
				$deleteAddress = $pdo->prepare('DELETE FROM ADDRESS WHERE addressID = :addressID');
				$deleteAddress->bindValue(':addressID', $requestID['locationID']);
				$resultAddress = $deleteAddress->execute();
				if ($resultAddress) {
				// Redirects user to index page with a success message 
				    header('Location: ../requests.php#deleteRequest=success');
				    exit();

				}else {
					// Redirects user to index page with an error message
				    header('Location: ../requests.php#deleteRequest=failed');
				    exit();
				}
			}

			
			if ($result) {
				// Redirects user to index page with a success message 
				echo $requestID['requestID'];
			    header('Location: ../requests.php#deleteRequest=success');
			    exit();

			}else {
				// Redirects user to index page with an error message
			    header('Location: ../requests.php#deleteRequest=failed');
			    exit();
			}
			
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

?>
