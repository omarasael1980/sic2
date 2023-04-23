
<?php
require '../../modelo/config/pdo.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}

$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];

$pass = $_POST['password'];
$idrol = $_POST['roles'];
$iduser = $_POST['id'];
$dom = $_POST['domicilio'];
$tel = $_POST['tel'];
$cell = $_POST['cell'];

$nombre =trim($nombre);
$apaterno =trim($apaterno);
$amaterno =trim($amaterno);
$pass =trim($pass);
$dom =trim($dom);


$resp =editaUsuarios2($nombre, $apaterno, $amaterno, $pass, $idrol ,$dom,$tel,$cell, $iduser, $pdo);
if($resp){
   header('Location:../../vistas/usuarios/usuariosPrincipal.php');
   $error=array("tipo"=>'success', "msg"=>'Datos de usuario actualizado');
$_SESSION['msg']=$error;
}else{
   header('Location:../../vistas/usuarios/usuariosPrincipal.php');
   $error=array("tipo"=>'error', "msg"=>'Hubo un error al actualizar los datos del usuario');
   $_SESSION['msg']=$error;
}
?>