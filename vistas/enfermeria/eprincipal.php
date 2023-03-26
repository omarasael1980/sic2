<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
$fechaI='2022-08-21';
date_default_timezone_set("America/Tijuana");
$fechaF= date("Y-m-d");
$estadisticas = dameEstadisticasMedicas('2022-08-21',$fechaF);
$roles = buscaRoles();
$uCasos =cargarUltimasAtencionesMedicas();
$categorias = getCategoriasMedicas();
$espacios = "        ";

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
                       <!--  <br>   <a href="e_nuevoCaso.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                      
                        <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="expedienteAlumno.php"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Expedientes </p></a> -->
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
<br><br>
         
    <div class="row m-0 p-0">
    <form action="../../controlador/enfermeria/atencion_enfermeria.php"  class="form-control2"method="post" autocomplete="off">
                <div class="col-lg-2 col-md-3 col-sm-1 col-xs-0 m-0 p-0"></div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 m-0 p-0">
                    <label for="alumno" class="form-control2"> <p class="text-center"> <b> Buscar Alumno:</b></p></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 m-0 p-0">
                     <input type="text" required class="form-control"name="alumno" id="alumno">

                        <ul id="lista"> 
                        
                             </ul>
                  
                  </div>
               
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 m-0 p-0">
                        <button class="form-control btn btn-success">Cargar Expediente</button>
                     
                  </div>
               
          </form>
    </div>
              
                
          
            <div class="row m-0 p-0">
                    <div class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12 m-0 p-0">
                        <!--Se muestran los ultimos casos atendidos-->
                        
                        <h1 class="text-center">Últimos casos atendidos</h1>  
                        <div class="container">
                        
                            
                          
                            <!--barra de encabezado de cada caso-->
                 
                    <?php if($uCasos!=false):?>
                    <?php foreach($uCasos as $caso):?>
                      <div class="row  ">

                              <p class="col-lg-4 col-md-4 col-sm-6 col-xs-6  m-0 p-0"> 
                                  Folio: <?=$caso->idenfermeria?>
                    </p> 
                              <p class="col-lg-4 col-md-4 col-sm-6 col-xs-6  m-0 p-0"> 
                              <?=$caso->nombre." ".$caso->apaterno." ".$caso->amaterno?> 
                    </p> 
                              <p class="col-lg-4 col-md-4 col-sm-6 col-xs-6  m-0 p-0"> 
                                 Grupo: <?=$caso->grupo?>
                    </p> 
                              <p class="col-lg-4 col-md-4 col-sm-6 col-xs-6 m-0 p-0"> 
                               <?="Fecha:".substr($caso->fecha, 0,10)." Hora: ".substr($caso->fecha, 10);?>
                           
                    </p> 
                  
                              <p class="col-lg-4 col-md-4 col-sm-6 col-xs-6 m-0 p-0 "> 
                                  Motivo: <?=$caso->motivo?>
                    </p> 
                            
                              <p class="col-lg-4 col-md-4 col-sm-6 col-xs-6 m-0 p-0"> 
                                Categoría  <?=$caso->categoriaMedica?>
                    </p> 

                    <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-0 p-0"> 
                                Descripción  <?=$caso->descripcion?>
                    </p> 
                    </div> 
                    <hr>
                    <?php endforeach?>
                    <?php endif?>
               
                    </div>
                       
                    </div>
                   
    </div>

            <!--contenedor central -->
        </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2 p-0">
            
         <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-0">
                                <br><br><br><br>
                            </div></div>
    <!--contenedor derecha -->
                 <!--Mostrar estadisticas --> 
             
              
                        <!--Se muestran las estadisticas de atencion-->
                        <div class="form-control"   >
                           
                         <h4 class="text-center">Estadísticas</h4>
                          <?php foreach($estadisticas as $e):?>
                       
                            <!--Se muestran las estadisticas dias sin incidentes-->
                        <div class="row m-0 p-0">
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control2  " style="background:#FFFF99; font-size: small; border-radius: 20px;">
                                
                              <h6 class="text-center">Días sin incidentes</h6>
                               <?php
                               if($e['ultimoEvento']<5){
                               $color = "danger";
                            }else if($e['ultimoEvento']>4 & $e['ultimoEvento']<10){
                                $color ="warning";
                               }else {
                                $color ="success";
                               }
                               
                               ?>
                             <H4  class="text-center  blink <?=$color?>"><?=$e['ultimoEvento']?></H4>
                               
                              
                            </div>
                        </div>
                        <br>
                        <!--Se muestran las estadisticas  de incidentes -->
                        <div class="row form-control2 " style="background:#FFFF99; font-size: small; border-radius: 20px;">
                                
                                        
                                   <h6 class="text-center">Atenciones médicas  </h6>
                                 
                                   <h7 class="text-center col-12">Desde: <?=$fechaI?>  </h7>
                                   <h7 class="text-center col-12">Hasta: <?=$fechaF?>  </h7>
                                    <br>
                                    
                                    <?php foreach ($e['Incidencias'] as $i):?>
                                       
                                    <H4 class="text-center"><?=$i['cantidad']['eventos']?></H4>
                                  
                                    <?php endforeach?>
                                   
                                    <br> 
                                    
                                   
                        </div>
                        <br>
                             <!--Se muestran las estadisticas por categoria-->
                             <div class="row form-control2 "style="background:#FFFF99; font-size: small; border-radius: 20px;">
                                
                              
                           <h6 class="text-center">Categorías con más incidentes</h6>
                            
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-0"></div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 p-0">
                            <?php foreach ($e['Categorias'] as $c):?>
                                 <p class="text-center">
                                <?php if($c['numero']>0):?>
                                    <p class="text-center">  <?=$c['categoria'].' ('.$c['numero'].")"?></p>
                            <?php endif?>
                            <?php endforeach?>
                            </div>
                            <br> 
                            
                           
                </div> <br>
                          <!--Se muestran las estadisticas por grupo-->
                        <div class="row form-control2 " style="background:#FFFF99; font-size: small; border-radius: 20px;">
                     
                                       
                                   <h6 class="text-center">Grupos con más incidentes</h6>
                                    <br>
                                    
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 p-0">
                                 <?php foreach ($e['Grupos'] as $g):?>
                                   <p class="text-center">
                                        <?php if($g['numero']>0):?>
                                   <?=$g['grupo'].' ('.$g['numero'].")"?></p>
                                    <?php endif?>
                                   
                                    <?php endforeach?>
                                    </div>
                                    <br> 
                                    
                                    
                        </div>
                        <?php endforeach?>
                    </div>
                    

                     
    <!--contenedor derecha -->

        </div>
    </div>
</div>
<script src="../../js/peticiones.js">        </script>
<?php require '../complementos/footer_2.php';?>