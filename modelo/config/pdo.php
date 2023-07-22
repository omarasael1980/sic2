<?php

$server='localhost';
$user='si';
$pass="";
$dataBase="sis";
try{
$dsn="mysql:host=$server; dbname=$dataBase";
$pdo = new PDO($dsn, $user,$pass);


}catch(PDOException $e){
    exit($e->getMessage());
}
?>
