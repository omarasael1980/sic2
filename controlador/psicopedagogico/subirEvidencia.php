

<?php
   /*
       Array
(
    [idestudiante] => 115
    [idenfermeria] => 19
    [nombre] => logo
)
Array
(
    [imagen] => Array
        (
            [name] => book.png
            [type] => image/png
            [tmp_name] => /tmp/php3SNJJ4
            [error] => 0
            [size] => 18242
        )

)*/

   require_once '../../modelo/psicologia/psico.php';
   require_once '../../modelo/usuarios/usuarios.php';
   abreSesion();
   if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
       header("Location:../../");
   }

   $nombre = $_POST['nombre'];
    $folio=$_POST['folioPsico'];
    $idal = $_POST['idestudiante'];
    $tmp = $_FILES['imagen']["tmp_name"];
    $nombreArchivo =  $_FILES['imagen']["name"];
    $sizeKB = $_FILES['imagen']["size"]/1024;
    $tipos=explode("/",$_FILES['imagen']['type']);
    $tipo =$tipos[count($tipos)-1];
    $id=uniqid();
    $maxKb = 400;
    echo $id;

    $nombre =trim($nombre);
    $folio =trim($folio);

    
   $extensionesPermitidas = "jpg, jpeg, png, mp4, pdf";
   if(strstr($extensionesPermitidas, $tipo)){
        switch($tipo){
            case "png":
            case "jpg":
            case "jpeg":
                if($sizeKB>$maxKb){
                    exit ( 'El tamaño de la imagen excede el límite de '.$maxKb.' Kb');
                }
                $ruta = "../../private/img";
                break;
            case "mp4":
                $ruta = "../../private/videos";
                break;
            case "pdf":
                $ruta = "../../private/docs";
                break;
        }
        if(is_uploaded_file($tmp)){
            move_uploaded_file($tmp,$ruta.'/'.$id."_".$nombreArchivo );
            $imagen =$ruta.'/'.$id."_".$nombreArchivo;
            $st = insertaEvidenciaPsico($nombre, $imagen,$tipo, $folio);
            
            Header("Location: ../../vistas/psicopedagogico/pprincipal.php");
            $error=array("tipo"=>'success', "msg"=>'Evidencia guardada correctamente');
            $_SESSION['msg']=$error;

        }
   }else{
    Header("Location: ../../vistas/psicopedagogico/pprincipal.php");
    $error=array("tipo"=>'error', "msg"=>'Este archivo no está permitido');
    $_SESSION['msg']=$error;
   }




   Header("Location:../../vistas/psicopedagogico/pprincipal.php");


?>