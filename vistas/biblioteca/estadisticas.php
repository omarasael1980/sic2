<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";


if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}
$grupos =buscarGrupoS();
if(isset ($_POST['grupo'])){
    $grupoElegido = $_POST['grupo'];
    $prestamos =buscaPrestamosActivosGrupo($grupoElegido);
    if($prestamos == ""){
        unset($prestamos);
    } 
}
  $espacios = "        ";
$estadisticas =  buscaEstadisticasPrestamos();?>


<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
       <div class="row">
                 <center><a href="../../vistas/biblioteca/bprincipal.php">
                 <img class="img-menu" src="../../img/icons/libreria.jpg" alt="biblioteca"></a></center>
        </div>
        <div class="row">
                
                    <h4 class="text-center">Biblioteca</h4>
                
        </div>
        <div class="row">
                <h1 class="text-center">Menú</h1>
                <div class="list-group">
                  
                         <!--Menu desplegable-->
                         <a href="bprincipal.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="nuevoPrestamo.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Nuevo Préstamo</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="historialPrestamos.php"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Historial </p></a>
                        <br> <a href="binventario.php" class=" list-group-item text-center list-group-item-action"><p> <img class="logos-enfermeria"
                                        src="../../img/icons/inventory.png" alt=""> <?=$espacios?>Inventario </p> </a>
                        <br> <a href="estadisticas.php" class="btn-primary list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
        <div class="row"><h1 class="text-center">Estadísticas</h1></div>
                <!-- aqui inicia estadisticas -->
                <!--Mostrar estadisticas --> 
 <br>
                     
            <div class="row">
                        <!--inicio libros prestados-->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <h4 class="text-center">Libros  Prestados Actualmente</h4>
                            <hr>
                                <?php if(isset($estadisticas)):?>
                                    <?php foreach($estadisticas as $e):?>
                                      <h3 class="text-center"> <b> <?=$e['prestados']->prestados?> </b></h3>
                                        <br>                          
                     </div>                    
                        <!--final libros prestados-->
                          <!--titulos mas prestados-->
                          
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <!--inicio libros prestados-->
                              
                                <h4 class="text-center">Total Prestados en el ciclo escolar</h4>
                                    <hr>
                                   <h3 class="text-center"><b> <?=$e['Total'][0]->prestados?></h3></b>
                                
                        </div>  
            </div> 
                        <div class="row">
                              <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 "> 
                                                       <br>   
                           <h2 class=" text-center">Top 10</h2>
                         <h3 class="text-center">Títulos mas leídos</h3>
                          <hr>
                                                
                      
                                                        <?php $x=0; ?>
                                    <?php foreach($e['xTitulo'] as $xtitulo):?>
                                        
                                            <?php if($xtitulo != ""):?>
                                                <?php $x++; 
                                                if($x<11): ?>
                                                <div class="row " >
                                                    
                                                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 ">
                                                <b> <p ><?=$xtitulo['titulo']?>:
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-xs-5 col-sm-5 ">
                                            <p > <?=$xtitulo['prestamos']?></p></b>
                                                </div>
                                                </div>
                                            <?php endif?>
                                            <?php endif?>
                                            
                                    <?php endforeach?>

                            </div>
                         
                            <br>
                              <!--grupos con mas prestamos-->
                              <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 form-control2"> 
                                <br><br>
                        <h3 class="text-center">Grupos con  más préstamos</h3>
                          <hr>
                                                
                                        
                                                       <?php $i=0; ?>
                                                        <?php foreach($e['xGrupo'] as $xGrupo):?>
                                                            <?php if($xGrupo != ""):?>
                                                                <?php $i++; 
                                                                if($i<6): ?>
                                                                <div class="row">
                                                                 <div class="col-lg-4 col-md-4 col-xs-0 col-sm-0 form-control2"> </div>
                                                            <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
                                                             <label for=""><b> <p><?=$xGrupo['Grupo']?>:</div>
                                                            <div class="col-lg-2 col-md-2 col-xs-6 col-sm-6">
                                                            <p class="text-center">  <?=$xGrupo['prestamos']?></p></b></label></p>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-xs-0 col-sm-0 form-control2"> </div>
                                                           
                                                            </div>
                                                            <?php endif?>
                                                             <?php endif?>
                                                        <?php endforeach?>
                                                     
                            </div>
                                                        <?php endforeach?>
                                                    <?php endif?>

                        <!--final titulos mas prestados-->

                        </div>
                     </div>
<!-- aqui terminan estadisticas -->
            <!--contenedor central -->
        
       
         
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12  ">
    <!--contenedor derecha -->

    <!--contenedor derecha -->

        </div>
    </div>
</div>
   