
<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}
$id = $_GET['id'];
$idal = $_GET['c'];
$id = trim($id);
$idal = trim($idal);

$resp = borrarCasoMedico($id);
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'success', "msg"=>'Caso eliminado correctamente');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al eliminar la atención médica');
    $_SESSION['msg']=$error;
}

?>