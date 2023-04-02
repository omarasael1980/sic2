<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/psicologia/psico.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Psicopedagogico', $_SESSION['user']->perm)){
    header("Location:../../");
}
$pendiente = cargaPendientesPsico();
$today =  date('Y-m-d');
$motivos = cargaMotivosPsico();
$viaComunicacion = cargaMotivosNotificacion();
$especialistas = buscaEspecialistas();
$categoriaCanalPsico = buscaCategoCanalPsico();
$estadisticasPsico= get_BuscaEstadisticasPsico($today);
//se cargan para mostrar las estadisticas
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
                        <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                        <a href="historialPsico.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                        
                       
          </div>
                
        </div>
        </div> 
          

    
      
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 m-0 p-0">
          <!--contenedor central -->
           <h1 class="text-center"> Casos pendientes de seguimiento.</h1>
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
        
          <button class="btn btn-primary form-control m-0 p-0"  type="button" data-bs-toggle="collapse" 
              data-bs-target="#collapse<?=$p->idatencion_psico?>" aria-expanded="false" aria-controls="collapseWidthExample">
             <!--datos del boton colapsable de casos activos  -->
              <div class="col-lg-2 col-md-2 col-sm-0 col-xs-4"> <p ><b></b> Folio: <?=" ".$p->idatencion_psico?></b></p></div>
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><p ><b>Fecha: <?=" ".$p->fecha?></b></p></div>
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><p ><b><?=$alumno?></b></p></div>
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><p ><b><?=$grupo?></b></p></div>
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><p ><b><?=$p->motivo?></b></p></div>
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
               <div class="form-check form-switch">
                  <input type="hidden" name="folio" id="folio" value="<?=$p->idatencion_psico?>">
                  <input class="form-check-input" type="checkbox" checked onChange="actualizaSeg(<?=$p->idatencion_psico?>)" id="seguimientoPsico<?=$p->idatencion_psico?>"/>

                    <label class="form-check-label" for="seguimientoPsico"><b><p>Dar seguimiento</b></p></label>
                </div>

              </div>
  </button>
