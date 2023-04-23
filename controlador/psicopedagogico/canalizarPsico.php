
<?php
include '../../modelo/psicologia/psico.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$alumno = $_POST['alumno'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];
$especialista = $_POST['especialista'];
$categoria = $_POST['categoria'];
$folio = $_POST['folio'];

$alumno = trim($alumno);
$descripcion = trim($descripcion);
$especialista = trim($especialista);
$categoria = trim($categoria);

$resp = guardaNuevaCanalizacionPsico($fecha, $descripcion, $folio, $especialista, $categoria);
if($resp){
header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'success', "msg"=>'Categoría de canalización guardada correctamente');
$_SESSION['msg']=$error;
}
else{

header('Location:../../vistas/psicopedagogico/pprincipal.php');
$error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar la categoría de canalización de psicología');
$_SESSION['msg']=$error;

}


?>