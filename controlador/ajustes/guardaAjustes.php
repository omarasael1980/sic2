
<?php
require '../../modelo/config/comunes.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}
$fechaInicioClases = $_POST['fechaInicioClases'];
$inicioHorario = $_POST['iniciHorario'];
$finHorario = $_POST['finHorario'];
$diasAntes = $_POST['diasAntes'];
$diasDespues=   $_POST['diasDespues'];

$fechaInicioClases =trim($fechaInicioClases);
$inicioHorario = trim($inicioHorario);
$finHorario = trim($finHorario);
$diasAntes =trim($diasAntes);
$diasDespues =trim($diasDespues);


$resp =actualizaSettings($fechaInicioClases, $inicioHorario, $finHorario, $diasAntes, $diasDespues);
if($resp){
    header('Location:../../vistas/usuarios/usuariosPrincipal.php');
   $error=array("tipo"=>'success', "msg"=>'Ajustes guardados');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/usuarios/usuariosPrincipal.php');
    $error=array("tipo"=>'error', "msg"=>'Error al guardar los ajustes');
    $_SESSION['msg']=$error;
}

?>
