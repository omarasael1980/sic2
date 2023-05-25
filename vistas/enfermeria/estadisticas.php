<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/cabeceraGraficos.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';
$espacios = "       ";
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
$ajustes = buscSettings();
$gastado =buscaCantidadGastada();
$seguro = $ajustes[0]->montoSeguro;
$disponible = $seguro - $gastado[0]->total;
$disponibleseguro[]="";
$disponibleseguro[0]= ['titulo'=>'gastado','cantidad'=>$gastado[0]->total];
$disponibleseguro[1]= ['titulo'=>'disponible','cantidad'=>$disponible];
$estCat =atencionesxCategoria();

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
                         <a href="eprincipal.php" class="  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                       
                                             
                        <br> <a href="estadisticas.php" class="btn btn-primary list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
          <!--contenedor central -->
  <!-- contenedor_grafico tiene el css -->
  <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 contenedor_grafico">
                
                <?php  
                //  se manda la variable a JS
                echo "<script>";
                echo "var disponible = ".json_encode($disponibleseguro).";";
                echo "</script>";?>
                <!-- id controla la grafica disenada en JS -->
            <canvas class="graficas" id="graficaDisponible">

            </canvas>
         </div>
         <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0 "></div>
    <!-- separador -->
    <!-- contenedor_grafico tiene el css -->
 
  <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 contenedor_grafico">
                
                <?php  
                //  se manda la variable a JS
                echo "<script>";
                echo "var categorias = ".json_encode($estCat).";";
                echo "</script>";?>
                <!-- id controla la grafica disenada en JS -->
            <canvas class="graficas" id="graficoCategoria">

            </canvas>
         </div>
    <!-- separador -->

            <!--contenedor central -->
          
       
            </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
       
    </div>
</div>

 
<script src="../../js/graficasEnfEstadisticas.js"></script>
<?php require '../complementos/footer_2.php';?>