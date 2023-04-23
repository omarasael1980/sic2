
<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
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
$folio =trim($folio);
$idal = trim($idal);
$medicacion = trim($medicacion);



$resp = actualizaExpedienteMedico($al, $enf, $medicacion, $folio);
if($resp){
    header('Location:../../vistas/alumnos/expedienteMedico.php?id='.$idal);
    $error=array("tipo"=>'success', "msg"=>'Expediente modificado');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/alumnos/expedienteMedico.php?id='.$idal);
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al modificar el expediente ');
    $_SESSION['msg']=$error;
}

?>

