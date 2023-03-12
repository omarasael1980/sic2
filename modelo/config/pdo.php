<?php

$server='localhost';
$user='sisantee_hemo';
$pass="_pN@&O?xlp5Q";
$dataBase="sisantee_sics";
try{
$dsn="mysql:host=$server; dbname=$dataBase";
$pdo = new PDO($dsn, $user,$pass);


}catch(PDOException $e){
    exit($e->getMessage());
}
?>