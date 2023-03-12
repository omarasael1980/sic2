
<?php
include '../../modelo/psicologia/psico.php';
$alumno = $_POST['alumno'];
$motivo = $_POST['miMotivo'];

$resp = guardaNuevoMedio($motivo);
if($resp){
header('Location:../../vistas/psicopedagogico/notificacion.php?id='.$alumno);
}
else{
exit("Hubo un error al guardar el nuevo medio de comunicación");
}


?>