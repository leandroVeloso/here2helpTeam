<?php
  $volunteer;
  if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['userID'])){
    viewVolunteerDetails();
  }else{
    header('Location: ../index.php');
    exit();
  }

  // Gets volunteers details from DB.
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
