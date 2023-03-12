<?php
require '../../modelo/usuarios/usuarios.php';
abreSesion();

unset($_SESSION['user']);
session_destroy();
header("location: ../../");
?>