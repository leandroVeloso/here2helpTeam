<?php
include("phpmailer/class.smtp.php");
include("phpmailer/class.phpmailer.php");



   $mail = new PHPMailer(); // create a new object
   $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = mess
   $mail->IsSMTP(); // enable SMTPages only
   $mail->SMTPAuth = true; // authentication enabled
   $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
   $mail->Host = "smtp.gmail.com";
   $mail->Port = 465; // or 587
   $mail->IsHTML(true);
   $mail->Username = "here2helpdesk@gmail.com";
   $mail->Password = "helpyhelp2";
   $mail->SetFrom("here2helpdesk@gmail.com");
   $mail->Subject = "Contact Message";
   $mail->Body = "From: ".$_POST['name']."<br> Phone: ".$_POST['phone']." <br>Email: ".$_POST['email']."<br> Message:". $_POST['message'];
   $mail->AddAddress("here2helpdesk@gmail.com");
    if(!$mail->Send())
      true;
   else
      false;

 
?>
