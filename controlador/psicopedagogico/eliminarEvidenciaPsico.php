<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$id = $_GET['id'];
$idal = $_GET['mi'];

$resp = borrarEvidenciaMedico($id);
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'success', "msg"=>'Evidencia eliminada');
$_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'error', "msg"=>'Evidencia no  eliminada');
$_SESSION['msg']=$error;
}

?>