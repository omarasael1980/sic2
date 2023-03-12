
<?php
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];
$darSeguimiento = $_POST['darSeguimiento'];
$alumno = $_POST['alumno'];
include '../../modelo/psicologia/psico.php';

$categoria = $_POST['categoria'];
$alumno = $_POST['alumno'];


$resp = insertanuevoPiscoAtencion ($fecha, $motivo, $categoria, $descripcion, $darSeguimiento, $alumno);



if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
}
else{
exit("Hubo un error al guardar nuevo registro de atención psicológica");
}





?>