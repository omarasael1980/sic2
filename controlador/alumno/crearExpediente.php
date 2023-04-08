
<?php
include '../../modelo/enfermeria/comunesEnfermeria.php';
$idalumno = $_POST['idalumno'];
$al ="";
$enf = "";
$medicacion = $_POST['medicacion'];
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
}else{
    header('Location:../../vistas/alumnos/expedienteMedico.php?id='.$idal);
}



?>
