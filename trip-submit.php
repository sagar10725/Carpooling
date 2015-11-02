<?php
	 session_start();
	  include("db-connection.php");


    if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_SESSION['username']; //from login-submit.php
	$tripText = $_POST['tripText'];
	try{
	     
	$s_statement = $db -> prepare("SELECT * FROM users WHERE  username=:name");
	$s_statement -> execute(array(':name' => $username));
	$result = $s_statement->fetch(PDO::FETCH_ASSOC);
	
		
	$i_statement = $db->prepare("INSERT INTO trips (trip_text, user_id, created_date) 
	                                         VALUES(:tripText, :userId, :time)");
		$i_statement->execute(array(
			               ':tripText' => $tripText,
						   ':userId' => $result['user_id'],
					       ':time' =>date("Y-m-d H:i:s")
						 	));
		
		//To Prepend information just saved (in db) in a new div.
		
		$s1_statement = $db -> prepare("select t.* from trips t left join users u on t.user_id = u.user_id where u.username =:username order by created_date desc limit 1");
		$s1_statement -> execute(array(':username' => $username));
	    $result1 = $s1_statement->fetch(PDO::FETCH_ASSOC);
		echo json_encode($result1);
		//echo json_encode();
	}
		catch(PDOEXCEPTION $message){
			echo $message -> getMessage();
		}
		
 }?>