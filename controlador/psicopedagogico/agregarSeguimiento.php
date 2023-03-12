
<?php

include '../../modelo/psicologia/psico.php';
$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$descripcion = $_POST['descripcion'];



$resp = actualizaAsuntoPsico($fecha, $motivo, $descripcion, $folio);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
}
else{
exit("Hubo un error al guardar el seguimiento del folio:$folio");
}


?>