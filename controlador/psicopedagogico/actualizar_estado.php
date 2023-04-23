<?php

$folio = $_POST['folio']; 
$seguimiento = $_POST['seguimiento'];

require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
require '../../modelo/config/pdo.php';

$sql = "CALL update_cambiaSeguimiento(:estado, :folio)";
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
