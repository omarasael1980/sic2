
<?php

include '../../modelo/psicologia/psico.php';

$categoria = $_POST['miCategoria'];
$alumno = $_POST['alumno'];


$resp = insertaCategoriaPsico($categoria);
if($resp){
header('Location:../../vistas/psicopedagogico/psicoNuevoCaso.php?id='.$alumno);
}
else{
exit("Hubo un error al guardar el nuevo motivo de atención psicológica");
}


?>