<?php
// Includes pdo file
  include_once('../pdo.inc');
$requestInputs = array();
$requestInputs = $_POST;
if($_SERVER['REQUEST_METHOD'] == 'POST' )
  newRequest();

  function newRequest(){
    global $pdo, $requestInputs;
    try{
            // Insert location of request into DB
		        $requestLocation = $pdo->prepare('INSERT INTO `ADDRESS` (`unitNumber`, `street`, `suburb`, `state`, `postcode`) VALUES (:unitNumber, :street, :suburb, :state, :postcode)');
		        $requestLocation->bindValue(':unitNumber', $_POST['unumber']);
		        $requestLocation->bindValue(':street', $_POST['street']);
		        $requestLocation->bindValue(':suburb', $_POST['suburb']);
		        $requestLocation->bindValue(':state', $_POST['state']);
		        $requestLocation->bindValue(':postcode', $_POST['postcode']);
		        $resultAddress = $requestLocation->execute();
		        $addressID = $pdo->lastInsertId();

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
            $resultLocation = $requestLocation->execute();

				if ($result && $resultLocation ) {
				    header('Location: ../createRequest.php#createRequest=success');
				    exit();
				}else{
				    header('Location: ../createRequest.php#createRequest=failed');
				    exit();
				}
			}
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
        }



?>
