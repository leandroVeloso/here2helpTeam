<?php
  $volunteer;
  if (isset($_POST['denyBtn'])) {
    denyVolunteer();
  }

// Deny Volunteer account: Set user to client (general) account (typeID = 1)
  function denyVolunteer(){
    global $pdo, $volunteer;

      try{
        $volunteerDetails = $pdo -> prepare('UPDATE USER
                                          SET typeID = 1
                                          WHERE userID = :userID');
        $volunteerDetails -> bindValue(':userID', $volunteer['userID']);
        $volunteerDetails -> execute();

        if ($result) {
            //header('Location: ../viewVolunteer.php#denied=success');
            exit();
        }else {
            //header('Location: ../viewVolunteer.php#denied=failed');
            exit();
        }

      }
      catch (PDOException $e)
        {echo $e -> getMessage();}
  }

 ?>
