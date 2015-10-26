<?php
	$volunteers;
	$newVolunteers;
	selectAllVolunteers();
	selectNewVolunteers();

	// Selectes all volunteers (TypeID = 2)
	function selectAllVolunteers(){
		global $volunteers, $pdo;
		try{
			$volunteersSelect = $pdo->prepare('SELECT U.userID, U.email, U.firstName, U.lastName, A.suburb, U.phoneNo, ROUND(AVG(F.rating),1) AS rating, U.lastModified
                                      FROM USER U
																			INNER JOIN ADDRESS A
                                      	ON U.addressID = A.addressID
																			INNER JOIN VOLUNTEERFEEDBACK F
																				ON F.volunteerID = U.userID
                                      WHERE U.typeID = 2');
			$volunteersSelect->execute();
			$volunteers = $volunteersSelect->fetchAll();
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}

	// Selects users requesting volunteer accounts (TypeID = 4)
	function selectNewVolunteers(){
		global $newVolunteers, $pdo;
		try{
			$volunteersSelect = $pdo->prepare('SELECT U.userID, U.email, U.firstName, U.lastName, A.suburb, U.phoneNo, U.lastModified
                                      FROM USER U INNER JOIN ADDRESS A
                                      ON U.addressID = A.addressID
                                      WHERE U.typeID = 4');
			$volunteersSelect->execute();
			$newVolunteers = $volunteersSelect->fetchAll();
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}

?>
