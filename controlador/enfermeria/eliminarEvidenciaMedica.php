
<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
$id = $_GET['id'];
$idal = $_GET['mi'];
$id=trim($id);
$idal=trim($idal);


$resp = borrarEvidenciaMedico($id);
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'success', "msg"=>'Evidencia médica eliminada');
    $_SESSION['msg']=$error;
}else{
    
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al eliminar la atención médica');
    $_SESSION['msg']=$error;
}

?>