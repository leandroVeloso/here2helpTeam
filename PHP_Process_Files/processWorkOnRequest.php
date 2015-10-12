<?php
  include_once('../pdo.inc');
  include("../mail/phpmailer/class.smtp.php");
  include("../mail/phpmailer/class.phpmailer.php");

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['action']) && $_POST['action'] == "FinishBooking")
      finishBooking();
    else
      startRequest();
  }

  // Updates DB: assigns volunteer to help request.
  function startRequest(){
    global $pdo;
    try{
      $updateRequest = $pdo->prepare('UPDATE REQUEST
                                        SET `statusID` = 3
                                        WHERE `requestID` = :requestID');
      $updateRequest -> bindValue(':requestID', $_POST['requestID']);
      $result = $updateRequest -> execute();

      // Indicate start request succeeded/failed.
      if ($result) {
          sendEmailWaitingApproval();
          header('Location: ../workOnRequest.php?request='.$_POST['requestID'].'#approvalRequest=success');
          exit();
      }else {
          header('Location: ../workOnRequest.php?request='.$_POST['requestID'].'#approvalRequest=failure');
          exit();
      }
    } catch (PDOException $e){
      echo $e->getMessage();
    }
  }

  function sendEmailWaitingApproval(){
    global $pdo;
      $emailQuery = $pdo->prepare('SELECT *
                                        FROM REQUEST R INNER JOIN USER U
                                        ON R.clientID = U.userID
                                        WHERE R.requestID = :requestID');
      $emailQuery->bindValue(':requestID', $_POST['requestID']);
      $emailQuery->execute();
      $result = $emailQuery->fetch();
      $mail = new PHPMailer(); // create a new object
      $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = mess
      $mail->IsSMTP(); // enable SMTPages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; // or 587
      $mail->IsHTML(true);
      $mail->Username = "here2helpdesk@gmail.com";//set the gmail into the here2help gmail
      $mail->Password = "helpyhelp2";//set the password to make a direct sign in
      $mail->SetFrom("here2helpdesk@gmail.com");
      $mail->Subject = "Help Request ".$_POST['requestID']." - Status: Waiting Quote Approval";
      $mail->Body = "Dear user,<br> your Help Request  N ".$_POST['requestID']." - ".$result['requestName']." quotes were updated.<br>Please, access your account and approve one service quote.<br>Cheers, <br><br> The here2help team <br><br>website: here2help.com <br> email: here2helpdesk@gmail.com <br> phone: 3333 3333";
      $mail->AddAddress( $result['email']);
      $mail->Send();
  }

  function sendEmailFinishBooking(){
    global $pdo;
      $emailQuery = $pdo->prepare('SELECT *
                                        FROM REQUEST R INNER JOIN USER U
                                        ON R.clientID = U.userID
                                        WHERE R.requestID = :requestID');
      $emailQuery->bindValue(':requestID', $_POST['requestID']);
      $emailQuery->execute();
      $result = $emailQuery->fetch();
      $mail = new PHPMailer(); // create a new object
      $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = mess
      $mail->IsSMTP(); // enable SMTPages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; // or 587
      $mail->IsHTML(true);
      $mail->Username = "here2helpdesk@gmail.com";//set the gmail into the here2help gmail
      $mail->Password = "helpyhelp2";//set the password to make a direct sign in
      $mail->SetFrom("here2helpdesk@gmail.com");
      $mail->Subject = "Help Request ".$_POST['requestID']." - Status: Booking Finish (Request Closed)";
      $mail->Body = "Dear user,<br> your Help Request  N ".$_POST['requestID']." - ".$result['requestName']." was successfully booked.<br>Please, access your account to see more details.<br>Cheers, <br><br> The here2help team <br><br>website: here2help.com <br> email: here2helpdesk@gmail.com <br> phone: 3333 3333";
      $mail->AddAddress( $result['email']);
      $mail->Send();
  }

  function finishBooking(){
    global $pdo, $quoteInputs;
    try{
      $request = $pdo->prepare('UPDATE REQUEST
                                        SET `statusID` = 2
                                        WHERE `requestID` = :requestID');
      $request->bindValue(':requestID', $_POST['requestID']);

      $result = $request->execute();

      if ($result) {
        sendEmailFinishBooking();
          header('Location: ../workOnRequest.php?request='.$_POST['requestID'].'#bookingFinished=success');
          exit();
      } else {
          header('Location: ../workOnRequest.php?request='.$_POST['requestID'].'#bookingFinished=failed');
          exit();
      }

    }
    catch (PDOException $e)
      {echo $e->getMessage();}
  }
?>
