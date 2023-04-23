
<?php
$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$fechaCitatorio = $_POST['fechaCitatorio'];
$viaComunicacion = $_POST['motivo'];
$descripcion = $_POST['descripcion'];
$fechax = substr($fechaCitatorio, 0,10);
$hora = substr($fechaCitatorio, 11);
$date = $fechax." ".$hora;
$viaComunicacion =trim($viaComunicacion);
$descripcion =trim($descripcion);

include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}


$resp = insertaCitatorioPsico($descripcion, $fecha,  $date,  $viaComunicacion, $folio);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'success', "msg"=>'Citatorio guardado');
$_SESSION['msg']=$error;
}
else{

$error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar el citatorio');
$_SESSION['msg']=$error;
}
?>