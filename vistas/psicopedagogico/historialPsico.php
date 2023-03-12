
<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/psicologia/psico.php';
require '../../modelo/config/comunes.php';
$motivos = cargaMotivosPsico();
$viaComunicacion = cargaMotivosNotificacion();
$especialistas = buscaEspecialistas();
$categoriaCanalPsico = buscaCategoCanalPsico();
$today =  date('Y-m-d');
if(isset($_GET['id']) ){
    
  $idalget = buscaAlumno($_GET['id']);
  $alumno = $idalget[0]->nombre." ".$idalget[0]->apaterno." ".$idalget[0]->amaterno;
  $grupo = $idalget[0]->grupo;
  $idal = $idalget[0]->idestudiantes;
  $casosEncontrados = buscaCasosPisoXAlumno($idal);

  $caso = buscaCasoPsico($_GET['id']);
  
  }
  
  if(isset($_POST["alumno"])){
   
   $a = $_POST["alumno"];
   if(strpos($a, '/') == false){
  //si no contiene / no existe en la base de datos y redirige a la misma pagina pero sin post
  header("Location:./pprincipal.php");
   }else{
      //si existe / entonces existe en la base de datos y carga los datos
   $al = explode("/",$a);
   $alumno = $al[0]." ".$al[1]." ".$al[2];
   $grupo =$al[3];
   $idal= $al[4];
   $casosEncontrados = buscaCasosPisoXAlumno($idal);
 
   
   $caso = buscaCasoPsico($idal);
   }}



  


if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}


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
                         <a href="pprincipal.php" class=" btn list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-bars"> </i> <?=$espacios?>Pendientes</p>  </a>
                        <a class="list-group-item text-center list-group-item-action" href="psicoNuevoCaso.php"><p><i class="fa-solid fa-file-circle-plus"></i><?=$espacios?> Nuevo caso </p></a>
                        <a href="historialPsico.php" class=" btn-primary  list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                        <a href="#" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                        <a href="#" class="list-group-item text-center  list-group-item-action"><p><i class="fa-solid fa-route"></i><?=$espacios?>Canalizaciones</p> </a>
                </div>
                
            </div>

            </div>
      
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-control">
<!--contenedor central -->
<!-- inicia -->
 <!-- filtrado de alumnos -->
 <h1 class="text-center">Historial de alumno</h1>
<div class="row">
    <div class="container">
        <div class="row">
            <!--Seleccionar alumno 
        Si en no se conboce el alumno no se muestra-->
        <?php if(!isset($alumno)):?>  
        <form action="historialPsico.php"  class="" method="post" autocomplete="off">
               
                <div class="col-lg-4 col-md-1 col-sm-2 col-xs-2"><label for="alumno" class="form-control2"><center><b> Buscar Alumno:</b></center></label></div>
                <div class="col-lg-8 col-md-4 col-sm-6 col-xs-10">
                    
                
                   
                            <input type="text" required class="form-control"name="alumno" id="alumno">

                        <ul id="lista">
                        
                             </ul>
                  
                  </div>
               
                  <div class="col-lg-5 col-md-5 col-sm-4 col-xs-2"></div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-8">
                        <button class="form-control btn btn-success">Cargar Expediente</button>
                     
                  </div>
               
          </form>
          </div> 
            </div> 
            </div> 
          <?php else:?>

            <div class="col-lg-5 col-md-3 col-sm-1 col-xs-0"></div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <a class="btn btn-info"href="historialPsico.php"><i class="fa-solid fa-door-closed"></i><?=" "?>Cerrar</a>
                  </div>
            
      <!-- termina filtrado -->
<div class="row">
  
            <!-- INICIO CENTRO -->
          <?php if($casosEncontrados != ""): //si existen casos?> 
           <!-- se llaman datos del alumno -->
            <?php if($casosEncontrados !=null){
          //busca datos del estudiante
           $idalget = buscaAlumno($casosEncontrados[0]->estudiantes_idestudiantes); //carga al alumno
             //se prepara para juntar el nombre
          $alumno = $idalget[0]->nombre." ".$idalget[0]->apaterno." ".$idalget[0]->amaterno;
          $grupo = $idalget[0]->grupo;

           }?>
             <div class="col-12"> <h3 class="text-center"><b> <?=$alumno?></b></h3></div>
             <div class="col-12"> <h3 class="text-center"><b> <?=$grupo?></b></h3></div>
            <?php foreach($casosEncontrados as $ce):?>
              
            
              <!-- seguimiento de casos -->
 
           <!-- inicia boton colapsable -->
           <p>
      
          <button class="btn btn-primary form-control"   type="button" data-bs-toggle="collapse" 
              data-bs-target="#collapse<?=$ce->idatencion_psico?>" aria-expanded="false" aria-controls="collapseWidthExample">
             <!--datos del boton colapsable de casos activos  -->
              <div class="col-lg-3 col-md-2 col-sm-0 col-xs-4">Folio: <?=" ".$ce->idatencion_psico?></div>
              <div class="col-lg-3 col-md-2 col-sm-3 col-xs-4">Fecha: <?=" ".$ce->fecha?></div>
             <div class="col-lg-3 col-md-2 col-sm-3 col-xs-4"><?=$ce->motivo?></div>
              <div class="col-lg-3 col-md-2 col-sm-3 col-xs-4">
               <div class="form-check form-switch">
                  <input type="hidden" name="folio" id="folio" value="<?=$ce->idatencion_psico?>">
                  <input class="form-check-input" type="checkbox" <?php 
                  if($ce->darSeguimiento == 1){ echo "checked";}
                  ?> onChange="actualizaSeg(<?=$ce->idatencion_psico?>)" id="seguimientoPsico<?=$ce->idatencion_psico?>"/>

                    <label class="form-check-label" for="seguimientoPsico">Dar seguimiento</label>
                </div>

              </div>
  </button>
