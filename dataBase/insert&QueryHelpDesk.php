// These are only snippets of code.

/*------------------------------------------------------------------------------
 Insert user details into database during signUp. This is implemented in processSignup.php
--------------------------------------------------------------------------------*/
$requestAddress = $pdo->prepare('INSERT INTO 'ADDRESS' ('unitNumber', 'street', 'suburb', 'state', 'postcode') VALUES (:unitNumber, :street, :suburb, :state, :postcode)');
$requestAddress->bindValue(':unitNumber', $_POST['unumber']);
$requestAddress->bindValue(':street', $_POST['street']);
$requestAddress->bindValue(':suburb', $_POST['suburb']);
$requestAddress->bindValue(':state', $_POST['state']);
$requestAddress->bindValue(':postcode', $_POST['postcode']);

$request = $pdo->prepare('INSERT INTO `USER` (`email`, `hash`, `firstName`, `lastName`, 'addressID', `phoneNo`, `typeID`) VALUES (:hash, :email, :firstName, :lastName, LAST_MODIFIED_ID, :phone, 1)');
$request->bindValue(':hash',md5($_POST['password']));
$request->bindValue(':email', $_POST['email']);
$request->bindValue(':firstName', $_POST['fname']);
$request->bindValue(':lastName', $_POST['lname']);
$request->bindValue(':phone', $_POST['pnumber']);

$resultAddress = $requestAddress->execute();
$result = $requestUser->execute();

/*------------------------------------------------------------------------------
Retrieve user details from database. This is implemented in processViewAccount.php
--------------------------------------------------------------------------------*/
$accountInfo = $pdo->prepare(
  'SELECT *
  FROM ADDRESS A
  INNER JOIN USER U
    ON U.addressID = A.addressID
  INNER JOIN USERTYPE T
    ON U.typeID = T.typeID
  WHERE U.userID = :userID');
$accountInfo->bindValue(':userID', $_SESSION['userID']);

$accountInfo->execute();
$result = $accountInfo->fetch();

/*------------------------------------------------------------------------------
 Insert help request details into database. This is implemented in processRequest.php.
--------------------------------------------------------------------------------*/

$request = $pdo->prepare('INSERT INTO `REQUEST` (`requestName`, `startDate`, `endDate`, `startTime`, 'endTime', `minPrice`, `maxPrice`, 'comment', 'priorityID', 'addressID')
VALUES (:requestName, :startDate, :endDate, :startTime, :endTime, :minPrice, :maxPrice, :comment, :priorityID, :addressID)');
$request->bindValue(':requestName', $_POST['requestName']);
$request->bindValue(':startDate', $_POST['startDate']);
$request->bindValue(':endDate', $_POST['endDate']);
$request->bindValue(':startTime', $_POST['startTime']);
$request->bindValue(':endTime', $_POST['endTime']);
$request->bindValue(':minPrice', $_POST['minPrice']);
$request->bindValue(':maxPrice', $_POST['maxPrice']);
$request->bindValue(':comment', $_POST['comment']);
$request->bindValue(':priorityID', $_POST['priorityID']);
$request->bindValue(':addressID', $_POST['addressID']);

$result = $request->execute();

/*------------------------------------------------------------------------------
 Retrieve customers help requests from database.
--------------------------------------------------------------------------------*/

$requests = $pdo->prepare(
  'SELECT requestName
  FROM REQUESTS R
  INNER JOIN USER U
    ON R.clientID = U.userID
  WHERE U.userID = :userID');
$requests->bindValue(':userID', $_SESSION['userID']);

$requests->execute();
$result = $requests->fetch();

/*------------------------------------------------------------------------------
 Retrieve customers help request details from database.
--------------------------------------------------------------------------------*/

$requests = $pdo->prepare(
  'SELECT *
  FROM REQUESTS R
  INNER JOIN USER U
    ON R.clientID = U.userID
  INNER JOIN PRIORITY P
    ON P.priorityID = R.priorityID
  INNER JOIN STATUS S
    ON S.statusID = R.statusID
  WHERE U.userID = :userID');
$requests->bindValue(':userID', $_SESSION['userID']);

$requests->execute();
$result = $requests->fetch();
