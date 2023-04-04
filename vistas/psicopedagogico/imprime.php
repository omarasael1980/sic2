
<?php
    include '../../modelo/usuarios/usuarios.php';
    require '../complementos/header_2.php';
    require '../complementos/nav_2.php';
    require_once '../../modelo/psicologia/psico.php';
    require '../../modelo/config/comunes.php';
    
    
    if(!isset($_SESSION['user']) || !in_array('Psicopedagogico', $_SESSION['user']->perm)){
        header("Location:../../");
    }
    
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
    $hoy = date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
    $motivos = cargaMotivosPsico();
    $viaComunicacion = cargaMotivosNotificacion();
    $especialistas = buscaEspecialistas();
    $categoriaCanalPsico = buscaCategoCanalPsico();
    $id= $_GET['id'];
    $caso = buscaCasoPsico($id);
    $fechaCaso = strtotime($caso[0]->fecha);
    
    $diaCaso = date("d", $fechaCaso);
    $mesCaso = date("m", $fechaCaso);
    $anioCaso = date("Y", $fechaCaso);
    $mesCasoLetra = $meses[$mesCaso-1];
    $alumno = buscaAlumno($caso[0]->estudiantes_idestudiantes);
    $seguimiento = buscaSeguimientos($id);
    $notificaciones = buscarNotificaciones($id);
    $citatorios = buscaCitatorios($id);
    $suspensiones= buscaSuspensiones($id);
    $canalizaciones= buscaCanalizacionesPsico($id);
    $evidencias =buscaEvidenciasPsico($id);

?>


<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 form-control2">
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
                         <a href="pprincipal.php" class="list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-bars"> </i> <?=$espacios?>Pendientes</p>  </a>

                      <br>  <a class="list-group-item text-center list-group-item-action" href="psicoNuevoCaso.php"><p><i class="fa-solid fa-file-circle-plus"></i><?=$espacios?> Nuevo caso </p></a>
                       <br> <a href="historialPsico.php?id=<?=$al?>" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                       <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                       <br> <a href="imprime.pgp?id=<?=$id?>" class="btn btn-primary list-group-item text-center  list-group-item-action"><p><i class="fa-solid fa-route"></i><?=$espacios?>Imprimir</p> </a>
                </div>
                
            </div>

     </div>
      
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-control2">
<!--contenedor central -->
<!-- inicia impresion -->
<div class="container "id="cuerpoImpresion" >
    <!-- logo -->
        <div class="row">
            <p class="text-center">
                <img src="http://<?=$_SERVER['HTTP_HOST']?>/img/empresarial/logoMembrete.png" height="120 px" alt="Logo">
            </p>
        </div>
