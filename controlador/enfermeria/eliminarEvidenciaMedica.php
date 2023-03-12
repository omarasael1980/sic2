
<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
$id = $_GET['id'];
$idal = $_GET['mi'];

$resp = borrarEvidenciaMedico($id);
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
}else{exit("Hubo un error al eliminar la atención médica");}

?>