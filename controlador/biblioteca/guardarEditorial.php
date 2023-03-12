
<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';

$editorial = $_POST['editorial'];





$resp =guardarEditorial($editorial );
if($resp){
   header('Location:../../vistas/biblioteca/nuevoLibro.php?id=1');
}else{
    exit("Hubo un error al guardar nueva Editorial");
}
?>