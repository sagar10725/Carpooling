<?php include("db-connection.php"); ?>
	<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){?>

		<!--display username-->
		<!-- please login -->

		<?php
   
	$username = $_POST["name"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	
	//$time = NOW();
 	//$time->format('Y-m-d H:i:s');   
 	//$now->getTimestamp();  
									   
	$pass_hash = password_hash($password, PASSWORD_DEFAULT);
	
	try{								   
    $query = $db->prepare("INSERT INTO users (username, password, email, created_date) 
	                                         VALUES(:name, :password, :email, :time)");

	$query->execute(array(':name' => $username,
						   ':password' => $pass_hash,
						   ':email' => $email,
					       ':time' =>date("Y-m-d H:i:s")
						 	));
		header("Location:landing.php");
	}
catch(PDOEXCEPTION $ex){
print $ex->getMessage();
}
									   
	//header("Location:signup-success.php?name=$username");		   
} ?>