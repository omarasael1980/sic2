<pre>
    <?php
    print_r($_POST);
    ?>
</pre>
<?php
$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$descripcion = $_POST['descripcion'];

include '../../modelo/psicologia/psico.php';


$resp = insertaNuevaNotificacion($fecha, $descripcion, $motivo, $folio);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
}
else{
exit("Hubo un error al guardar el nuevo medio de comunicación");
}
?>