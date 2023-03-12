<?php

   require_once '../../modelo/enfermeria/comunesEnfermeria.php';
   $nombre = $_POST['nombre'];
    $idenfermeria=$_POST['idenfermeria'];
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
            $st = insertaEvidenciaMedica($nombre, $imagen,$tipo, $idenfermeria);
            
            Header("Location: ../../vistas/enfermeria/expedienteAlumno.php?id=".$idal);

        }
   }else{
    exit ("Este archivo no está permitido");
   }




   Header("Location: ../../vistas/enfermeria/expedienteAlumno.php?id=".$idal);


?> 