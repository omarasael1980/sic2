<pre>
    <?php
    print_r($_POST);
    ?>
</pre>
<?php
include '../../modelo/psicologia/psico.php';
$alumno = $_POST['alumno'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];
$especialista = $_POST['especialista'];
$categoria = $_POST['categoria'];
$folio = $_POST['folio'];

$resp = guardaNuevaCanalizacionPsico($fecha, $descripcion, $folio, $especialista, $categoria);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
}
else{
exit("Hubo un error al guardar la categoría de canalización de psicología");
}


?>