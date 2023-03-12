

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';

$idprestamo = $_POST['idPrestamo'];
$ejemplar = $_POST['idEjemplar'];
$fregreso = $_POST['fregreso'];
$observaciones = $_POST['observaciones'];



$resp =devolverLibro($idprestamo, $ejemplar, $fregreso, $observaciones);
if($resp){
   header('Location:../../vistas/biblioteca/bprincipal.php');
}else{
    exit("Hubo un error al devolver el libro");
}
?>