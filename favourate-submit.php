<?php
  session_start();
  include('../db-connection.php');
  $user_Id = $_SESSION['user_Id'];

   if($_SERVER["REQUEST_METHOD"] == "POST"){
       if($_POST['do']==='add')
           try{
               $stmt = $db->prepare("INSERT into favorites VALUES(NULL, :userId, :trip_id)");
               $stmt->execute(array(
                   ':userId' => $user_Id,
                   ':trip_id'=> $_POST['tripID']
               ));
           }catch(PDOException $e){
               echo $e->getMessage();
           }
        if($_POST['do']==='remove')
           try{
               $stmt = $db->prepare("DELETE FROM favorites where user_id  = :userId and trip_id = :trip_id");
               $stmt->execute(array(
                   ':userId'=> $user_Id,
                   ':trip_id'=> $_POST['tripID']
               ));
           }catch(PDOException $e){
               echo $e->getMessage();
           }
   }else{
       echo 'cannot add to favorites';
   }
?>
