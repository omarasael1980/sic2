
<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';
require_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}
$editorial = $_POST['editorial'];


$editorial =trim($editorial);


$resp =guardarEditorial($editorial );
if($resp){
   header('Location:../../vistas/biblioteca/nuevoLibro.php?id=1');
   $error=array("tipo"=>'success', "msg"=>'Editorial guardada');
   $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/biblioteca/nuevoLibro.php?id=1');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar nueva Editorial');
    $_SESSION['msg']=$error;
   
 
}
?>