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
$ruta = '../../private/sql/respaldos';
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
                         <a href="eprincipal.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="e_nuevoCaso.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="expedienteAlumno.php"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Expedientes </p></a>
                     
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
            <H1 class="text-center"><b>Llenar expedientes médicos</b></H1>
            <div class="row">
                 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0 "> </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 "> 
                            <div class="antecedentes">
                                    <h3><b> Instrucciones:</b></h3>
                                    <br>
                                    <p>1.- Realiza un respaldo</p>
                                    <p>2.- Descarga los registros</p>
                                    <p>3.- Envía claves de acceso</p>
                                    <p>4.- La liga de acceso es: https://sisantee.com.mx/vistas/alumnos/ingresoAlumnos.php</p>
                                    <p>5.- Si quieres regresar a una versión anterior, selecciona el respaldo y da click en el botón restaurar</p>

                        </div>
                    </div>
            </div>  
<br><br><br><br>
                <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0 "> </div>
                         <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                          <!-- inicia div respaldar -->
                                <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                        <p class="bajoBoton"><b> 1.-Respaldar </b></p>  
                                        </div> 
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                                            <a class="nav-button-chico" href="../../controlador/enfermeria/respaldaExpedienteMedico.php">
                                            <i class="fa-solid fa-database"></i></a>
                                        </div>  
                               
                               
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 form-control">
                                        <h6 class="text-center"><b> Respaldos </b></h6>  
                                        <?php
                                        
                                        $archivos = scandir($ruta);
                                        
                                        foreach($archivos as $archivo) {
                                          // Excluir los archivos "." y ".."
                                          if ($archivo != "." && $archivo != "..") {
                                            echo $archivo . "<br>";
                                          }
                                        }
                                        ?> 
                                        </div>  
                                 </div>
                                 <!-- termina div respaldar -->
                                 <hr>
                                 <!-- div descargar plantilla -->
                                 <div class="row">
                                 
                                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                        <p class="bajoBoton"><b> 2.- Descargar registros </b></p>  
                                        </div> 
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                                            <a class="nav-button-chico" href="../../controlador/enfermeria/descargaTokens.php">
                                            <i class="fa-solid fa-file-csv"></i></a>
                                        </div>  
                                 </div>
                                 <!-- termina div descargar plantilla -->
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

 

<?php require '../complementos/footer_2.php';?>