</p>
<div style="">
  <div class="collapse " id="collapse<?=$p->idatencion_psico?>">
  

    
    <!-- se muestran detalles de caso activo -->
    <div class="row" style="width: 100%;">
  
        <!-- descripcion del caso pendiente -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control"><b>Descripción: <p><?=$p->descripcion?></p></b></div>
        <hr>
        <h5 class="text-center"><b> Acciones:</b></h5>
       
       
            <!-- boton para dar seguimiento a un caso -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 m-0 p-0">
            <a href="seguimientoCaso.php?id=<?=$p->idatencion_psico?>"class="btn btn-white"> <p class="m-0 p-0 " style="color:black;"><i class="fa-solid fa-pen-to-square"></i><?=$espacios?>Seguimiento </p></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 m-0 p-0">
            <!-- Boton para notificacion -->
        <a href="notificacion.php?id=<?=$p->idatencion_psico?>" class="btn btn-white"> <p class="m-0 p-0 " style="color:black;"><i class="fa-regular fa-envelope"></i><?=$espacios?>Notificación </p></a>
        </div>
          <!-- Boton para archivo -->
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 m-0 p-0">
        <a href="subirEvidenciaPsico.php?id=<?=$p->idatencion_psico?>&c=<?=$p->estudiantes_idestudiantes?>" class="btn btn-white"> <p class="m-0 p-0 " style="color:black;"><i class="fa-solid fa-file-pdf"></i><?=$espacios?>Archivo </p></a>
        </div>
         <!-- Boton para suspension -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 m-0 p-0" >
        <a href="suspension.php?id=<?=$p->idatencion_psico?>" class="btn btn-white"> <p class="m-0 p-0 " style="color:black;"><i class="fa-brands fa-fantasy-flight-games"></i><?=$espacios?>Suspensión </p></a>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 m-0 p-0">
            <!-- Boton para citatorio -->
        <a href="citatorio.php?id=<?=$p->idatencion_psico?>" class="btn btn-white"> <p class="m-0 p-0 " style="color:black;"><i class="fa-solid fa-calendar-days"></i><?=$espacios?>Citatorio </p></a>
        </div>
         <!-- Boton para canalizar -->
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 m-0 p-0" >
        <a href="canalizarPsico.php?id=<?=$p->idatencion_psico?>" class="btn btn-white"> <p class="m-0 p-0 " style="color:black;"><i class="fa-solid fa-comment-medical"></i></i><?=$espacios?>Canalizar </p></a>
        </div>
         <!-- Boton para imprimir -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 m-0 p-0">
        <a href="../imprimir/imprimirPsico.php?id=<?=$p->idatencion_psico?>" class="btn btn-white"> <p class="m-0 p-0 " style="color:black;"><i class="fa-solid fa-print"></i><?=$espacios?>Imprimir </p></a>
        </div>
       <hr>
    </div>
    <!-- termina muestra detalles de caso activo -->
   <?$actualizaciones = buscaSeguimientos($p->idatencion_psico);?>
   <?php if($actualizaciones !=""):?>
    <br>
   
    <h5 class="text-center"><b> Actualizaciones del caso:</b></h5>
   <?php foreach ($actualizaciones as $a):?>
    <?php $estActualizaciones = $estActualizaciones+1;?>
    <!-- Inicia actualizaciones -->
   <div class="row">
    <div class="form-control">
      <div class="row">
    
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6"><b><p>Título: <?="  ".$a->titulo?></b></p></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6"><b><p>Fecha:<?="  ".$a->fecha?></b></p></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b><p>Descripción:<?="  ".$a->descipcion?></b></p></div>
        
      </div>
   
      <!-- termina row dentro de form-control -->
    </div>
   </div>
   <br>
   <?php endforeach?>
   <?php endif?>
   <!-- termina actualizaciones -->
   <!-- inicia notificaciones -->
   <div class="row">
   <h5 class="text-center"><b> Notificaciones</b></h5>
    <?php 
    $notificaciones = buscarNotificaciones($p->idatencion_psico);
    ?>
   
   <?php if($notificaciones !=""):?>
  
    <?php foreach ($notificaciones as $n):?>
    
      <div class="row form-control">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><p><b>Fecha:</b><?=$n->fecha?></p></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><p><b>Vía de comunicación:</b></p> 
       
             <?php foreach($viaComunicacion as $vc){
                if($vc->idmotivo_prefectura == "$n->motivo_prefectura_idmotivo_prefectura"){
                echo $vc->motivo; 
                 }
           }?></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <p><b>Descripción:</b><?=$n->descripcion?></p>
          </div>
     
      </div>  <!-- div row -->
      <br>

      <?php endforeach?>

      <?php endif?>
   </div>
   <!-- termina notificaciones -->

    <!-- inicia seccion citatorios -->
    
    <?php $citatorios = buscaCitatorios($p->idatencion_psico);?>
  
    <?php if($citatorios !=""):?>
      <center><h5><b> Citatorios</b></h5></center>
      <?php foreach($citatorios as $c):?>
      
        <div class="row form-control">
           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><b>Folio de citatorio: </b></div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"> <?=$c->idcitatorio?> </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><b>Fecha de elaboración: </b></div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"> <?=$c->fecha?> </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><b>Vía de comunicación:</b> </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><?php 
          //se compara el idviacomunicacion  para determinar la via
       
          foreach ($motivos as $m){
            if($m->idMotivoPsico == $c->motivo_prefectura_idmotivo_prefectura){
              echo $m->motivoPsico;
            }
          }
          ?></div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><b>Fecha de cita:</b></div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><?=$c->fechaCita?></div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><b>Descripción:</b></div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12"><?=$c->descripcion?></div>
        </div>
        <br>
        <?php endforeach?>
      <?php endif?>
    <br>
   <!-- termina seccion citatorios -->
    <!-- inicia seccion suspensiones -->
  <?php $suspensiones = buscaSuspensiones($p->idatencion_psico);?>
  <?php if($suspensiones !=""):?>
  <h5 class="text-center"><b>Suspensiones:</b> </h5>
    <?php foreach($suspensiones as $s):?>
      <div class="row form-control"> <!-- inicio row -->
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <b> Folio: </b> <?=$s->atencion_psico_idatencion_psico?> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <b> Fecha de registro:</b> <?=$s->fecha?> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <b> Vía de comunicación: </b> 
      <?php foreach($viaComunicacion as $vc){
                if($vc->idmotivo_prefectura == "$s->motivo_prefectura_idmotivo_prefectura"){
                echo $vc->motivo; 
                 }
           }?> 
    </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><b>Fecha Inicial:</b> <?=$s->finicio?> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><b>Fecha Final:</b> <?=$s->ffinal?> </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Observaciones:</b> <?=$s->descripcion?> </div>
      </div>       <!-- termino row -->
      <br>
    <?php endforeach?>
    <?php endif?>
    <br>
   <!-- termina seccion suspensiones -->
   <!-- inicia  carga de canalizaciones  -->
   <div class="row  ">
  <?php $canalizaciones = buscaCanalizacionesPsico($p->idatencion_psico);?>
 
    <?php if($canalizaciones !=""):?>
        <h5 class="text-center"><b > Canalizaciones:</b></h5>   
            <?php foreach ($canalizaciones as $can):?>
         <div class="row form-control">
         <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><b>Folio</b> <?=$can->idpsico_canaliza?> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><b>Fecha Final:</b> <?=$can->fecha?> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><b>Especialista:</b> <?php
      foreach($especialistas as $e){
        if( $can->idpsico_canaliza == $e->idespecialista_canaliza){
          echo $e->especialista;
        }
      }
     ?> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><b>Categoria:</b> <?php
      foreach ($categoriaCanalPsico as $cat){
       if($can->categoria_canaliza_psico_idcategoria_canaliza_psico == $cat->idcategoria_canaliza_psico){
        echo $cat->categoria;
       } 
      }
      ?> </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Observaciones:</b> <?=$can->descripcion?> </div>

         </div>
          <?php endforeach?>
          <?php endif?>
            </div>                                        
                   
              
                      
                                                      <br>
   <!-- termina carga de canalizaciones -->
    <!--Aqui se cargan las evidencias si hay-->
  <div class="row  ">
  <?php $evidencias = buscaEvidenciasPsico($p->idatencion_psico);?>
    <?php if($evidencias !=""):?>
        <h5 class="text-center"><b > Archivos asociados:</b></h5>   
            <?php foreach ($evidencias as $ev):?>
            <div class="row form-control">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <p><b class="text-center">Nombre: </b> <?="  ".$ev->titulo.".".$ev->tipo ?></p>   
            </div>                                        
                 <?php 
                  switch($ev->tipo){
                        case "png":
                        case "jpg":
                        case "jpeg":
                            echo "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12'><center><p><b>Tipo de Archivo:</b> </center><center><i class='fa-regular fa-image'></i></center></div> ";
                            break;
                        case "mp4":
                          echo "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12'><center><p><b>Tipo de Archivo:</b></p></center><center> <i class='fa-regular fa-file-video'></i> </center> </div>";
                        case "pdf":
                            echo "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12'><center><p><b>Tipo de Archivo:</b></p></center><center> <img class='logos-enfermeria' src='../../img/icons/pdf.png'> </center> </div>";
                            
                          
                            break;
                  }
                  
                  ?>        
                <?php $nombre = explode("/",$ev->imagen);
                $nm = $nombre[count($nombre)-1]; ?>
          
                         <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                         <p class="text-center"> <b>Funciones:</b></p>
                                                        
                            <p class="text-center">  <a title="descargar" href="<?=$ev->imagen?>" download="<?=$nm?>"><i  class="fa-solid fa-download"></i><br> </p>
                            
                        
                           <p class="text-center">  <a  title="Eliminar" href="../../controlador/psicopedagogico/eliminarEvidenciaPsico.php?id=<?=$ev->idevidenciaPsico?>&&mi=<?=$id?>">
                            <img src="../../img/icons/delete.png" class="logos-enfermeria"alt=""><br> </p>
                        </div>
                                                        
                                                      
             </div> 
                                                      <br>
                                                      
                                                <?php endforeach?>
                                                
                                       
                                                <?php endif?>
          </div> <!--Aqui terminan las evidencias si hay-->

 
