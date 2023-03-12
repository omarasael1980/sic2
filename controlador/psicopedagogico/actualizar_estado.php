<?php

$folio = $_POST['folio']; 
$seguimiento = $_POST['seguimiento'];


require '../../modelo/config/pdo.php';

$sql = "CALL update_cambiaSeguimiento(:estado, :folio)";
$st = $pdo->prepare($sql);
$st->bindParam(':estado', $seguimiento);  
$st->bindParam(':folio', $folio);
$st->execute() or die (implode ('>>', $st->errorInfo()));

if($st->rowCount()>0){
    echo json_encode("correcto");
} else {
    $mn = "valio madres".$seguimiento;
    echo json_encode($mn);
}

?>
