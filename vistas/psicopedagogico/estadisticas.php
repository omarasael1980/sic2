<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/cabeceraGraficos.php';
require '../complementos/nav_2.php';
require_once '../../modelo/psicologia/psico.php';
require '../../modelo/config/comunes.php';
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$today =  date('Y-m-d');
$estadisticasPsico= get_BuscaEstadisticasPsico($today);
$estAtendidos = $estadisticasPsico['atendidos'][0]->atendidos;
$estSeguimiento = $estadisticasPsico['seguimiento'][0]->seguimiento;
$estCerrados = $estadisticasPsico['cerrados'][0]->cerrados;
$estHoy = $estadisticasPsico['hoy'][0]->hoy;
$estMotivos = $estadisticasPsico['motivos'];
$estGrupos = $estadisticasPsico['grupos'];
$estCategorias = $estadisticasPsico['categoria'];
?>

<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
     <div class="row">
                 <center><a href="../../vistas/psicopedagogico/pprincipal.php">
                 <img class="img-menu" src="../../img/icons/psicologa.jpg" alt="Psicopedagógico"></a></center>
            </div>
            <div class="row">
                
                    <h4 class="text-center">Psicopedagógico</h4>
                
            </div>
            <div class="row">
                <h1 class="text-center">Menú</h1>
                <div class="list-group">
                  
                         <!--Menu desplegable-->
                        <?php  $espacios = "        ";?>
                         <a href="pprincipal.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-bars"> </i> <?=$espacios?>Pendientes</p>  </a>
                       <br> <a class="list-group-item text-center list-group-item-action" href="psicoNuevoCaso.php"><p><i class="fa-solid fa-file-circle-plus"></i><?=$espacios?> Nuevo caso </p></a>
                        <br><a href="historialPsico.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                        <br><a href="estadisticas.php" class="list-group-item  btn-primary text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                     
                </div>
                
            </div>

     </div>
      
  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12 "> <!--contenedor central -->  
<?php if($estadisticasPsico["atendidos"][0]->atendidos !=0):?>
    <div class="container">
        <div class="row">
            <!-- contenedor_grafico tiene el css -->
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 contenedor_grafico">
                
                <?php  
                //  se manda la variable a JS
                echo "<script>";
                echo "var grupos = ".json_encode($estGrupos).";";
                echo "</script>";?>
                <!-- id controla la grafica disenada en JS -->
                    <canvas class="m-0 p-0" id="graficaGrupos" >

                    </canvas>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0">
</div>
            <!-- separador -->
         
            <!-- contenedor_grafico tiene el css -->
                 <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 contenedor_grafico">
                
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
             <!-- contenedor_grafico tiene el css -->
          <hr style="border:transparent">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 contenedor_grafico">
                
                            <?php  
                            //  se manda la variable a JS
                            echo "<script>";
                            echo "var estcategorias = ".json_encode($estCategorias).";";
                            echo "</script>";?>
                            <!-- id controla la grafica disenada en JS -->
                    <canvas class="m-0 p-0" id="graficaCategorias">

                    </canvas>
                 </div>
            
        </div>
    </div>
    <?php else:?>

    <h1 class="text-center">No hay ningún registro aún</h1>
    <?php endif?>
<!-- FIN CENTRO --></div>
<!--contenedor central -->
    
       
        
        
    </div>
</div>
   
<script src="../../js/graficas.js"></script>

<?php require '../complementos/footer_2.php';?>

<?php
