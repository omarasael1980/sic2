

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}

$idejemplar = $_POST['idEjemplar'];
$idUsuario = $_POST['idUsuario'];

$idejemplar =trim($idejemplar);
$idUsuario =trim($idUsuario);


$resp =actualizarCustodia($idejemplar, $idUsuario);
if($resp){
   header('Location:../../vistas/biblioteca/binventario.php');
   $error=array("tipo"=>'success', "msg"=>'Custoria Actualizada');
   $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/biblioteca/binventario.php');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al devolver el libro');
    $_SESSION['msg']=$error;
   

}
?>