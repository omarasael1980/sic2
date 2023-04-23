
<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
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
    $error=array("tipo"=>'success', "msg"=>'Cambios guardados');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
    $error=array("tipo"=>'error', "msg"=>'Hubo un error guardar cambios');
    $_SESSION['msg']=$error;
}

?>







