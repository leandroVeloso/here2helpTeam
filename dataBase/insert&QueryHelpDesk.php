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

$request = $pdo->prepare('INSERT INTO 'USER' ('email', 'hash', 'firstName', 'lastName', 'addressID', 'phoneNo', 'typeID') VALUES (:hash, :email, :firstName, :lastName, LAST_MODIFIED_ID, :phone, 1)');
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
 Insert help request details into database. This is implemented in processCreateRequest.php.
--------------------------------------------------------------------------------*/

$request = $pdo->prepare(
'INSERT INTO 'REQUEST' ('clientID', 'requestName', 'startDate', 'endDate', 'startTime', 'endTime', 'minPrice', 'maxPrice', 'comment', 'priorityID', 'locationID', 'statusID', 'serviceID', 'creationDate', 'lastModified')
VALUES (:clientID, :requestName, :startDate, :endDate, :startTime, :endTime, :minPrice, :maxPrice, :comment, :priorityID, :locationID, 1, :serviceID, NULL, NULL)'); // Server uses previous version of MySQL hence creationDate and lastModified must be set to NULL
$request->bindValue(':clientID', $_SESSION['userAccountInfo']['userID']);
$request->bindValue(':requestName', $requestInputs['requestName']);
$request->bindValue(':startDate',date("Y-m-d", strtotime($requestInputs['startDate'])));
$request->bindValue(':endDate', date("Y-m-d", strtotime($requestInputs['endDate'])));
$request->bindValue(':startTime', $requestInputs['startTime']);
$request->bindValue(':endTime', $requestInputs['endTime']);
$request->bindValue(':minPrice', $requestInputs['minPrice']);
$request->bindValue(':maxPrice', $requestInputs['maxPrice']);
$request->bindValue(':comment', $requestInputs['requestDescription']);
$request->bindValue(':priorityID', $requestInputs['priorityID']);
$request->bindValue(':serviceID', $requestInputs['serviceID']);

$result = $request->execute();

/*------------------------------------------------------------------------------
 Retrieve all of customer's help requests from database. This is implemented in processSelectRequests.php
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

/*------------------------------------------------------------------------------
 Retrieve customer's help request details from database. This is implemented in processViewRequest.php
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
  INNER JOIN ADDRESS A
    ON A.addressID = R.locationID
  INNER JOIN SERVICE SE
    ON SE.serviceID = R.serviceID
  WHERE U.userID = :userID');
$requests->bindValue(':userID', $_SESSION['userID']);
$requests->bindValue(':requestID', $_SESSION['requestID']);

$requests->execute();
$result = $requests->fetch();

/*------------------------------------------------------------------------------
 Update customer's help request details in database. This is implemented in processEditRequest.php
--------------------------------------------------------------------------------*/
$request = $pdo->prepare(
  'UPDATE 'REQUEST'
   SET 'requestName' = :requestName,
      'startDate' = :startDate,
      'endTime' = :endDate,
      'startTime' = startTime,
      'endTime' = :endTime,
      'minPrice' = :minPrice,
      'maxPrice' = :maxPrice,
      'comment' = :comment,
      'priorityID' = :priorityID,
      'serviceID' = :serviceID
    WHERE requestID = :requestID');
$request->bindValue(':requestName', $requestInputs['requestName']);
$request->bindValue(':startDate',  date("Y-m-d", strtotime($requestInputs['startDate'])));
$request->bindValue(':endDate', date("Y-m-d", strtotime($requestInputs['endDate'])));
$request->bindValue(':startTime', $requestInputs['startTime']);
$request->bindValue(':endTime', $requestInputs['endTime']);
$request->bindValue(':minPrice', $requestInputs['minPrice']);
$request->bindValue(':maxPrice', $requestInputs['maxPrice']);
$request->bindValue(':comment', $requestInputs['requestDescription']);
$request->bindValue(':priorityID', $requestInputs['priorityID']);
$request->bindValue(':serviceID', $requestInputs['serviceID']);
$request->bindValue(':requestID', $requestInputs['editID']);

$requestAddress = $pdo->prepare(
  'UPDATE 'ADDRESS'
   SET 'unitNumber' = :unitNumber,
    'street' = :street,
    'suburb' = :suburb,
    'state' = :state,
    'postcode' = :postcode
  WHERE addressID = :adressID');
$requestAddress->bindValue(':unitNumber', $requestInputs['unumber']);
$requestAddress->bindValue(':street', $requestInputs['street']);
$requestAddress->bindValue(':suburb', $requestInputs['suburb']);
$requestAddress->bindValue(':state', $requestInputs['state']);
$requestAddress->bindValue(':postcode', $requestInputs['postcode']);
$requestAddress->bindValue(':adressID', $resultAdress['addressID']);
