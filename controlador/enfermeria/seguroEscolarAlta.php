
<?php

require '../../modelo/enfermeria/comunesEnfermeria.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
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

$descripcion =trim($descripcion);
$autoridad =trim($autoridad);
$queautoridad =trim($queautoridad);
$acta =trim($acta);
$causa = trim($causa);
$medidas = trim($medidas);
$terceros = trim($terceros);

$date = explode(" ",$fecha);
$dia = $date[0];
$mes = $date[3];
$anio = $date[2]; 
$fechab = $_POST['fechaActual'];
$id= insertaSeguroEscolar($fechab, $descripcion, $causa, $medidas, $monto, $terceros, $idEnfermeria, $idUsuario, $acta, $autoridad);

if($id){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idAlumno);
    $error=array("tipo"=>'success', "msg"=>'Seguro escolar guardado');
    $_SESSION['msg']=$error;
}else{
   
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idAlumno);
    $error=array("tipo"=>'error', "msg"=>'Error al guardar seguro Escolar');
    $_SESSION['msg']=$error;
}
?>



