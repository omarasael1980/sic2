
<?php
include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$alumno = $_POST['alumno'];
$categoria = $_POST['miCategoria'];

$alumno =trim($alumno);
$categoria =trim($categoria);

$resp = guardaNuevoCategoriaCanalizaPsicologico($categoria);
if($resp){
header('Location:../../vistas/psicopedagogico/canalizarPsico.php?id='.$alumno);
$error=array("tipo"=>'success', "msg"=>'Categoría de canalización guradada');
$_SESSION['msg']=$error;
}
else{
header('Location:../../vistas/psicopedagogico/canalizarPsico.php?id='.$alumno);
$error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar la categoría de canalización de psicología');
$_SESSION['msg']=$error;
}


?>