
<?php
include '../../modelo/psicologia/psico.php';
$alumno = $_POST['alumno'];
$categoria = $_POST['miCategoria'];

$resp = guardaNuevoCategoriaCanalizaPsicologico($categoria);
if($resp){
header('Location:../../vistas/psicopedagogico/canalizarPsico.php?id='.$alumno);
}
else{
exit("Hubo un error al guardar la categoría de canalización de psicología");
}


?>