
<?php
include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$alumno = $_POST['alumno'];
$motivo = $_POST['miMotivo'];
$alumno =trim($alumno);
$motivo = trim($motivo);

$resp = guardaNuevoMedio($motivo);
if($resp){
header('Location:../../vistas/psicopedagogico/notificacion.php?id='.$alumno);
$error=array("tipo"=>'success', "msg"=>'Nuevo medio de comunicación guardada');
$_SESSION['msg']=$error;
}
else{

header('Location:../../vistas/psicopedagogico/canalizarPsico.php?id='.$alumno);
$error=array("tipo"=>'success', "msg"=>'Error al guardar nuevo medio de comunicación');
$_SESSION['msg']=$error;
}


?>