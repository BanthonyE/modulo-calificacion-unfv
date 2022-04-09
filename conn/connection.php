<?php
try{
$conn = new PDO('mysql:host=localhost; dbname=bdcalificaciones', 'root', '');
} catch(PDOException $e){
   echo "Error: ". $e->getMessage();
   die();
}
?>