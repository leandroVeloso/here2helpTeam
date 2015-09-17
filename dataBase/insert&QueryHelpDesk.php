/*------------------------------------------------------------------------------
 Insert user details into database during signUp. This is implemented in processSignup.php
--------------------------------------------------------------------------------*/
$signUpAddress = $pdo->prepare('INSERT INTO 'ADDRESS' ('unitNumber', 'street', 'suburb', 'state', 'postcode') VALUES (:unitNumber, :street, :suburb, :state, :postcode)');
$signUpAddress->bindValue(':unitNumber', $_POST['unumber']);
$signUpAddress->bindValue(':street', $_POST['street']);
$signUpAddress->bindValue(':suburb', $_POST['suburb']);
$signUpAddress->bindValue(':state', $_POST['state']);
$signUpAddress->bindValue(':postcode', $_POST['postcode']);

$signUp = $pdo->prepare('INSERT INTO `USER` (`email`, `hash`, `firstName`, `lastName`, 'addressID', `phoneNo`, `typeID`) VALUES (:hash, :email, :firstName, :lastName, LAST_MODIFIED_ID, :phone, 1)');
$signUp->bindValue(':hash',md5($_POST['password']));
$signUp->bindValue(':email', $_POST['email']);
$signUp->bindValue(':firstName', $_POST['fname']);
$signUp->bindValue(':lastName', $_POST['lname']);
$signUp->bindValue(':phone', $_POST['pnumber']);

$resultAddress = $signUpAddress->execute();
$result = $signUpUser->execute();

/*------------------------------------------------------------------------------
 Insert help request details into database. This is implemented in
--------------------------------------------------------------------------------*/
