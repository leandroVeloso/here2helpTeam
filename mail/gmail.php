<?php
/*End Config*/
include("phpmailer/class.smtp.php");
include("phpmailer/class.phpmailer.php");



   $mail = new PHPMailer(); // create a new object
   $mail->IsSMTP(); // enable SMTP
   $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
   $mail->SMTPAuth = true; // authentication enabled
   $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
   $mail->Host = "smtp.gmail.com";
   $mail->Port = 465; // or 587
   $mail->IsHTML(true);
   $mail->Username = "here2helpdesk@gmail.com";
   $mail->Password = "helpyhelp2";
   $mail->SetFrom("here2helpdesk@gmail.com");
   $mail->Subject = "Contact Message";
   $mail->Body = "oi";
   $mail->AddAddress("here2helpdesk@gmail.com");
    if(!$mail->Send())
      true;
   else
      false; 
