
<?php

include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$categoria = $_POST['miCategoria'];
$alumno = $_POST['alumno'];
$categoria =trim($categoria);

$resp = insertaCategoriaPsico($categoria);
if($resp){
header('Location:../../vistas/psicopedagogico/psicoNuevoCaso.php?id='.$alumno);

$error=array("tipo"=>'success', "msg"=>'Nueva categoría guardada');
$_SESSION['msg']=$error;
}
else{

header('Location:../../vistas/psicopedagogico/psicoNuevoCaso.php?id='.$alumno);
$error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar el nueva categoría psicológica');
$_SESSION['msg']=$error;
}


?>