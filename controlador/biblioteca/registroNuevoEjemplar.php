

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';

$idLibro = $_POST['idlibro'];
$ejemplar = $_POST['ejemplarNuevo'];
$falta = $_POST['f_alta'];
$procedencia = $_POST['procedencia'];
$custodiaNejemplar = $_POST['custodiaNejemplar'];



$resp = agregarEjemplar($idLibro, $ejemplar, $falta, $procedencia, $custodiaNejemplar);
if($resp){
   header('Location:../../vistas/biblioteca/nuevoLibro.php');
}else{
    exit("Hubo un error al crear nuevo ejemplar");
}
?>