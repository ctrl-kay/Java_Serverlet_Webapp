<?php
session_start();

     if (!isset($_SESSION['count'])){
         $count = 1;
     }
     else {
         $count = $_SESSION['count'];
         $count++;
}
      $firstname=$_GET['first'];
      $lastname=$_GET['last'];
      $_SESSION['count'] = $count;
      
      echo "Hi, ".$firstname." ".$lastname.
           "!  Your current hit count:".$count;

?>