<!-- Termina boton colapsable -->
</div> </div>        
    <?php endforeach?>
    </div> 
    <?php endif?>
    </div> 
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control">
    <!--contenedor derecha -->
 <!-- inician postit con estadisticas -->
                             <!--Se muestran las estadisticas dias sin incidentes-->
    <div class="row m-0 p-0">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control2  postit" > 
                <h6 class="text-center">Casos en seguimiento</h6>
                               <?php
                               if($estSeguimiento<5){
                               $color = "success";
                            }else if($estSeguimiento >4 & $estSeguimiento<10){
                                $color ="warning";
                               }else {
                                $color ="danger";
                               }
                               ?>
                             <H4  class="text-center  blink <?=$color?>"><?=$estSeguimiento?></H4>
                               
                              
                            </div>
                        </div>
                        <br>
                         <!--Se muestran casos atendidos-->
    <div class="row m-0 p-0">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control2  postit" > 
                <h6 class="text-center">Casos atendidos en este ciclo</h6>
                          <h4><?=$estAtendidos?></h4>
        </div>
    </div>
                        <br>
                         <!--Se muestran casos atendidos hoy-->
    <div class="row m-0 p-0">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control2  postit" > 
                <h6 class="text-center">Casos atendidos hoy</h6>
                          <h4><?=$estHoy?></h4>
        </div>
    </div>
                        <br>
                         <!--Se muestran casos atendidos por grupo-->
    <div class="row m-0 p-0">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control2  postit" > 
                <h6 class="text-center">Casos atendidos por grupo:</h6>
                <div class="row p-0 m-0">
                                        <?php foreach ($estGrupos as $g):?>
                                            <p class="text-center p-0 m-0">
                                            <?php if($g->cantidad >0):?>
                                            <?=$g->grupo.' ('.$g->cantidad.")"?></p>
                                        <?php endif?>
                                        <?php endforeach?>
                                   </div>
                            </div>
                        </div>
                        <br>
                               <!--Se muestran casos atendidos-->
    <div class="row m-0 p-0">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control2  postit" > 
                <h6 class="text-center">Casos atendidos por categoria:</h6>
                <div class="row p-0 m-0">
                                        <?php foreach ($estCategorias as $c):?>
                                            <p class="text-center p-0 m-0">
                                            <?php if($c->cantidad >0):?>
                                            <?=$c->categoria_psico.' ('.$c->cantidad.")"?></p>
                                        <?php endif?>
                                        <?php endforeach?>
                                   </div>
                            </div>
                        </div>
                        <br>
                   
 <!-- termina el postit -->
    <!--contenedor derecha -->

        </div>
    </div>
