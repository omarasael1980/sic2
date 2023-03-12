
<?php
include '../../modelo/psicologia/psico.php';
$alumno = $_POST['alumno'];
$especialista = $_POST['miEspecialista'];

$resp = guardaNuevoEspecialistaPsicologico($especialista);
if($resp){
header('Location:../../vistas/psicopedagogico/canalizarPsico.php?id='.$alumno);
}
else{
exit("Hubo un error al guardar el especialista de psicología");
}


?>