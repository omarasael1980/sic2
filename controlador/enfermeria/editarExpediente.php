
<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
$folio = $_POST['folio'];
$idal = $_POST['idalumno'];
$enf = ""; // Variable para almacenar los valores de las claves que comiencen con "enf"
$al="";
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


$resp = actualizaExpedienteMedico($al, $enf, $medicacion, $folio);
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
}else{
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
}

?>