</div>
   
 <script src="../../js/colapsables.js"></script>
 <script src="../../js/cambioSeguimiento.js"> </script>
 <script src="../../js/validacionesNuevoPsico2.js"> </script>

<!-- Modal para insertar motivo -->

<div class="modal fade" id="registroMotivo" tabindex="-1" aria-labelledby="registroMotivoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="registroMotivoLabel">Guardar nuevo motivo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="fmiMotivo" action="../../controlador/psicopedagogico/nuevoMotivo.php" method="post">
        <div class="form-group " id="grupo__miMotivo">
                            
                            <div class="form-group-input  ">
                            <label for="miMotivo" class="form-label form-control2"> <b> Motivo Nuevo:</b>
                          
                            <input type="hidden"  id= "alumnomiMotivo" name="alumno" value="0">
                            <input type="text" onkeyup="revisaMay('miMotivo')" class="form-control" id="miMotivo" name="miMotivo">
                                <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                            </div>
                            </label>
                    <div class="form-message" id="mensaje_error__miMotivo">
                        <p>Debes escribir un motivo, solo se permiten letras</p>
                    </div>
                    </div> 

      
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-6"> <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></div>
            <div class="col-6"> <input  onclick="validaMiMotivo(event)" type="submit"  id="bMotivo"class="btn btn-success" value="Guardar">
            </form>
      </div></div>
        </div>
       
       
    </div>
  </div> -->
</div>

    
 <!-- termina modal para insertar motivo-->
    
<?php require '../complementos/footer_2.php';?>