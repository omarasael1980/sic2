
<?php
include '../../modelo/enfermeria/comunesEnfermeria.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) ){
    header("Location:../../");
}
$idalumno = $_POST['idalumno'];
$al ="";
$enf = "";
$medicacion = $_POST['medicacion'];
$idalumno =trim($idalumno);
$medicacion =trim($medicacion);
foreach ($_POST as $clave => $valor) {
    if (strpos($clave, 'enf') === 0) {
        // Si la clave comienza con "enf", agregar su valor a la variable $enf
        $enf .= $valor . " ";
      }
    if (strpos($clave, 'al') === 0) {
    // Si la clave comienza con "enf", agregar su valor a la variable $enf
    $al .= $valor . " ";
    }

}
if(isset($_POST['seguir'])){
    $seguimiento = 1;

}else{
    $seguimiento = 0;
}

$resp = crearExpedienteMedico($al, $enf, $medicacion,$seguimiento, $idalumno);
if($resp){
    header('Location:../../vistas/alumnos/ingresoAlumnos.php');
      $error=array("tipo"=>'success', "msg"=>'Expediente creado');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/alumnos/expedienteMedico.php?id='.$idal);
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al crear el expediente ');
    $_SESSION['msg']=$error;
}



?>
