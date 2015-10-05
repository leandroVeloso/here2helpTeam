<?php
  $volunteer;
  //if($_SERVER['REQUEST_METHOD'] == 'POST' ){
//if (isset($_POST['approveBtn'])) {
      approveVolunteer();
  //  }
//}

// Approve Volunteer account: Set user to volunteer (typeID = 2)
  function approveVolunteer(){
    global $pdo, $volunteer;

      try{
        $volunteerDetails = $pdo -> prepare('UPDATE USER
                                          SET typeID = 2
                                          WHERE userID = :userID');
        $volunteerDetails -> bindValue(':userID', $volunteer['userID']);
        $result = $volunteerDetails -> execute();

        if ($result) {
  			    //header('Location: ../viewVolunteer.php#approve=success');
  			    exit();
  			}else {
  			    //header('Location: ../viewVolunteer.php#approve=failed');
  			    exit();
  			}
      }
      catch (PDOException $e)
        {echo $e -> getMessage();}
}
 ?>
