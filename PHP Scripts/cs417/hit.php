<?php
session_start();

     if (!isset($_SESSION['count'])){
         $count = 1;
     }
     else {
         $count = $_SESSION['count'];
         $count++;
}
        
      $_SESSION['count'] = $count;
      echo "hits:".$count;
?>

