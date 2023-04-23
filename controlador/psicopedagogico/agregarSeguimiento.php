
<?php

include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}

$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$descripcion = $_POST['descripcion'];

$motivo =trim($motivo);
$descripcion =trim($descripcion);


$resp = actualizaAsuntoPsico($fecha, $motivo, $descripcion, $folio);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'success', "msg"=>'Seguimiento guardado correctamente');
$_SESSION['msg']=$error;
}
else{
    header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar el seguimiento');
$_SESSION['msg']=$error;
}


?>