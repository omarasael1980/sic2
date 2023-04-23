

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}


$idprestamo = $_POST['idPrestamo'];
$ejemplar = $_POST['idEjemplar'];
$fregreso = $_POST['fregreso'];
$observaciones = $_POST['observaciones'];
 
//limpiar las variables
$idprestamo =trim($idprestamo);
$ejemplar = trim($ejemplar);
$fregreso = trim($fregreso);
$observaciones = trim($observaciones);


$resp =devolverLibro($idprestamo, $ejemplar, $fregreso, $observaciones);
if($resp){
   header('Location:../../vistas/biblioteca/bprincipal.php');
   $error=array("tipo"=>'success', "msg"=>'Libro devuelto');
   $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/biblioteca/bprincipal.php');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al devolver el libro');
    $_SESSION['msg']=$error;
    
}
?>