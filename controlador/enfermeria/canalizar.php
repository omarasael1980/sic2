

<?php
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}
require '../../modelo/enfermeria/comunesEnfermeria.php';
$idalumno = $_POST['idalumno'];
$fechaCompleta =$_POST['fecha'];
$fecha = substr($fechaCompleta, 0,10);
$hora = substr($fechaCompleta, 11);
$date = $fecha." ".$hora.":00";
$motivo = $_POST['motivo'];
$especialista = $_POST['especialista'];
$descripcion = $_POST['desc'];
$idenfermeria = $_POST['idenfermeria'];
$idUsuario =$_SESSION['user']->idUsuario;

$descripcion =$motivo."-".$descripcion;


$resp = inserta_canalizacionMedica($date, $descripcion, $idenfermeria, $especialista);
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idalumno);
}else{exit("Hubo un error al guardar la canalización médica");}

?>