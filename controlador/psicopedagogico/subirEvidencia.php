

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

        }
   }else{
    exit ("Este archivo no está permitido");
   }




   Header("Location:../../vistas/psicopedagogico/pprincipal.php");


?>