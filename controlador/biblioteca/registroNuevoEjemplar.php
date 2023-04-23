

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}

$idLibro = $_POST['idlibro'];
$ejemplar = $_POST['ejemplarNuevo'];
$falta = $_POST['f_alta'];
$procedencia = $_POST['procedencia'];
$custodiaNejemplar = $_POST['custodiaNejemplar'];

$idLibro = trim($idLibro);
$ejemplar = trim($ejemplar);
$falta = trim($falta);
$procedencia = trim($procedencia);
$custodiaNejemplar = trim($custodiaNejemplar);

$resp = agregarEjemplar($idLibro, $ejemplar, $falta, $procedencia, $custodiaNejemplar);
if($resp){
   header('Location:../../vistas/biblioteca/nuevoLibro.php');
   $error=array("tipo"=>'success', "msg"=>'Custoria Actualizada');
   $_SESSION['msg']=$error;
}else{
   
    header('Location:../../vistas/biblioteca/nuevoLibro.php');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al crear nuevo ejemplar');
    $_SESSION['msg']=$error;
}
?>