
<?php
$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$fechaInicial = $_POST['fechaInicial'];
$fechaFinal = $_POST['fechaFinal'];
$descripcion = $_POST['descripcion'];
include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$folio = trim($folio);
$motivo = trim($motivo);
$descripcion = trim($descripcion);



$resp = insertaSuspension( $fecha, $fechaInicial, $fechaFinal, $descripcion, $motivo, $folio);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'success', "msg"=>'Suspensión registrada');
$_SESSION['msg']=$error;
}
else{
header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar la suspensión');
$_SESSION['msg']=$error;
}


?>