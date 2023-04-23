

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}



$idPrestamo =$_GET['id'];



$resp = eliminarPrestamo($idPrestamo) ;

if($resp){
   header('Location:../../vistas/biblioteca/bprincipal.php');

   $error=array("tipo"=>'success', "msg"=>'Préstamo eliminado correctamente');
   $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/biblioteca/bprincipal.php');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al eliminar el préstamo');
    $_SESSION['msg']=$error;
  
}
?>