<!-- fecha -->
    <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <h6 class="text-right">Mexicali, B.C. a <?=$hoy?></h6>  
            </div>
    </div>
        <div class="row">
            <h6><b> Detalle de acciones del caso <?=$id?>:</b></h6>
              <br>
            <p class="documento">El día <b><?=$diaCaso." de ".$mesCasoLetra." de ".$anioCaso?> </b>se atendió un caso de <b> <?= $caso[0]->motivo?></b>, que a continuación se detalla: </p>
            <p class="documento">Alumn@: <b><?=$alumno[0]->nombre." ".$alumno[0]->apaterno." ".$alumno[0]->amaterno?></b> </p>
            <p class="documento">Grupo: <b><?=$alumno[0]->grupo?></b></p>
            <p class="documento">Información inicial: <b><?=$caso[0]->descripcion?></b></p>
            
        </div>
        <?php if($seguimiento !=""):?>
            <!-- impresion de seguimientos -->
        <div class="row">
          <h6 class="text-center encabezado"><b>Seguimientos:</b></h6>
          
          <?php foreach ($seguimiento as $s):?>
            <p class="documento">Fecha: <b><?=$s->fecha?></b></p>
            <p class="documento">Motivo: <b><?=$s->titulo?></b></p>
            <p class="documento">Descripción: <b><?=$s->descipcion?></b></p>
            <hr class="m-0 p-0">
            <?php endforeach?>       
        </div>
        <?php endif?>
        <?php if($notificaciones !=""):?>
            <!-- impresion de notificaciones -->
        <div class="row">
          <h6 class="text-center encabezado"><b>Notificaciones:</b></h6>
          
          <?php foreach ($notificaciones as $n):?>
            <p class="documento">Fecha: <b><?=$n->fecha?></b></p>
            <!-- motivo_prefectura es  la via de comunicacion -->
            <p class="documento ">Vía de comunicación: <b><?php
            foreach($viaComunicacion as $via){
                if($via->idmotivo_prefectura == $n->motivo_prefectura_idmotivo_prefectura){
                    echo $via->motivo;
                }
            }
            ?></b></p>
            <p class="documento">Descripción: <b><?=$n->descripcion?></b></p>
            <hr class="m-0 p-0">
            <?php endforeach?>       
        </div>
        <?php endif?>
        <?php if($evidencias !=""):?>
            <!-- impresion de archivos -->
        <div class="row">
          <h6 class="text-center encabezado"><b>Archivos adjuntados al sistema:</b></h6>
          
          <?php foreach ($evidencias as $ev):?>
            <p class="col-lg-6 col-md-6 col-sm-6 col-xs-12 documento">Título de archivo: <b><?=$ev->titulo?></b></p>
            <!-- motivo_prefectura es  la via de comunicacion -->
            
            <p class="col-lg-6 col-md-6 col-sm-6 col-xs-12 documento">Tipo de archivo: <b><?=$ev->tipo?></b></p>
            <hr class="m-0 p-0">
            <?php endforeach?>       
        </div>
        <?php endif?>
        <?php if($suspensiones !=""):?>
            <!-- impresion de suspensiones -->
        <div class="row">
          <h6 class="text-center encabezado"><b>Suspensiones:</b></h6>
          
          <?php foreach ($suspensiones as $sus):?>
            <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 documento">Fecha de atención <b><?=$sus->fecha?></b></p>
            <!-- motivo_prefectura es  la via de comunicacion -->
            <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12 documento">Vía de atención: <b><?php
               foreach($viaComunicacion as $via){
                if($via->idmotivo_prefectura == $sus->motivo_prefectura_idmotivo_prefectura){
                    echo $via->motivo;
                }
            }
            ?></b></p>
            <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12 documento">Desde: <b><?=$sus->finicio?></b></p>
            <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12 documento">hasta: <b><?=$sus->finicio?></b></p>
            <p class=" documento">Descripción: <b><?=$sus->descripcion?></b></p>
            <hr class="m-0 p-0">
            <?php endforeach?>       
        </div>
        <?php endif?>
        <?php if($citatorios !=""):?>
            <!-- impresion de citatorios -->
        <div class="row">
          <h6 class="text-center encabezado"><b>Citatorios:</b></h6>
          
          <?php foreach ($citatorios as $cit):?>
            <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12 documento">Fecha de atención <b><?=$cit->fecha?></b></p>
            <!-- motivo_prefectura es  la via de comunicacion -->
            <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12 documento">Vía de atención: <b><?php
               foreach($viaComunicacion as $via){
                if($via->idmotivo_prefectura == $cit->motivo_prefectura_idmotivo_prefectura){
                    echo $via->motivo;
                }
            }
            ?></b></p>
            <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12 documento">Cita: <b><?=$cit->fechaCita?></b></p>
            <p class=" documento">Descripción: <b><?=$cit->descripcion?></b></p>
            <hr class="m-0 p-0">
            <?php endforeach?>       
        </div>
        <?php endif?>
        <?php if($canalizaciones !=""):?>
            <!-- impresion de citatorios -->
        <div class="row">
          <h6 class="text-center encabezado"><b>Canalizaciones:</b></h6>
          
          <?php foreach ($canalizaciones as $can):?>
            <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12 documento">Fecha de atención <b><?=$can->fecha?></b></p>
            <!-- motivo_prefectura es  la via de comunicacion -->
           
            <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12 documento">Especialista: <b><?php
           foreach ($especialistas as $esp){
           if( $esp->idespecialista_canaliza == $can->especialista_canaliza_idespecialista_canaliza){
           echo $esp->especialista;
           }
           }
            ?></b></p>
            <p class=" documento">Descripción: <b><?=$can->descripcion?></b></p>
            <hr class="m-0 p-0">
            <?php endforeach?>       
        </div>
        <?php endif?>
        
    <!-- termina el encabezado -->
    <div class="row">
    <br><br> <br>
                        <p class="text-center">
                        <img src="http://<?=$_SERVER['HTTP_HOST']?>/img/empresarial/firmaEnfermeria.png" height="120 px" alt="Logo">
                        </p>
                    </div>
                  
   </div>
   
    </div>   
   
    <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-3 col-xs-0"></div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <button class="nav-button-cargar" id="imprimirCasoPsico">Imprimir</button>
                </div>
            
            </div>
            <!--contenedor central -->
        
          
            

<!-- termina impresion -->

</div><!-- FIN CENTRO -->
<!--contenedor central -->
    
        
        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->

    <!--contenedor derecha -->

        </div>
    </div>
</div>
   

       
       
    </div>
  </div>
</div>
<script src="../../js/imprimeCasoPsico.js"></script>
<?php require '../complementos/footer_2.php';?>


