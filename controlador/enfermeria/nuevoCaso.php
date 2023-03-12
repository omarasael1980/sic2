
<?php
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}
require '../../modelo/enfermeria/comunesEnfermeria.php';
$fechaCompleta = $_POST['fecha'];
$fecha = substr($fechaCompleta, 0,10);
$hora = substr($fechaCompleta, 11);
$date = $fecha." ".$hora.":00";
$motivo = $_POST['motivo'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['desc'];
$id = $_POST['id'];
$idUsuario =$_SESSION['user']->idUsuario;



$resp = insertaAtencionMedica($motivo, $descripcion, $date, $id, $idUsuario, $categoria);
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$id);
}else{exit("Hubo un error al guardar la atención médica");}

?>
