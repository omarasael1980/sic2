<?php
print_r($_POST);
$nombrecompleto = $_POST["alumno"];

include "../../modelo/config/pdo.php";
include "../../modelo/alumnos/getAlumnos.php";


?>