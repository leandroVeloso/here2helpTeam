<?php
include_once('../pdo.inc');
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
      approveVolunteer();
    }

  // Approve Volunteer account: Set user to volunteer (typeID = 2)
  function approveVolunteer(){
    global $pdo;

      try{
        $volunteerDetails = $pdo -> prepare('UPDATE USER
                                          SET typeID = 2
                                          WHERE userID = :userID');
        $volunteerDetails -> bindValue(':userID', $_GET['userID']);
        $result = $volunteerDetails -> execute();

        // Indicate to admin if approval succeeded.
        if ($result) {
  			    header('Location: ../listVolunteers.php#approveVolunteer=success');
  			    exit();
  			}else {
  			    header('Location: ../listVolunteers.php#approveVolunteer=failure');
  			    exit();
  			}
      }
      catch (PDOException $e)
        {echo $e -> getMessage();}
}
 ?>
