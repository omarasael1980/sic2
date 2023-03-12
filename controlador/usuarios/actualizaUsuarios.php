
<?php
require '../../modelo/config/pdo.php';
require '../../modelo/usuarios/usuarios.php';

$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];

$pass = $_POST['password'];
$idrol = $_POST['roles'];
$iduser = $_POST['id'];
$dom = $_POST['domicilio'];
$tel = $_POST['tel'];
$cell = $_POST['cell'];

$resp =editaUsuarios2($nombre, $apaterno, $amaterno, $pass, $idrol ,$dom,$tel,$cell, $iduser, $pdo);
if($resp){
   header('Location:../../vistas/usuarios/usuariosPrincipal.php');
}else{exit("Hubo un error al actualizar los datos del usuario");
}
?>