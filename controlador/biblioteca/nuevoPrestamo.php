

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';
require_once '../../modelo/usuarios/usuarios.php';
require '../../modelo/config/comunes.php';

abreSesion();
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}
$idalumno = $_POST['idalumno'];
$alumno = $_POST['alumno'];
$fecha = $_POST['fecha'];
$libros = $_POST['libros'];
$idlibro = $_POST['libro'];
$ejemplar = $_POST['ejemplar'];

$idalumno = trim($idalumno);
$alumno = trim($alumno);
$fecha = trim($fecha);
$libros = trim($libros);
$idlibro =trim($idlibro);
$ejemplar =trim($ejemplar);
//$ajustes = buscaSettings();


$resp =insertaPrestamo($fecha, $idalumno, $ejemplar);
if($resp){
   header('Location:../../vistas/biblioteca/bprincipal.php');
   $error=array("tipo"=>'success', "msg"=>'Préstamo registrado');
   $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/biblioteca/bprincipal.php');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al insertar el Préstamo de libro');
    $_SESSION['msg']=$error;
   
}
?>