<?php
  include_once('../pdo.inc');

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    waitBooking();
  }

  // Updates DB: assigns volunteer to help request.
  function waitBooking(){
    global $pdo;
    try{
      $updateRequest = $pdo->prepare('UPDATE REQUEST
                                        SET `statusID` = 6
                                        WHERE `requestID` = :requestID');
      $updateRequest -> bindValue(':requestID', $_POST['requestID']);
      $result = $updateRequest -> execute();

      $updateQuote = $pdo->prepare('UPDATE QUOTE
                                        SET `approved` = 1, `volunteerComment` = :comment
                                        WHERE `quoteID` = :quoteID');
      $updateQuote -> bindValue(':quoteID', $_POST['approvedQuote']);
      $updateQuote -> bindValue(':comment', $_POST['comment']);
      $resul2 =  $updateQuote -> execute();


      // Indicate start request succeeded/failed.
      if ($result && $resul2) {
          header('Location: ../viewRequest.php?request='.$_POST['requestID'].'#waitBook=success');
          exit();
      }else {
          header('Location: ../viewRequest.php#waitBook=failure');
          exit();
      }
    } catch (PDOException $e){
      echo $e->getMessage();
    }
  }
?>
