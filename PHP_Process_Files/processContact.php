<?php
	require_once "Mail.php";
	//define the receiver of the email
	
	$smtp=Mail::factory('smtp', array(

		'host'=>'ssl://smtp.gmail.com',
		'port'=> '465',
		'auth'=> true,
		'username'=>'here2helpdesk@gmail.com',
		'password'=>'helpyhelp2'
		));

	$to = 'here2helpdesk@gmail.com';
	$subject = 'contact'; 

	$message = $_POST['name']."\n".$_POST['phone']."\n".$_POST['message'];
	$headers = "From: here2helpdesk@gmail.com\r\nReply-To: here2helpdesk@gmail.com";

	$mail=$smtp->send($to, $headers, $message);
	//$mail_sent = @mail( $to, $subject, $message, $headers );



	//echo $mail_sent ? "Mail sent" : "Mail failed";
	echo $message;
?>