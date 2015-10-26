<?php
  include_once('../pdo.inc');
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    denyVolunteer();
  }

  // Deny Volunteer account: Set user to client (general) account (typeID = 1)
  function denyVolunteer(){
    global $pdo;

      try{
        $volunteerDetails = $pdo -> prepare('UPDATE USER
                                          SET typeID = 1
                                          WHERE userID = :userID');
        $volunteerDetails -> bindValue(':userID', $_GET['userID']);
        $result = $volunteerDetails -> execute();

        // Return to list of volunteers and show success/failure pop up
        if ($result) {
  			    header('Location: ../listVolunteers.php#denyVolunteer=success');
  			    exit();
  			}else {
  			    header('Location: ../listVolunteers.php#denyVolunteer=failure');
  			    exit();
  			}
      }
      catch (PDOException $e)
        {echo $e -> getMessage();}
  }

 ?>
