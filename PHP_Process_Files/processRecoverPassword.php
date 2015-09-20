<?php
	 // Includes pdo file
    include_once('../pdo.inc');
    include("../mail/phpmailer/class.smtp.php");
	include("../mail/phpmailer/class.phpmailer.php");
	// Declare global variables
	$recoverPasswordInputs = $_POST;
	recoverPassword();

	// Function to search for a user with a given email and password
	function recoverPassword(){
		global $recoverPasswordInputs, $pdo;
		try{
			$recoverPassword = $pdo->prepare('SELECT hash FROM USER WHERE email = :email AND firstName = :firstName AND lastName = :lastName');
			$recoverPassword->bindValue(':email', $recoverPasswordInputs['email']);
			$recoverPassword->bindValue(':firstName', $recoverPasswordInputs['fname']);
			$recoverPassword->bindValue(':lastName', $recoverPasswordInputs['lname']);
			$recoverPassword->execute();
			$result = $recoverPassword -> fetch();

			if ($result != null) {
				sendEmail(updatePassword());
		    	header('Location: ../signin.php#recoverPassword=success');
			    exit();
			}else {
			    header('Location: ../recoverPassword.php#recoverPassword=warning');
			    exit();
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}

	//this function updates user's password on the database
	function updatePassword(){
		global $recoverPasswordInputs, $pdo;
		$newPass = createNewPassword();
		$updatePassword = $pdo->prepare('UPDATE `USER` SET `hash` = :newHash WHERE email = :email AND firstName = :firstName AND lastName = :lastName');
		$updatePassword->bindValue(':newHash', md5($newPass));
		$updatePassword->bindValue(':email', $recoverPasswordInputs['email']);
		$updatePassword->bindValue(':firstName', $recoverPasswordInputs['fname']);
		$updatePassword->bindValue(':lastName', $recoverPasswordInputs['lname']);
		$updatePassword->execute();
		return $newPass;
	}

	//this function generates a new password
	function createNewPassword() {
	    $genKey = "0123456789abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ!@#$%&*()_+";//set the random generator key from a-z and A-Z and 0-9
	    $pass = array(); //declare $pass as the variable to store array
	    $genKeyLength = strlen($genKey) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 10; $i++) {
	        $n = rand(0, $genKeyLength);//set $n to store the generated random key
	        $pass[] = $genKey[$n]; //set $pass to store the array of generated key
	    }
	    return implode($pass); // used implode turn the array into a string
	}

	//this function sends email with new generated password to the user's email
	function sendEmail($newPassword){
		global $recoverPasswordInputs;
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
	    $mail->Subject = "Recover Password - here2help";
	    $mail->Body = "Hi ". $recoverPasswordInputs['fname']." ". $recoverPasswordInputs['lname']."<br> This is your temporary password: <b>".$newPassword."</b> <br><br> To change your password, please access your manage account page.";
	    $mail->AddAddress( $recoverPasswordInputs['email']);
	    $mail->Send();
	}
?>
