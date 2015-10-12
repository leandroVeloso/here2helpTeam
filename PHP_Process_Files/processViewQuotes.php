<?php
 	// Includes pdo file
    include_once('pdo.inc');

	if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['request'])){
		$quotes;
		retrieveQuotes();
	}
	
	function retrieveQuotes(){
		
		global $quotes, $pdo;
		try{
			$quotesSelect = $pdo->prepare('SELECT * FROM `QUOTE` WHERE `requestID`= :requestID');
			$quotesSelect->bindValue(':requestID', $_GET['request']);
			$quotesSelect->execute();
			$result = $quotesSelect->fetchAll();
			$quotes = $result;
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}

?>