</p>
<div style="">
  <div class="collapse " id="collapse<?=$ce->idatencion_psico?>">
  

    
    <!-- se muestran detalles de caso activo -->
    <div class="row" style="width: 100%;">
  
        <!-- descripcion del caso pendiente -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control"><b>Descripción:</b> <?=$ce->descripcion?></div>
        <hr>
        <h5 class="text-center"><b> Acciones:</b></h5> 
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
       
            <!-- boton para dar seguimiento a un caso -->
           

            <a href="seguimientoCaso.php?id=<?=$ce->idatencion_psico?>"class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-pen-to-square"></i><?=$espacios?>Seguimiento </p></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <!-- Boton para notificacion -->
        <a href="notificacion.php?id=<?=$ce->idatencion_psico?>" class="btn btn-white"> <p style="color:black;"><i class="fa-regular fa-envelope"></i><?=$espacios?>Notificación </p></a>
        </div>
          <!-- Boton para archivo -->
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <a href="subirEvidenciaPsico.php?id=<?=$ce->idatencion_psico?>&c=<?=$ce->estudiantes_idestudiantes?>" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-file-pdf"></i><?=$espacios?>Archivo </p></a>
        </div>
         <!-- Boton para suspension -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <a href="suspension.php?id=<?=$ce->idatencion_psico?>" class="btn btn-white"> <p style="color:black;"><i class="fa-brands fa-fantasy-flight-games"></i><?=$espacios?>Suspensión </p></a>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <!-- Boton para citatorio -->
        <a href="citatorio.php?id=<?=$ce->idatencion_psico?>" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-calendar-days"></i><?=$espacios?>Citatorio </p></a>
        </div>
         <!-- Boton para canalizar -->
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <a href="canalizarPsico.php?id=<?=$ce->idatencion_psico?>" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-comment-medical"></i></i><?=$espacios?>Canalizar </p></a>
        </div>
         <!-- Boton para imprimir -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <a href="../imprimir/imprimirPsico.php?id=<?=$ce->idatencion_psico?>" class="btn btn-white"> <p style="color:black;"><i class="fa-solid fa-print"></i><?=$espacios?>Imprimir </p></a>
        </div>
       <hr>
    </div>
    <!-- termina muestra detalles de caso activo -->
   <?$actualizaciones = buscaSeguimientos($ce->idatencion_psico);?>
   <?php if($actualizaciones !=""):?>
    <br>
    <h5 class="text-center"><b> Actualizaciones del caso:</b></h5> 
   <?php foreach ($actualizaciones as $a):?>
    <!-- Inicia actualizaciones -->
   <div class="row">
    <div class="form-control">
      <div class="row">
    
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">Título: <?="  ".$a->titulo?></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">Fecha:<?="  ".$a->fecha?></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Descripción:<?="  ".$a->descipcion?></div>
        
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
  
    <?php 
    $notificaciones = buscarNotificaciones($ce->idatencion_psico);
    ?>
   
   <?php if($notificaciones !=""):?>
    <h5 class="text-center"><b> Notificaciones</b></h5>
    <?php foreach ($notificaciones as $n):?>
      <div class="row form-control">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><b>Fecha:</b><?=$n->fecha?></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><b>Vía de comunicación:</b> 
       
             <?php foreach($viaComunicacion as $vc){
                if($vc->idmotivo_prefectura == "$n->motivo_prefectura_idmotivo_prefectura"){
                echo $vc->motivo; 
                 }
           }?></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <b>Descripción:</b><?=$n->descripcion?>
          </div>
     
      </div>  <!-- div row -->
      <br>

      <?php endforeach?>

      <?php endif?>
   </div>
   <!-- termina notificaciones -->

    <!-- inicia seccion citatorios -->
    
    <?php $citatorios = buscaCitatorios($ce->idatencion_psico);?>
  
    <?php if($citatorios !=""):?>
      <h5 class="text-center"><b> Citatorios</b></h5> 
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
  <?php $suspensiones = buscaSuspensiones($ce->idatencion_psico);?>
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
  <?php $canalizaciones = buscaCanalizacionesPsico($ce->idatencion_psico);?>
 
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
  <?php $evidencias = buscaEvidenciasPsico($ce->idatencion_psico);?>
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
</div> 
</div>        
    <?php endforeach?>
    </div> 
    <?php endif?>
    </div> 
              <!-- termina casos -->
              <?php //endforeach?>
            <?php endif?>
          
            <?php //endif?>
                <!-- se llaman datos del alumno -->
                  
               
  
 
   
<!-- termina -->
<!--contenedor central -->
      
       
        
       
    </div>
</div>
   
 <script src="../../js/colapsables.js"></script>
 <script src="../../js/cambioSeguimiento.js"> </script>
 <script src="../../js/peticiones.js">        </script> 

<?php require '../complementos/footer_2.php';?>


