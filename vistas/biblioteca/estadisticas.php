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
$estadisticas =  buscaEstadisticasPrestamos();
$libros =buscaTodosLibros();
foreach ( $libros as $l){
  $titlosMasPrestados = buscaPrestamosLibro($l->idlibros);
  $i=0;
 
    //se cuentan cuantos prestamos tiene el titulo
    if($titlosMasPrestados != false){
        foreach($titlosMasPrestados as $tmp){
          $i=$i+1;
        }
        $estTitulo[]=array( "prestamos"=>$i, "titulo"=>$l->titulo);
        arsort($estTitulo);
      }
}
$titulos[] ="" ;

$i=0;
foreach( $estTitulo as $t){
if($i<10){
  $titulos[$i] = $t;
}
$i++;
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
    
      
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
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
                       
                             
                                                       <br>   
                          
                                                
                                     
                                          <!-- contenedor_grafico tiene el css -->
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h1 class="text-center"><b>TOP 10</b></h1>
                                <hr>
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contenedor_grafico">
                              <?php  
                                                      //  se manda la variable a JS
                                                      echo "<script>";
                                                      echo "var titulos = ".json_encode($titulos).";";
                                                      echo "</script>";?>
                                        <!-- id controla la grafica disenada en JS -->
                                    <canvas class="m-0 p-0" id="graficaTitulos">

                                    </canvas>
                                    </div>
                                </div>
                            <!-- separador -->  
                           
                            <?php $i=0; $gruposEst[] =""; ?>
                                                        <?php foreach($e['xGrupo'] as $xGrupo):?>
                                                         
                                                          <?php if($xGrupo != ""):?>
                                                         
                                                         <?php 
                                                                if($i<6): ?>
                                                                <?php $gruposEst[$i]= ['grupo'=>$xGrupo['Grupo'],'cantidad'=> $xGrupo['prestamos']];  $i++; ?>
                                                             
                                                              
                                                            <?php endif?>
                                                             <?php endif?>
                                                        <?php endforeach?>                                     
                                <!-- contenedor_grafico tiene el css -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h1 class="text-center"><b>Grupos con  más préstamos</b></h1>
                                <hr>
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contenedor_grafico">
                              <?php  
                                                      //  se manda la variable a JS
                                                      echo "<script>";
                                                      echo "var grupos = ".json_encode($gruposEst).";";
                                                      echo "</script>";?>
                                        <!-- id controla la grafica disenada en JS -->
                                    <canvas class="m-0 p-0" id="graficaGrupos">

                                    </canvas>
                                    </div>
                                </div>
                            <!-- separador -->  

                              <!--grupos con mas prestamos-->
                             
                                                        <?php endforeach?>
                                                    <?php endif?>

                        <!--final titulos mas prestados-->

                        </div>
                     </div>
<!-- aqui terminan estadisticas -->
            <!--contenedor central -->
        
       
         
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
  
    </div>
</div>
<script src="../../js/graficasBiblioteca.js"></script>