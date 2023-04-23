<?php

$folio = $_POST['folio']; 
$seguimiento = $_POST['seguimiento'];

$folio =trim($folio);
$seguimiento =trim($seguimiento);

require '../../modelo/config/pdo.php';


$sql = "CALL update_actualizaEstadoAlertaEM(:estado, :folio)";
$st = $pdo->prepare($sql);
$st->bindParam(':estado', $seguimiento);  
$st->bindParam(':folio', $folio);
$st->execute() or die (implode ('>>', $st->errorInfo()));

if($st->rowCount()>0){
    echo json_encode("correcto");
} else {
    $mn = "error al cambiar estado".$seguimiento;
    echo json_encode($mn);
}

?>
