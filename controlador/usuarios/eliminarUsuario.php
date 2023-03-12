
<?php
require '../../modelo/config/pdo.php';
require '../../modelo/usuarios/usuarios.php';


$id = $_GET['id'];

$resp =borrarUsuario($id, $pdo);
if($resp){
    header('Location:../../vistas/usuarios/editaUsuarios.php');
}else{exit("Hubo un error al actualizar los datos del usuario");}
?>