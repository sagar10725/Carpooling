<?php
	 session_start();
	  include("db-connection.php");

	try{
	$tripId = $_GET['tripId'];
	$s_statement = $db -> prepare("select c.comment_text, u.username 
									from comments c, trips t, users u 
 									where c.user_id = u.user_id 
									and t.trip_id = c.trip_id
									and t.trip_id = :tripId");
	$s_statement -> execute(array(':tripId' => $tripId));
	$result = $s_statement->fetchAll(PDO::FETCH_ASSOC);
	
	echo json_encode($result);
		

	}
		catch(PDOEXCEPTION $message){
			echo $message -> getMessage();
		}

?>