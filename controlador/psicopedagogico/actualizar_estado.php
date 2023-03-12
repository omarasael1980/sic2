<?php

$folio = $_POST['folio']; 
$seguimiento = $_POST['seguimiento'];

if($seguimiento == true) {
    $nu=0;
} else if($seguimiento == false){
    $nu = 1;
}

require '../../modelo/config/pdo.php';

$sql = "UPDATE `sisantee_sics`.`atencion_psico` SET `darSeguimiento` = :estado WHERE (`idatencion_psico` = :id);";
$st = $pdo->prepare($sql);
$st->bindParam(':estado', $nu);  
$st->bindParam(':id', $folio);
$st->execute() or die (implode ('>>', $st->errorInfo()));

if($st->rowCount()>0){
    echo json_encode("correcto");
} else {
    echo json_encode("valio madres");
}

?>
