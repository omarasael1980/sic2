

<?php
require '../../modelo/config/comunes.php';
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}
$monto = $_POST['monto'];
$monto= str_replace(array("$", ","), "", $monto);



 $resp =actualizaMontoSeguroEscolar($monto);
 if($resp){
    header('Location:../../vistas/usuarios/usuariosPrincipal.php?id=3');
    $error=array("tipo"=>'success', "msg"=>'Monto actualizado');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/usuarios/usuariosPrincipal.php?error="NoInsertado"');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar el nuevo monto');
    $_SESSION['msg']=$error;
}

?>