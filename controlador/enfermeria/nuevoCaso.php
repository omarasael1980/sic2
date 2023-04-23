
<?php
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}
require '../../modelo/enfermeria/comunesEnfermeria.php';
$fechaCompleta = $_POST['fecha'];
$posicion =strpos($fechaCompleta,"T");
$fecha = substr($fechaCompleta, 0,$posicion);
$hora = substr($fechaCompleta, ($posicion+1));
$date = $fecha." ".$hora.":00";
$motivo = $_POST['motivo'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['desc'];
$id = $_POST['id'];
$idUsuario =$_SESSION['user']->idUsuario;


$posicion=trim($posicion);
$motivo = trim($motivo);
$categoria = trim($categoria);
$descripcion = trim($descripcion);





$resp = insertaAtencionMedica($motivo, $descripcion, $date, $id, $idUsuario, $categoria);
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$id);
    $error=array("tipo"=>'success', "msg"=>'Nuevo caso de atención médica');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$id);
    
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar la atención médica');
    $_SESSION['msg']=$error;
}

?>
