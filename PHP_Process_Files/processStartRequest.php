<?php
  include_once('../pdo.inc');
  include("../mail/phpmailer/class.smtp.php");
  include("../mail/phpmailer/class.phpmailer.php");

  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    startRequest();
  }

  // Updates DB: assigns volunteer to help request.
  function startRequest(){
    global $pdo;
    try{
      $updateRequest = $pdo->prepare('UPDATE REQUEST
                                        SET `volunteerID` = :volunteerID, `statusID` = 4
                                        WHERE `requestID` = :requestID');
      $updateRequest -> bindValue(':requestID', $_GET['requestID']);
      $updateRequest->bindValue(':volunteerID', $_SESSION['userID']);
      $result = $updateRequest -> execute();

      // Indicate start request succeeded/failed.
      if ($result) {
          sendEmail();
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

  function sendEmail(){
    global $pdo;
      $emailQuery = $pdo->prepare('SELECT *
                                        FROM REQUEST R INNER JOIN USER U
                                        ON R.clientID = U.userID
                                        WHERE R.requestID = :requestID');
      $emailQuery->bindValue(':requestID', $_GET['requestID']);
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
      $mail->Subject = "Help Request ".$_GET['requestID']." - Status: In Progress";
      $mail->Body = "Dear user,<br> your Help Request  N ".$_GET['requestID']." - ".$result['requestName'].", is currently under one of our volunteers care.<br> Shortly you'll be able to check quotes and approve the booking.<br>Please, access your account and view your request details for further information.<br>Cheers, <br><br> The here2help team <br><br>website: here2help.com <br> email: here2helpdesk@gmail.com <br> phone: 3333 3333";
      $mail->AddAddress( $result['email']);
      $mail->Send();
  }
?>
