
    
    <?
     include '../../modelo/psicologia/psico.php';

    $motivo = $_POST['miMotivo'];
 $alumno = $_POST['alumno'];
//validacion de campos
if($motivo == "" || $alumno == ""){
    header('Location:../../vistas/psicopedagogico/pprincipal.php');
}

 $resp = insertaMotivoPsico($motivo);
 if($resp){
    if($alumno != 0){
        //si viene diferente de cero viene de nuevo caso
        header('Location:../../vistas/psicopedagogico/psicoNuevoCaso.php?id='.$alumno);
    }else{
        //si viene como 0 entonces viene de panel principal de psicologia
        header('Location:../../vistas/psicopedagogico/pprincipal.php');
    }
   
 }
 else{
    //si no se lleva a cabo la insersion correctamente
    
     exit("Hubo un error al guardar el nuevo motivo de atención psicológica");
 }

 ?>
