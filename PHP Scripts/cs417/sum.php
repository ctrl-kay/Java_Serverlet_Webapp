<?php
session_start();

     if (!isset($_POST['num'])){
         $sum = 0;
         $_SESSION['sum'] = 0;
     }
     else {
         if (!isset($_SESSION['sum'])){
             $sum = $_POST['num'];
         }
         else {
            $sum= $_SESSION['sum'];
            $sum= $sum + $_POST['num'];
         }
     }
        
      $_SESSION['sum'] = $sum;
      echo "sum:".$sum;

?>
