
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
 
   
   $resp = actualizaMontoSE($monto, $folio);
   if($resp){
       header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$alumno);
   }else{exit("Hubo un error al guardar el nuevo monto ");}
   
   
   
   ?>
