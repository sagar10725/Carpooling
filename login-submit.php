<?php
	 session_start();
	  include("db-connection.php");


    if($_POST){
    $user_name = $_POST['name'];
	$user_pass = $_POST['password'];
	
	try{
	$statement = $db -> prepare("SELECT username, password, user_id FROM users WHERE  username=:name");
	$statement -> execute(array(':name' => $user_name));
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	var_dump($result);
	
	if(password_verify($user_pass, $result['password'])){
		
	$_SESSION['username'] = $user_name;
	$_SESSION['userID'] = $result['user_id']; // for who commented to which post (used in dashboard.js)
		
	header("Location:dashboard.php");
	
	}
		else {
		$_SESSION['error'] = "Invalid Username or Password!";
		header("Location:login.php");
		}
	}
		catch(PDOEXCEPTION $message){
			echo $message -> getMessage();
		}
		
 }?>