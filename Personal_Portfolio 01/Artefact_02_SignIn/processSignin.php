<?php
	 // Includes pdo file
    include_once('../pdo.inc');
	$signInInputs = $_POST;
	signIn();

	// Function: Verifies user exists in DB. If user exists they are directed to listRequests.php otherwise presented with warning details invalid.
	function signIn(){
		global $signInInputs, $pdo;
		try{
			// Query DB to see if user exists
			$signIn = $pdo->prepare('SELECT email, hash, userID FROM USER WHERE email = :email AND hash = :password LIMIT 1');
			$signIn->bindValue(':email', $signInInputs['email']);
			$signIn->bindValue(':password', md5($signInInputs['password']));
			$signIn->execute();
			$result = $signIn->fetch();

			// If user exists sign in is successful and user directed to list of requests. Else user receives warning that details are invalid.
			if ($result != null) {
				$_SESSION['signin'] = "1";
				$_SESSION['userID'] = $result['userID'];
			    header('Location: ../listRequests.php#signin=success');
			    exit();
			}else{
			    header('Location: ../signin.php#signin=warning');
			    exit();
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
