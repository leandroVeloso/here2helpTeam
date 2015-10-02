<?php
	$volunteers;
	selectAllVolunteers();

	function selectAllVolunteers(){
		global $volunteers, $pdo;
		try{
			$volunteersSelect = $pdo->prepare('SELECT U.userID, U.email, U.firstName, U.lastName, A.suburb, U.phoneNo, U.lastModified
                                      FROM USER U INNER JOIN ADDRESS A
                                      ON U.addressID = A.addressID
                                      WHERE U.typeID = 2');
    /*  $volunteersSelect->bindValue(':volunteerID', $_POST['userID']);
      $volunteersSelect->bindValue(':email', $_POST['email']);
      $volunteersSelect->bindValue(':firstName', $_POST['firstName']);
      $volunteersSelects->bindValue(':lastName', $_POST['lastName']);
      $volunteersSelect->bindValue(':suburb', $_POST['suburb']);
      $volunteersSelect->bindValue(':phoneNo', $_POST['phoneNo']);
      $volunteersSelects->bindValue(':lastModified', $_POST['lastModified']);*/
			$volunteersSelect->execute();
			$volunteers = $volunteersSelect->fetchAll();
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
