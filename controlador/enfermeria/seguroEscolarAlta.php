
<?php

require '../../modelo/enfermeria/comunesEnfermeria.php';
$idAlumno = $_POST['alumno'];
$idEnfermeria =$_POST['idenfermeria'];
$fecha = $_POST['fecha'];
$idUsuario =$_POST['usuario'];
$descripcion =$_POST['descripcion'];
$autoridad =$_POST['autoridad'];
$queautoridad =$_POST['queautoridad'];
$acta =$_POST['acta'];
$causa =$_POST['causa'];
$medidas = $_POST['medidas'];
$monto =$_POST['monto'];
$terceros =$_POST['terceros'];

$date = explode(" ",$fecha);
$dia = $date[0];
$mes = $date[3];
$anio = $date[2];
$fechab = $anio."-".$mes."-".$dia." 12:00:00";


$id= insertaSeguroEscolar($fechab, $descripcion, $causa, $medidas, $monto, $terceros, $idEnfermeria, $idUsuario, $acta, $autoridad);

if($id){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idAlumno);
}else{exit("Hubo un error guardar seguro Escolar");}
?>
