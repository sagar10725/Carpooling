<?php
   session_start();
   $userId = $_SESSION['user_Id'];
   include('../db-connection.php');
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      $trip_id = $_POST['trip_id'];    
    try{
        if(checkTrip($db, $userId, $trip_id) -> fetch() != null){
        $stmt = $db->prepare("DELETE t.* , c.* from trips t INNER JOIN comments c on t.trip_id = c.trip_id and t.trip_id = :trip_id");
        $stmt -> execute(array(
           ':trip_id' => $trip_id
        ));
            echo "trip_deleted";
        }else{
            echo "cannot_deleted";
        }
    }catch(PDOException $e){
        echo $e -> getMessage();
    }
      
  }

function checkTrip($db, $userId, $trip_id){
    $stmt = $db->prepare("SELECT * FROM trips WHERE user_id=:user_id AND trip_id=:trip_id");
	$stmt->execute(array(":user_id"=>$userId, ':trip_id'=>$trip_id));
	return $stmt;
}
?>
