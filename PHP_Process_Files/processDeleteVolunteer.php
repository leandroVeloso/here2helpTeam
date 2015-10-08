<?php
  $volunteer;
  if (isset($_POST['deleteBtn'])) {
    deleteVolunteer();
  }

// Change volunteer to a client (general) account when deleted (typeID = 1)
  function deleteVolunteer(){
    global $pdo, $volunteer;

      try{
        $volunteerDetails = $pdo -> prepare('UPDATE USER
                                          SET typeID = 1
                                          WHERE userID = :userID');
        $volunteerDetails -> bindValue(':userID', $volunteer['userID']);
        $result = $volunteerDetails -> execute();

        if ($result) {
  			    //header('Location: ../viewVolunteer.php#deleted=success');
  			    exit();
  			}else {
  			    //header('Location: ../viewVolunteer.php#deleted=failed');
  			    exit();
  			}



      }
      catch (PDOException $e)
        {echo $e -> getMessage();}
  }

 ?>
