<?php
  include_once('../pdo.inc');
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    deleteVolunteer();
  }

// Delete volunteer from DB
  function deleteVolunteer(){
    global $pdo;

      try{
        $volunteerDetails = $pdo -> prepare('DELETE FROM USER
                                             WHERE userID = :userID');
        $volunteerDetails -> bindValue(':userID', $_GET['userID']);
        $result = $volunteerDetails -> execute();

        // Return to list of volunteers and show success/failure pop up
        if ($result) {
  			    header('Location: ../listVolunteers.php#deleteVolunteer=success');
  			    exit();
  			}else {
  			    header('Location: ../listVolunteers.php#deleteVolunteer=failure');
  			    exit();
  			}
      }
      catch (PDOException $e){
          echo $e -> getMessage();
        }
  }

 ?>
