
<?php
$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$descripcion = $_POST['descripcion'];
$motivo = trim($motivo);
$descripcion =trim($descripcion);
include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}

$resp = insertaNuevaNotificacion($fecha, $descripcion, $motivo, $folio);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'success', "msg"=>'Medio de comunicación guardado');
$_SESSION['msg']=$error;
}
else{
header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar el nuevo medio de comunicación');
$_SESSION['msg']=$error;
}
?>