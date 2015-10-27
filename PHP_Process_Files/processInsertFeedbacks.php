<?php
  include_once('../pdo.inc');

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    insertFeedbacks();
  }

  // Updates DB: assigns volunteer to help request.
  function insertFeedbacks(){
    global $pdo;
    try{
      $insertVolunteerFeedback = $pdo->prepare('INSERT INTO `VOLUNTEERFEEDBACK` (`requestID`, `volunteerID`, `rating`) VALUES (:requestID, :volunteerID, :rating)');
      $insertVolunteerFeedback -> bindValue(':requestID', $_POST['requestID']);
      $insertVolunteerFeedback -> bindValue(':volunteerID', $_POST['volunteerID']);
      $insertVolunteerFeedback -> bindValue(':rating', $_POST['volunteerFeedback']);

      echo $_POST['serviceProviderID']."\n";
      $insertServiceProviderFeedback = $pdo->prepare('INSERT INTO `SERVICEFEEDBACK` (`requestID`, `serviceProviderID`, `rating`) VALUES (:requestID, :serviceProviderID , :rating)');
      $insertServiceProviderFeedback -> bindValue(':requestID', $_POST['requestID']);
      $insertServiceProviderFeedback -> bindValue(':serviceProviderID', $_POST['serviceProviderID']);
      $insertServiceProviderFeedback -> bindValue(':rating', $_POST['serviceProviderFeedback']);
      

      $result = $insertVolunteerFeedback -> execute();
      $result2 = $insertServiceProviderFeedback ->execute();


      // Indicate start request succeeded/failed.
      if ($result && $result2) {
          header('Location: ../viewRequest.php?request='.$_POST['requestID'].'#feedback=success');
          exit();
      }else {
          header('Location: ../viewRequest.php#feedback=failure');
          exit();
      }
    } catch (PDOException $e){
      echo $e->getMessage();
    }
  }
?>
