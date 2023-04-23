
<?php
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];
$darSeguimiento = $_POST['darSeguimiento'];
$alumno = $_POST['alumno'];
include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$categoria = $_POST['categoria'];
$alumno = $_POST['alumno'];

$motivo =trim ($motivo);
$categoria =trim ($categoria);
$descripcion =trim ($descripcion);
$darSeguimiento =trim ($darSeguimiento);
$alumno = trim ($alumno);
$resp = insertanuevoPiscoAtencion ($fecha, $motivo, $categoria, $descripcion, $darSeguimiento, $alumno);



if($resp){

header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'success', "msg"=>'Atención psicológica registrada correctamente');
$_SESSION['msg']=$error;
}
else{
    header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar nuevo registro de atención psicológica');
$_SESSION['msg']=$error;
}





?>