

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$isbn = $_POST['isbn'];



$resp = agregarNuevoLibro($titulo, $autor, $editorial, $isbn);
if($resp){
   header('Location:../../vistas/biblioteca/nuevoLibro.php');
}else{
    exit("Hubo un error al crear nuevo Libro");
}
?>