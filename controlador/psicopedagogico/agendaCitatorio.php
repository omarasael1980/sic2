
<?php
$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$fechaCitatorio = $_POST['fechaCitatorio'];
$viaComunicacion = $_POST['motivo'];
$descripcion = $_POST['descripcion'];
$fechax = substr($fechaCitatorio, 0,10);
$hora = substr($fechaCitatorio, 11);
$date = $fechax." ".$hora;
include '../../modelo/psicologia/psico.php';
print_r($date);

$resp = insertaCitatorioPsico($descripcion, $fecha,  $date,  $viaComunicacion, $folio);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
}
else{
exit("Hubo un error al guardar el citatorio.");
}
?>