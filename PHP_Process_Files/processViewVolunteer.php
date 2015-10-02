<?php
  viewVolunteerDetails();

  function viewVolunteerDetails(){
    global $pdo, $volunteer;

    try{
      $volunteerDetails = $pdo -> prepare('SELECT *
                                        FROM USER U INNER JOIN ADDRESS A
                                        ON U.addressID = A.addressID
                                        WHERE U.userID = :volunteerID');
      $volunteerDetails -> bindValue(':volunteerID', $_GET['userID']);
      $volunteerDetails -> execute();
      $volunteer = $volunteerDetails -> fetch();

    }
    catch (PDOException $e)
      {echo $e -> getMessage();}
  }

 ?>
