<?php
try{
$conn = new PDO('mysql:host=us-cdbr-east-05.cleardb.net; dbname=heroku_773c0186875e0b3', 'b080efe90b1bbb', '66b8be8b');
} catch(PDOException $e){
   echo "Error: ". $e->getMessage();
   die();
}
?>
