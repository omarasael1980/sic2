
<?php
include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$alumno = $_POST['alumno'];
$especialista = $_POST['miEspecialista'];
$alumno =trim($alumno);
$especialista =trim($especialista);

$resp = guardaNuevoEspecialistaPsicologico($especialista);
if($resp){
header('Location:../../vistas/psicopedagogico/canalizarPsico.php?id='.$alumno);
$error=array("tipo"=>'success', "msg"=>'Especialista de psicología guardada');
$_SESSION['msg']=$error;
}
else{

header('Location:../../vistas/psicopedagogico/canalizarPsico.php?id='.$alumno);
$error=array("tipo"=>'success', "msg"=>'Hubo un error al guardar el especialista de psicología');
$_SESSION['msg']=$error;
}


?>