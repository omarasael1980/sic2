

<?php
require '../../modelo/config/pdo.php';

require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}

$perfil = $_POST['perfil'];

if(isset($_POST['permisos'])){
    $permisos = $_POST['permisos'];
$res = ponerPermisos($perfil, $permisos, $pdo);
}
else{
  $res =  ponerPermisos($perfil, null, $pdo);
}

if($res){
    header("Location: ../../vistas/usuarios/permisosUsuario.php");
    $error=array("tipo"=>'success', "msg"=>'Cambios guardados');
    $_SESSION['msg']=$error;
}else{
    header("Location: ../../vistas/usuarios/permisosUsuario.php");
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar los cambios');
    $_SESSION['msg']=$error;
}


?>
