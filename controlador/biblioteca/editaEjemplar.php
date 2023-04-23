
<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}
$idEjemplar = $_POST['idEjemplar'];
$fecha_alta = $_POST['fecha_alta'];
$observaciones = $_POST['observaciones']; 
$idEjemplar =trim($idEjemplar);
$fecha_alta = trim($fecha_alta);
$observaciones = trim($observaciones);




$resp = update_actualizaEjemplar($idEjemplar, $fecha_alta, $observaciones);
if($resp){
   header('Location:../../vistas/biblioteca/editaEjemplar.php');

   $error=array("tipo"=>'success', "msg"=>'Ejemplar editado correctamente');
   $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/biblioteca/editaEjemplar.php');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al editar el ejemplar');
    $_SESSION['msg']=$error;
  
}
?>