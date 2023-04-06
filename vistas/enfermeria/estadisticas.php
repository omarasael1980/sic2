<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';
$espacios = "       ";
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
                         <a href="eprincipal.php" class="  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="e_nuevoCaso.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a>
                                             
                        <br> <a href="estadisticas.php" class="btn btn-primary list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
  <!-- contenedor_grafico tiene el css -->
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contenedor_grafico">
                
                <?php  
                //  se manda la variable a JS
                echo "<script>";
                echo "var estMotivos = ".json_encode($estMotivos).";";
                echo "</script>";?>
                <!-- id controla la grafica disenada en JS -->
            <canvas class="m-0 p-0" id="graficaMotivos">

            </canvas>
         </div>
    <!-- separador -->

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