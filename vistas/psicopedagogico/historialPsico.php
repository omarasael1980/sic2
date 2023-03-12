
<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/psicologia/psico.php';
require '../../modelo/config/comunes.php';
$motivos = cargaMotivosPsico();
$viaComunicacion = cargaMotivosNotificacion();
$today =  date('Y-m-d');
$caso = buscaCasoPsico($_GET['id']);

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
<!-- inicia -->
<div class="row"></div>
<div class="col-lg-2 "></div>
<div class="col-lg-8 ">
        <div class="row form-control"> <!-- INICIO CENTRO -->
       
        <div class="col-12"> <h5 class="text-center"><b> Caso inicial </b></h5></div>
            <!-- se llaman datos del alumno -->
           <?php 
          //busca datos del estudiante
           $idalget = buscaAlumno($caso[0]->estudiantes_idestudiantes); //carga al alumno
             //se prepara para juntar el nombre
          $alumno = $idalget[0]->nombre." ".$idalget[0]->apaterno." ".$idalget[0]->amaterno;
          $grupo = $idalget[0]->grupo;

           ?>
              <div class="col-lg-4 "> <b>Folio:</b>  <?=" ".$caso[0]->idatencion_psico?></div>
              <div class="col-lg-4 "><b>Nombre:</b> <?=$alumno?></div>
              <div class="col-lg-4 "> <b>Fecha: </b><?=" ".$caso[0]->fecha?></div>
            
              <div class="col-lg-4"><b>Grupo: </b> <?=$grupo?></div>
              <div class="col-lg-4"><b>Motivo: </b> <?=$caso[0]->motivo?></div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "><b>Descripción:</b> <?=$caso[0]->descripcion?></div>
</div>
          
       
     
    <!-- termina muestra detalles de caso activo -->
   <?$actualizaciones = buscaSeguimientos($caso[0]->idatencion_psico);?>
   <?php if($actualizaciones !=""):?>
    <br>

  <h5 class="text-center"><b> Actualizaciones del caso:</b></h5>
   <?php foreach ($actualizaciones as $a):?>
    <!-- Inicia actualizaciones -->
   <div class="row">
  
        <div class="col-lg-12 "> <b>Fecha:</b><?="  ".$a->fecha?></div>
        <div class="col-lg-12"><b>Título:</b> <?="  ".$a->titulo?></div>
        <div class="col-lg-12"><b>Descripción:</b><?="  ".$a->descipcion?></div>
        
      </div>
   
      <!-- termina row dentro de form-control -->
   
   <br>
   <?php endforeach?>
   <?php endif?>
   <!-- termina actualizaciones -->
   <!-- inicia notificaciones -->
   <div class="row">

    <?php 
    $notificaciones = buscarNotificaciones($caso[0]->idatencion_psico);
    ?>
   
   <?php if($notificaciones !=""):?>
    <hr>
   <h5 class="text-center"><b> Notificaciones</b></h5>
    <?php foreach ($notificaciones as $n):?>
      <div class="row ">
          <div class="col-lg-12 "><b>Fecha:</b><?=$n->fecha?></div>
          <div class="col-lg-12 "><b>Vía de comunicación:</b> 
       
             <?php foreach($viaComunicacion as $vc){
                if($vc->idmotivo_prefectura == "$n->motivo_prefectura_idmotivo_prefectura"){
                echo $vc->motivo; 
                 }
           }?></div>
        <div class="col-lg-12 ">
          <b>Descripción:</b><?=$n->descripcion?>
          </div>
     
      </div>  <!-- div row -->
      <br>

      <?php endforeach?>

      <?php endif?>
   </div>
   <!-- termina notificaciones -->

    <!-- inicia seccion citatorios -->
    
    <?php $citatorios = buscaCitatorios($caso[0]->idatencion_psico);?>
 
    <?php if($citatorios !=""):?>
      <hr>
      <h5 class="text-center"><b> Citatorios</b></h5>
      <?php foreach($citatorios as $c):?>
      
        <div class="row ">
           <div class="col-lg-3 "><b>Folio de citatorio: </b></div>
          <div class="col-lg-9 "> <?=$c->idcitatorio?> </div>
          <div class="col-lg-3 "><b>Fecha de elaboración: </b></div>
          <div class="col-lg-9 "> <?=$c->fecha?> </div>
          <div class="col-lg-3 "><b>Vía de comunicación:</b> </div>
          <div class="col-lg-9 "><?php 
          //se compara el idviacomunicacion  para determinar la via
       
          foreach ($motivos as $m){
            if($m->idMotivoPsico == $c->motivo_prefectura_idmotivo_prefectura){
              echo $m->motivoPsico;
            }
          }
          ?></div>
          <div class="col-lg-3 "><b>Fecha de cita:</b></div>
          <div class="col-lg-9 "><?=$c->fechaCita?></div>
          <div class="col-lg-3 "><b>Descripción:</b></div>
          <div class="col-lg-9 "><?=$c->descripcion?></div>
        </div>
        <br>
        <?php endforeach?>
      <?php endif?>
    <br>
   <!-- termina seccion citatorios -->
    <!-- inicia seccion suspensiones -->
  <?php $suspensiones = buscaSuspensiones($caso[0]->idatencion_psico);?>
  <?php if($suspensiones !=""):?>
    <hr>
  <b><h5 class="text-center">Suspensiones:</h5></b> 
 
    <?php foreach($suspensiones as $s):?>
      <div class="row "> <!-- inicio row -->
      <div class="col-lg-12"> <b> Folio: </b> <?=$s->atencion_psico_idatencion_psico?> </div>
      <div class="col-lg-!2"> <b> Fecha de registro:</b> <?=$s->fecha?> </div>
      <div class="col-lg-12"> <b> Vía de comunicación: </b> 
      <?php foreach($viaComunicacion as $vc){
                if($vc->idmotivo_prefectura == "$s->motivo_prefectura_idmotivo_prefectura"){
                echo $vc->motivo; 
                 }
           }?> 
    </div>
      <div class="col-lg-12 "><b>Fecha Inicial:</b> <?=$s->finicio?> </div>
      <div class="col-lg-12 "><b>Fecha Final:</b> <?=$s->ffinal?> </div>
      <div class="col-lg-12 "><b>Observaciones:</b> <?=$s->descripcion?> </div>
      </div>       <!-- termino row -->
      <br>
    <?php endforeach?>
    <?php endif?>
    <br>
   <!-- termina seccion suspensiones -->
    <!--Aqui se cargan las evidencias si hay-->  
    </div> 
<!-- termina -->
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


