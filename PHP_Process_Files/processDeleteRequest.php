<?php
	include_once('../pdo.inc');
	$requestID = array();
	$requestID = $_POST;
	if($_SERVER['REQUEST_METHOD'] == 'POST' )
		deleteRequest();
	
	function deleteRequest(){
		global $pdo, $requestID;
		try{
			$deleteRequest = $pdo->prepare('DELETE FROM REQUEST WHERE requestID = :requestID');
			$deleteRequest->bindValue(':requestID', $requestID['requestID']);
			$result = $deleteRequest->execute();

			// If request has a different address ID compared to the user's address, then delete the address from database
			if( $requestID['locationID'] != $_SESSION['userAccountInfo']['addressID']){
				$deleteAddress = $pdo->prepare('DELETE FROM ADDRESS WHERE addressID = :addressID');
				$deleteAddress->bindValue(':addressID', $requestID['locationID']);
				$resultAddress = $deleteAddress->execute();
				if ($resultAddress) {
				    header('Location: ../listRequests.php#deleteRequest=success');
				    exit();
				}else {
				    header('Location: ../listRequests.php#deleteRequest=failed');
				    exit();
				}
			}
			
			if ($result) {
				echo $requestID['requestID'];
			    header('Location: ../listRequests.php#deleteRequest=success');
			    exit();
			}else {
			    header('Location: ../listRequests.php#deleteRequest=failed');
			    exit();
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
