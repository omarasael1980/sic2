

<?php
require '../../modelo/config/pdo.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$isbn = $_POST['isbn'];

$titulo =trim($titulo);
$autor=trim($autor);
$editorial = trim($editorial);
$isbn = trim($isbn);


$resp = agregarNuevoLibro($titulo, $autor, $editorial, $isbn);
if($resp){
   header('Location:../../vistas/biblioteca/nuevoLibro.php');
 
   $error=array("tipo"=>'success', "msg"=>'Nuevo libro registrado');
   $_SESSION['msg']=$error;
}else{
    header('Location:../../vistas/biblioteca/nuevoLibro.php');
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al crear nuevo Libro');
    $_SESSION['msg']=$error;
    
}
?>