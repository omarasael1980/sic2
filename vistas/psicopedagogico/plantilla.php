<pre>
    <?php print_r($_GET);?>
</pre>
<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/psicologia/psico.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$pendiente = cargaPendientesPsico();

?>


<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 form-control">
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
                         <a href="pprincipal.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-bars"> </i> <?=$espacios?>Pendientes</p>  </a>
                        <a class="list-group-item text-center list-group-item-action" href="psicoNuevoCaso.php"><p><i class="fa-solid fa-file-circle-plus"></i><?=$espacios?> Nuevo caso </p></a>
                        <a href="#" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                        <a href="#" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                        <a href="#" class="list-group-item text-center  list-group-item-action"><p><i class="fa-solid fa-route"></i><?=$espacios?>Canalizaciones</p> </a>
                </div>
                
            </div>

     </div>
      
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-control">
<!--contenedor central -->
<center><h1> Casos pendientes de seguimiento.</h1></center>
<div class="row"> <!-- INICIO CENTRO -->
<!-- Se cargan los registros conetiqueta de seguimiento -->
<?php if($pendiente != ""):?>
<?php foreach($pendiente as $p):?>
    <!-- se llaman datos del alumno -->
   <?php if($pendiente !=null){
    //busca datos del estudiante
    $idalget = buscaAlumno($p->estudiantes_idestudiantes); //carga al alumno
    //se prepara para juntar el nombre
    $alumno = $idalget[0]->nombre." ".$idalget[0]->apaterno." ".$idalget[0]->amaterno;
    $grupo = $idalget[0]->grupo;

    }?>
    <!-- inicia boton colapsable -->
    <p>
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" 
        data-bs-target="#collapse<?=$p->idatencion_psico?>" aria-expanded="false" aria-controls="collapseWidthExample">
             <!--datos del boton colapsable de casos activos  -->
        <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0">Folio: <?=" ".$p->idatencion_psico?></div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">Fecha: <?=" ".$p->fecha?></div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><?=$alumno?></div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-0"><?=$grupo?></div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><?=$p->motivo?></div>
  
  </button>
</p>
<div style="">
  <div class="collapse " id="collapse<?=$p->idatencion_psico?>">
  
    
    <!-- se muestran detalles de caso activo -->
    <div class="row" style="width: 100%;">
  
        <!-- descripcion del caso pendiente -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control"><b>Descripción:</b> <?=$p->descripcion?></div>
        <hr>
         <center>Acciones:</center> 
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
       
            <!-- boton para dar seguimiento a un caso -->
            <a href="seguimientoCaso.php?a=<?=$p->idatencion_psico?>" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-pen-to-square"></i><?=$espacios?>Seguimiento </p></a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <!-- Boton para notificacion -->
        <a href="#" class="btn btn-white"> <p style="color:black;"><i class="fa-regular fa-envelope"></i><?=$espacios?>Notificación </p></a>
        </div>
         <!-- Boton para Reporte -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <a href="#" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-ticket"></i><?=$espacios?>Reporte </p></a>
        </div>
         <!-- Boton para suspension -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <a href="#" class="btn btn-white"> <p style="color:black;"><i class="fa-brands fa-fantasy-flight-games"></i><?=$espacios?>Suspensión </p></a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <!-- boton para dar llamada a casa-->
            <a href="#" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-square-phone-flip"></i><?=$espacios?>Llamada </p></a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <!-- Boton para citatorio -->
        <a href="#" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-calendar-days"></i><?=$espacios?>Citatorio </p></a>
        </div>
         <!-- Boton para archivo -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <a href="#" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-file-pdf"></i><?=$espacios?>Archivo </p></a>
        </div>
         <!-- Boton para imprimir -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <a href="#" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-print"></i><?=$espacios?>Imprimir </p></a>
        </div>
       <hr>
    </div>
    <!-- termina muestra detalles de caso activo -->
    <br>
  </div>
</div>
<!-- Termina boton colapsable -->
    <?php endforeach?>
    <?php endif?>
</div><!-- FIN CENTRO -->
<!--contenedor central -->
      </div>
       
        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control">
    <!--contenedor derecha -->
contenedor derecha
    <!--contenedor derecha -->

        </div>
    </div>
</div>
   
 <script src="../../js/colapsables.js"></script>

<?php require '../complementos/footer_2.php';?>


