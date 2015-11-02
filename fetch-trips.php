<?php
	 session_start();
	  include("db-connection.php");

	try{
	$s_statement = $db -> prepare("SELECT * FROM trips ORDER BY created_date DESC");
	$s_statement -> execute();
	$result = $s_statement->fetchAll(PDO::FETCH_ASSOC);
	
	echo json_encode($result);
		

	}
		catch(PDOEXCEPTION $message){
			echo $message -> getMessage();
		}

?>