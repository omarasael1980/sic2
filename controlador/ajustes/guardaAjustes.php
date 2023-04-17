
<?php
require '../../modelo/config/comunes.php';
$fechaInicioClases = $_POST['fechaInicioClases'];
$inicioHorario = $_POST['iniciHorario'];
$finHorario = $_POST['finHorario'];
$diasAntes = $_POST['diasAntes'];
$diasDespues=   $_POST['diasDespues'];


$resp =actualizaSettings($fechaInicioClases, $inicioHorario, $finHorario, $diasAntes, $diasDespues);
if($resp){
    header('Location:../../vistas/usuarios/usuariosPrincipal.php');
}else{
    header('Location:../../vistas/usuarios/usuariosPrincipal.php?error="NoInsertado"');
}

?>
