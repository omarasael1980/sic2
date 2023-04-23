
    
    <?
     include '../../modelo/psicologia/psico.php';
     require_once '../../modelo/usuarios/usuarios.php';
    abreSesion();
    if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
        header("Location:../../");
    }

    $motivo = $_POST['miMotivo'];
 $alumno = $_POST['alumno'];
//validacion de campos
if($motivo == "" || $alumno == ""){
    header('Location:../../vistas/psicopedagogico/pprincipal.php');
   
$error=array("tipo"=>'success', "msg"=>'No pueden quedar los campos vacíos');
$_SESSION['msg']=$error;
}

 $resp = insertaMotivoPsico($motivo);
 if($resp){
    if($alumno != 0){
        //si viene diferente de cero viene de nuevo caso
        header('Location:../../vistas/psicopedagogico/psicoNuevoCaso.php?id='.$alumno);
          
        $error=array("tipo"=>'success', "msg"=>'Nuevo motivo guardado correctamente');
        $_SESSION['msg']=$error;
    }else{
        //si viene como 0 entonces viene de panel principal de psicologia
        header('Location:../../vistas/psicopedagogico/pprincipal.php');
            
        $error=array("tipo"=>'success', "msg"=>'Nuevo motivo guardado correctamente');
        $_SESSION['msg']=$error;
    }
   
 }
 else{
    //si no se lleva a cabo la insersion correctamente
    header('Location:../../vistas/psicopedagogico/pprincipal.php');
     $error=array("tipo"=>'error', "msg"=>'Hubo un error al guardar el nuevo motivo de atención psicológica');
     $_SESSION['msg']=$error;
 }

 ?>
