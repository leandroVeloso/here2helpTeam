<?php
  include_once('../pdo.inc');
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    startRequest();
  }

  // Updates DB: assigns volunteer to help request.
  function startRequest(){
    global $pdo;
    try{
      $updateRequest = $pdo->prepare('UPDATE REQUEST
                                        SET `statusID` = 2
                                        WHERE `requestID` = :requestID');
      $updateRequest -> bindValue(':requestID', $_GET['requestID']);
      $result = $updateRequest -> execute();

      // Indicate start request succeeded/failed.
      if ($result) {
          header('Location: ../currentVolunteerJobs.php#startRequest=success');
          exit();
      }else {
          header('Location: ../listUnassignedRequests.php#startRequest=failure');
          exit();
      }
    } catch (PDOException $e){
      echo $e->getMessage();
    }
  }
?>
