<?php
   include("../mail/phpmailer/class.phpmailer.php");
   include("../mail/phpmailer/class.smtp.php");
   // Check for empty fields
   if(empty($_POST['name'])  		||
      empty($_POST['email']) 		||
      empty($_POST['phone']) 		||
      empty($_POST['message'])	||
      !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
      {
   	echo "No arguments Provided!";
   	return false;
      }
   	
   $name = $_POST['name'];
   $email_address = $_POST['email'];
   $phone = $_POST['phone'];
   $message = $_POST['message'];

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
   $mail->Body = "From: ".$_POST['name']."<br> Phone: ".$_POST['phone']." <br>Email: ".$_POST['email']."<br> Message:". $_POST['message'];
   $mail->AddAddress("here2helpdesk@gmail.com");
    if(!$mail->Send())
      true;
   else
      false; 
?>