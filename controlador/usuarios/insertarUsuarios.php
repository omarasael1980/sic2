
<?php

require '../../modelo/usuarios/usuarios.php';

$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$username = $_POST['usuario'];
$password = $_POST['password'];
$rol = $_POST['rol'];
$dom =$_POST['domicilio'];
$tel = $_POST['tel'];
$cell=$_POST['cell'];

$resp =insertarUsuario($nombre, $apaterno, $amaterno, $username, $password, $rol, $dom, $tel,$cell);
if($resp=="listo"){
   header('Location:../../vistas/usuarios/usuariosPrincipal.php');
}
?>

