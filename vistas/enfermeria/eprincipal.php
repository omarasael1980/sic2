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


?>


<!-- body  -->
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <center><H1  >Enfermería</H1></center>
                  <center><div ><img  style="width: 120px;height: auto;" src="../../img/icons/enfermeria.webp" alt="enfermeria">
                  </div></center>
          </div>
</div>
    <div class="row">
    <form action="../../controlador/enfermeria/atencion_enfermeria.php"  class="form-control2"method="post" autocomplete="off">
                <div class="col-lg-0 col-md-3 col-sm-1 col-xs-0"></div>
                <div class="col-lg-2 col-md-1 col-sm-2 col-xs-2">
                    <label for="alumno" class="form-control2"><center><b> Buscar Alumno:</b></center></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-10">
                     <input type="text" required class="form-control"name="alumno" id="alumno">

                        <ul id="lista"> 
                        
                             </ul>
                  
                  </div>
               
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <button class="form-control btn btn-success">Cargar Expediente</button>
                     
                  </div>
               
          </form>
    </div>
              
                
            <!--columna izquierda-->
            <div class="row">
                    <div class="form-control col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <!--Se muestran los ultimos casos atendidos-->
                        
                        <center><h1>Últimos casos atendidos</h1></center>   
                        <div class="container">
                        
                            
                          
                            <!--barra de encabezado de cada caso-->
                 
                    <?php if($uCasos!=false):?>
                    <?php foreach($uCasos as $caso):?>
                      <div class="row  ">

                              <p class="col-lg-2 col-md-3 col-sm-4 col-xs-6 "> 
                                  Folio: <?=$caso->idenfermeria?>
                    </p> 
                              <p class="col-lg-4 col-md-3 col-sm-4 col-xs-6 "> 
                              <?=$caso->nombre." ".$caso->apaterno." ".$caso->amaterno?> 
                    </p> 
                              <p class="col-lg-2 col-md-3 col-sm-4 col-xs-6 "> 
                                  <?=$caso->grupo?>
                    </p> 
                              <p class="col-lg-3 col-md-3 col-sm-4 col-xs-6 "> 
                              <?=$caso->fecha?>
                    </p> 
                    </div> 
                    <div class="row  ">
                              <p class="col-lg-3 col-md-4 col-sm-4 col-xs-6 "> 
                                  Motivo: <?=$caso->motivo?>
                    </p> 
                              <p class="col-lg-6 col-md-8 col-sm-12 col-xs-12 "> 
                                Descripción  <?=$caso->descripcion?>
                    </p> 
                              <p class="col-lg-3 col-md-4 col-sm-4 col-xs-6 "> 
                                Categoría  <?=$caso->categoriaMedica?>
                    </p> 
                    </p> 
                    </div> 
                    <hr>
                    <?php endforeach?>
                    <?php endif?>
               
                    </div>
                       
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <!--Se muestran las estadisticas de atencion-->
                        <div class="form-control ">
                          <center><h2>Estadísticas</h2></center>
                          <?php foreach($estadisticas as $e):?>
                        
                            <!--Se muestran las estadisticas dias sin incidentes-->
                        <div class="row ">
                            <br>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control2">
                                <br>
                               <center> <h3>Días sin incidentes</h3></center>
                               <?php
                               if($e['ultimoEvento']<5){
                               $color = "danger";
                            }else if($e['ultimoEvento']>4 & $e['ultimoEvento']<10){
                                $color ="warning";
                               }else {
                                $color ="success";
                               }
                               
                               ?>
                               <center><H1 class="blink <?=$color?>"><?=$e['ultimoEvento']?></H1></center>
                               
                               <br>
                            </div>
                        </div>
                        <br>
                        <!--Se muestran las estadisticas  de incidentes -->
                        <div class="row form-control2">
                                
                                        
                                    <center> <h2>Atenciones médicas  </h2></center>
                                 
                                    <center> <h4>Desde: <?=$fechaI?>  </h4></center>
                                    <center> <h4>Hasta: <?=$fechaF?>  </h4></center>
                                    <br>
                                    
                                    <?php foreach ($e['Incidencias'] as $i):?>
                                       
                                    <center><H3><?=$i['cantidad']['eventos']?></H3></center>
                                  
                                    <?php endforeach?>
                                   
                                    <br> 
                                    
                                   
                        </div>
                        <br>
                             <!--Se muestran las estadisticas por categoria-->
                             <div class="row form-control2">
                                
                              
                            <center> <h2>Categorías con más incidentes</h2></center>
                            <br>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <?php foreach ($e['Categorias'] as $c):?>
                                <?php if($c['numero']>0):?>
                            <H4 class=""><?=$c['categoria'].' ('.$c['numero'].")"?></H4>
                            <?php endif?>
                            <?php endforeach?>
                            </div>
                            <br> 
                            
                           
                </div> <br>
                          <!--Se muestran las estadisticas por grupo-->
                        <div class="row form-control2">
                     
                                       
                                    <center> <h2>Grupos con más incidentes</h2></center>
                                    <br>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <?php foreach ($e['Grupos'] as $g):?>
                                        <?php if($g['numero']>0):?>
                                    <H4 class=""><?=$g['grupo'].' ('.$g['numero'].")"?></H4>
                                    <?php endif?>
                                    <?php endforeach?>
                                    </div>
                                    <br> 
                                    
                                    
                        </div>
                        <?php endforeach?>
                    </div>
                    </div>
    </div>

    <script src="../../js/peticiones.js">        </script>
<?php require '../complementos/footer_2.php';?>
