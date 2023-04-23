
<?php
   include '../../modelo/usuarios/usuarios.php';
   abreSesion();
   if(!isset($_SESSION['user'])){
       header("Location:../../");
   }
   require '../../modelo/enfermeria/comunesEnfermeria.php';
  
   $folio= $_POST["folio"];
   $alumno =$_POST['alumno'];
   $monto = $_POST["monto"]; 
   $monto= str_replace(array("$", ","), "", $monto);
 
   $folio =trim($folio);
   $alumno =trim($alumno);
   

   $resp = actualizaMontoSE($monto, $folio);
   if($resp){
       header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$alumno);
       $error=array("tipo"=>'success', "msg"=>'Monto actualizado');
       $_SESSION['msg']=$error;
   }else{
    
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$alumno);
    $error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar el nuevo monto');
    $_SESSION['msg']=$error;

}
   
   
   
   ?>
