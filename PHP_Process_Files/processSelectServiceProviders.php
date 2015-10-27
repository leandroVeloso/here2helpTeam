<?php
	$serviceProviders;
	selectServiceProviders();

	function selectServiceProviders(){
		global $serviceProviders, $pdo;
		try{
			$serviceProviderSelect = $pdo->prepare('SELECT *  FROM SERVICEPROVIDER');
			$serviceProviderSelect->execute();
			$serviceProviders = $serviceProviderSelect->fetchAll();
		}
		catch (PDOException $e)
			{echo $e->getMessage();}
	}
?>
