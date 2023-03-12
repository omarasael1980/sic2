

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';

$idalumno = $_POST['idalumno'];
$alumno = $_POST['alumno'];
$fecha = $_POST['fecha'];
$libros = $_POST['libros'];
$idlibro = $_POST['libro'];
$ejemplar = $_POST['ejemplar'];


$resp =insertaPrestamo($fecha, $idalumno, $ejemplar);
if($resp){
   header('Location:../../vistas/biblioteca/bprincipal.php');
}else{
    exit("Hubo un error al insertar el Préstamo de libro");
}
?>