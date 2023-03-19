
<?php
$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$fechaInicial = $_POST['fechaInicial'];
$fechaFinal = $_POST['fechaFinal'];
$descripcion = $_POST['descripcion'];
include '../../modelo/psicologia/psico.php';


$resp = insertaSuspension( $fecha, $fechaInicial, $fechaFinal, $descripcion, $motivo, $folio);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
}
else{
exit("Hubo un error al guardar la suspensión.");
}


?>