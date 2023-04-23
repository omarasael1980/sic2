
<?php

require '../../modelo/usuarios/usuarios.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}

$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$username = $_POST['usuario'];
$password = $_POST['password'];
$rol = $_POST['rol'];
$dom =$_POST['domicilio'];
$tel = $_POST['tel'];
$cell=$_POST['cell'];

$nombre = trim($nombre);
$apaterno = trim($apaterno);
$amaterno = trim($amaterno);
$username = trim($username);
$password = trim ($password);
$dom = trim($dom);

$resp =insertarUsuario($nombre, $apaterno, $amaterno, $username, $password, $rol, $dom, $tel,$cell);
if($resp=="listo"){
   header('Location:../../vistas/usuarios/usuariosPrincipal.php');
   $error=array("tipo"=>'success', "msg"=>'Usuario nuevo guardado');
   $_SESSION['msg']=$error;
}else{
   header('Location:../../vistas/usuarios/usuariosPrincipal.php');
   $error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar el usuario nuevo');
   $_SESSION['msg']=$error;

}
?>

