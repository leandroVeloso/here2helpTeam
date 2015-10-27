<?php
	include_once('../pdo.inc');
	updateAccountInfo();

	function updateAccountInfo(){
		global $pdo;
		try{
			$updateAccountInfoAdress = $pdo->prepare('UPDATE `ADDRESS` SET `unitNumber` = :unitNumber, `street` = :street, `suburb` = :suburb, `state` = :state, `postcode` = :postcode WHERE addressID = :addressID');
		    $updateAccountInfoAdress->bindValue(':unitNumber', $_POST['unumber']);
		    $updateAccountInfoAdress->bindValue(':street', $_POST['street']);
		    $updateAccountInfoAdress->bindValue(':suburb', $_POST['suburb']);
		    $updateAccountInfoAdress->bindValue(':state', $_POST['state']);
		    $updateAccountInfoAdress->bindValue(':postcode', $_POST['postcode']);
		    $updateAccountInfoAdress->bindValue(':addressID', $_SESSION['userAccountInfo']['addressID']);
		    $resultAddress = $updateAccountInfoAdress->execute();

		    $updateAccountInfo = $pdo->prepare('UPDATE `USER` SET `firstName` = :firstName, `lastName` = :lastName, `phoneNo` = :phone WHERE userID = :userID' );
	        $updateAccountInfo->bindValue(':firstName', $_POST['fname']);
	        $updateAccountInfo->bindValue(':lastName', $_POST['lname']);
	        $updateAccountInfo->bindValue(':phone', $_POST['pnumber']);
	        $updateAccountInfo->bindValue(':userID', $_SESSION['userID']);
			$result = $updateAccountInfo->execute();

			$accountInfo = $pdo->prepare('SELECT * FROM ADDRESS A INNER JOIN USER U ON U.addressID = A.addressID INNER JOIN USERTYPE T ON U.typeID = T.typeID WHERE U.userID = :userID');
			$accountInfo->bindValue(':userID', $_SESSION['userID']);
			$accountInfo->execute();
			$result2 = $accountInfo->fetch();
			$_SESSION['userAccountInfo'] = $result2;
		
			if ($result && $result2 && $resultAddress) {
				    header('Location: ../viewAccount.php#updateAccount=success');
				    exit();
				} else {
				    header('Location: ../editAccount.php#updateAccount=failed');
				    exit();
				}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
