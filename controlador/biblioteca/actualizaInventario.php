

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';

$idejemplar = $_POST['idEjemplar'];
$idUsuario = $_POST['idUsuario'];




$resp =actualizarCustodia($idejemplar, $idUsuario);
if($resp){
   header('Location:../../vistas/biblioteca/binventario.php');
}else{
    exit("Hubo un error al devolver el libro");
}
?>