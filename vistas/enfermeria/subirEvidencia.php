<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';

$espacios = "        ";
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
?>




<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
       <div class="row">
                 <center><a href="eprincipal.php">
                 <img class="img-menu" src="../../img/icons/enfermeria.webp" alt="enfermeria"></a></center>
        </div>
        <div class="row">
                
                    <h4 class="text-center">Enfermería</h4>
                
        </div>
        <div class="row">
                <h1 class="text-center">Menú</h1>
                <div class="list-group">
                  
                         <!--Menu desplegable-->
                         <a href="eprincipal.php" class=" btn list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <!-- <br>   <a href="e_nuevoCaso.php?id=" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a> -->
                         <br>
                        <a class="btn btn-primary list-group-item text-center list-group-item-action" href=""><p><i class="fa-solid fa-file-import"></i><?=$espacios?> Subir evidencia </p></a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="expedienteAlumno.php?id=<?=$_GET['c'];?>"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Expedientes </p></a>
                     
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
          <div class="container">
    <div class="row">
        <center><h1>Subir Evidencia</h1></center>
        <br><br><br>
    </div> 
</div>
<div class="container">
    <div class="row ">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
          
        <form class="form-control2"action="../../controlador/enfermeria/subirArchivo.php" autocomplete ="off"method="post" enctype="multipart/form-data">
            <input type="text" required hidden name = "idestudiante" autocomplete="off"value="<?=$_GET['c']?>">
            <input type="text" required hidden name = "idenfermeria" autocomplete="off"value="<?=$_GET['id']?>">
            <!-- inicia input nombre -->
            <div class="form-group " id="grupo__nombre">
            <div class="form-group-input">
                <label for="nombre" class="form-label form-control2"> <b> Asignar Nombre:</b>
                    <input type="text"  spellcheck="true" lang="es"  onkeyup="valida1('nombre')" class="form-control" id="nombre" required name="nombre">
                        <i class=""><img class="form-validation-state img-input" id="img-usuario"
                        src="../../img/icons/cross.png" alt="incorrecto"> </i>
                </div> 
                </label>
                <div class="form-message" id="mensaje_error__nombre">
                        <p>Debes escribir un nombre para el archivo, solo se permiten letras</p>
                </div>
            </div> <br>
            <!-- termina input nombre -->
              <!-- inicia input imagen -->
            <div class="form-group " id="grupo__Archivo">
            <div class="form-group-input">
                <label for="Archivo" class="form-label form-control2"> <b> Asignar Archivo:</b>
                <input type="file" required name="imagen" id="Archivo"class="form-control"><br>
                  <i class=""><img class="form-validation-state img-input" id="img-usuario"
                        src="../../img/icons/cross.png" alt="incorrecto"> </i>
                </div> 
                </label>
                <div class="form-message" id="mensaje_error__Archivo">
                        <p>Debes seleccionar un archivo (pdf, jpg, mp4)</p>
                </div>
            </div> <br>
          
            <!-- termina input imagen  -->
            <!-- <input type="text" required name="nombre" placeholder ="nombre" class="form-control"><br><br> -->
           <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12"></div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <input type="submit" onclick="validarform()" class="nav-button-cargar form-control" value="Aceptar">
            </div>
            </div>
        </form>
       
        </div>
    </div>

    </div>

            <!--contenedor central -->
          
       
            </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->
                 <!--Mostrar estadisticas --> 
             


                     
    <!--contenedor derecha -->

        </div>
    </div>
</div>

<script src="../../js/validaSubirEvidencia.js"> </script>
<?php require '../complementos/footer_2.php';?>