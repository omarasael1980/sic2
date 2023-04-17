<pre>
    <?php
    print_r($_POST);?>
</pre>
<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';

$idEjemplar = $_POST['idEjemplar'];
$fecha_alta = $_POST['fecha_alta'];
$observaciones = $_POST['observaciones'];




$resp = update_actualizaEjemplar($idEjemplar, $fecha_alta, $observaciones);
if($resp){
   header('Location:../../vistas/biblioteca/editaEjemplar.php');
}else{
    exit("Hubo un error al editar el ejemplar");
}
?>