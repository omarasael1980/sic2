
<?php
require '../../modelo/config/pdo.php';
require '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}

$id = $_GET['id'];

$resp =borrarUsuario($id, $pdo);
if($resp){
    header('Location:../../vistas/usuarios/editaUsuarios.php');
    $error=array("tipo"=>'success', "msg"=>'Usuario eliminado');
    $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/usuarios/editaUsuarios.php');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al eliminar al usuario');
    $_SESSION['msg']=$error;
}
?>