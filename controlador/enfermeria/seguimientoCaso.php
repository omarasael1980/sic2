
<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}
$fechaCompleta = $_POST['fecha'];
$fecha = substr($fechaCompleta, 0,10);
$hora = substr($fechaCompleta, 11);
$date = $fecha." ".$hora.":00";
$motivo = $_POST['motivo'];
$descripcion = $_POST['desc'];
$id = $_POST['id'];
$idal=$_POST['al'];
$motivo =trim($motivo);
$descripcion =trim($descripcion);

$resp = insertaSeguimientoMedico($motivo, $descripcion, $date, $id  );
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'success', "msg"=>'Atención médica registrada');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar la atención médica');
    $_SESSION['msg']=$error;}


?>