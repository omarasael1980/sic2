<?php
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}
?>