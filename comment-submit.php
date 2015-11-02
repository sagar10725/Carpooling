<?php 
session_start();

/*echo 'Comment ' . $_POST['commentText'];
echo 'Trip ID' . $_POST['tripID'];
echo 'User ID' . $_SESSION['userID'];*/

include("db-connection.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
	try{
	     
		
	$i_statement = $db->prepare("INSERT INTO comments (comment_text, user_id, trip_id, created_date) 
	                                         VALUES(:commentText, :userId, :tripID, :time)");
		$i_statement->execute(array(
			               ':commentText' => $_POST['commentText'],
						   ':userId' => $_SESSION['userID'],
						   ':tripID' => $_POST['tripID'],
					       ':time' => date("Y-m-d H:i:s")
						 	));
		echo 'Saved Successfully';
	}
		catch(PDOEXCEPTION $message){
			echo $message -> getMessage();
		}
		
 }



?>