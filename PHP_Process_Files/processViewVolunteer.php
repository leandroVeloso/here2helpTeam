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
      $volunteerDetails = $pdo -> prepare('SELECT U.userID, U.firstName, U.lastName, U.email, U.phoneNo, A.unitNumber, A.street, A.suburb, A.state, A.postcode, ROUND(AVG(F.rating),1) AS avgRating, U.lastModified, U.typeID
                                        FROM USER U
                                        INNER JOIN ADDRESS A
                                        ON U.addressID = A.addressID
                                        INNER JOIN VOLUNTEERFEEDBACK F
                                        ON F.volunteerID = U.userID
                                        WHERE U.userID = :volunteerID');
      $volunteerDetails -> bindValue(':volunteerID', $_GET['userID']);
      $volunteerDetails -> execute();
      $volunteer = $volunteerDetails -> fetch();

    }
    catch (PDOException $e)
      {echo $e -> getMessage();}
  }

 ?>
