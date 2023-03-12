

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/usuarios/usuarios.php';
$perfil = $_POST['perfil'];

if(isset($_POST['permisos'])){
    $permisos = $_POST['permisos'];
ponerPermisos($perfil, $permisos, $pdo);
}
else{
    ponerPermisos($perfil, null, $pdo);
}

header("Location: ../../vistas/usuarios/permisosUsuario.php");
?>
