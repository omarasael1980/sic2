
<?php       
            include '../../modelo/usuarios/usuarios.php';
            require '../complementos/header_2.php';
            require '../complementos/nav_2.php';
            require_once '../../modelo/enfermeria/comunesEnfermeria.php';
            require '../../modelo/config/comunes.php';
            $id=$_GET['id'];
            $al =buscaAlumno($id);
            $espacios ="   ";
            $casos =cargarAtencionesMedicasAlumno($id);
            $especialistas = buscaEspecialista();
?>

<?php


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
                         <a href="eprincipal.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="e_nuevoCaso.php?id=<?=$al[0]->idestudiantes?>" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a>
                         <br>
                        <a class="btn-primary list-group-item text-center list-group-item-action" href="expedienteAlumno.php"><p><i class="fa-regular fa-folder"></i><?=$espacios?> Expedientes </p></a>
                     
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->

<!-- tITULO  -->
    <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
                <h1 class="text-center">Expediente Médico</h1>
                    <h4 class="text-center"><?=$al['0']->nombre." ".$al['0']->apaterno." ".$al['0']->amaterno." ".$al['0']->apaterno?></h4>
                <h6 class="text-center">Grupo <?=$al['0']->grupo?></h6>
        </div>
    </div>

    <!-- Informacion de expediente Medico  -->
    <div class="row expediente">
        <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
        <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Expediente Médico
        </button>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
         </div>
    </div>
<!-- termina expediente medico -->
        <!-- Boton para editar expediente medico  -->
        <div class="row">
             <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0">
                 <a href="editaExpediente.php?id=<?=$id?>">
                 <img class="logos-enfermeria" src="../../img/icons/edit.png" alt="editaExpediente"> </a>
             </div>
        </div>
                 <!-- Titulo ultimas atenciones medicas  -->
    <hr>
         <div class="row " >
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 principal " >
                <h1 class="text-center form-control2 "><b> Atenciones  Médicas</b></h1>   
                            </div>
        </div>
                            <!-- Cada atencion medica colapsable  -->
                            <?php if($casos!=""):?>
                            <?php foreach($casos as $c):?>
            <div class="row  ">
                    <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 caso "   >
                                <button class="row btn  btn-outline-primarygit form-control" data-bs-toggle="collapse" href="#desc<?=$c['cas']->idenfermeria?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si "> <?=$c['cas']->fecha ?>  </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si "><?=$c['cas']->categoriaMedica?>   </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 ">  <?=$c['cas']->motivo?> </div>
                                </button>    
                    
                    </div>
             </div>
            <div class="row">
                <div class="collapse" id="desc<?=$c['cas']->idenfermeria?>">
                    <div class="card card-body">
                      <!-- empieza contenido desplegable -->
                      <div class="row">
                              <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                             <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 caso "   >
                                            <div class="row  m-0 p-0">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-0 p-0">
                                                    Descripción:  <?=$espacios.$c['cas']->descripcion?>
                                                    </div> 
                                            </div>
                                    </div>
                      </div>
                      <hr>
                      <!-- aqui van las acciones -->
                    <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                    <center> <a href="seguimientoCaso.php?id=<?=$c['cas']->idenfermeria?>&c=<?=$id?>"><img class="logos-enfermeria"
                                        src="../../img/icons/plus.png" alt="otra nota">    </a> </center> <center>Actualizar Caso </center>  </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                        <center><a href="seguroEscolar.php?id=<?=$c['cas']->idenfermeria?>&c=<?=$id?>"><img class="logos-enfermeria"
                                        src="../../img/icons/ambulance.png" alt="otra nota">    </a>  </center> <center>Seguro Escolar </center> </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                        <center> <a href="subirEvidencia.php?id=<?=$c['cas']->idenfermeria?>&c=<?=$id?>"><img class="logos-enfermeria"
                                        src="../../img/icons/folder.png" alt="otra nota"></a></center> <center> Subir evidencia  </center>   </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                        <center>  <a href="canlaizacionMedica.php?id=<?=$c['cas']->idenfermeria?>&c=<?=$id?>"><img class="logos-enfermeria"
                                        src="../../img/icons/canaliza.jpg" alt="otra nota">    </a>  </center> <center>Canalizar </center> </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                        <center> <a href="../../controlador/enfermeria/borrarCasoMedico.php?id=<?=$c['cas']->idenfermeria?>&c=<?=$id?>"><img class="logos-enfermeria"
                                        src="../../img/icons/delete.png" alt="otra nota">   </a> </center> <center>Eliminar caso  </center>  </div>
                              
                    </div>
                             <!--Aqui se cargan las seguimientos si hay-->
                               
                         
                                    <?php if($c['ac']!=""):?>
                                        <div class="row"> 
                                        <hr>
                                                                         
                                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             
                                               <h5 class="text-center">Actualizaciones del caso:</h5>
                                             </div>
                                        </div>
                                 <?php foreach( $c['ac'] as $ac):?>
                                   
                                   <div class="row"> 
                                   
                                           <div class=" col-lg-10 col-md-10 col-sm-12 col-xs-12 form-control2">
                                               <div class="row">
                                                    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                      Fecha: <b> <?=$ac->fecha_ACE?></b>
                                                     </div>
                                                    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                          Título: <b> <?=$ac->titulo?></b>
                                                         </div>
                                             </div>
                                           <div class="row">
                                                <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                            Descripción: <?=$ac->descripcion?>
                                           </div>
                                         </div>

                                             </div>
                                   </div>
                                  <hr>
                                    <?php endforeach?>
                                    <?php endif?>
                                     <!--Aqui se cargan las canalizaciones si hay-->
                               
                               
                                                <?php if($c['Canalizacion']!=""):?>
                                 <div class="row">
                                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                                        <h5 class="text-center"> Canalizaciones médicas:</h5>
                                                </div>
                                                </div>
                                               
                                                <?php foreach ($c['Canalizacion'] as $can):?>
                                        <div class="row form-control">
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <p>Folio: <b><?=$can->idCanaliza_med ?></b></p>
                                                </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                     <p class="text-center">Fecha:<b><?=$can->fecha?></b></p>  
                                                    </div>
                                               <?php
                                               //en los datos la descripcion viene pegado el motivo con la descripcion 
                                               //por eso se separa  separado =- 
                                               $cadena = $can->Descripcion;
                                               $separado ="-";
                                               $separada = explode($separado,$cadena);
                                               $motivo=$separada[0];
                                               $descripcion = $separada[1];
                                               foreach($especialistas as $e){
                                                if($e->idespecialiste_medico == $can->especialiste_medico_idespecialiste_medico) {
                                                    $doctor = $e->especialista;
                                                } 
                                               }
                                             
                                               ?>
                                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6"><p> Especialista:<b><?=$doctor?></b></p>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6"><p> Motivo:<b><?=$motivo?></b></p>
                                                </div>
                                       
                                            <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    Descripción: <b><?=$descripcion?></b> 
                                                    </div>
                                            
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-2 col-sm-2 col-xs-0"> </div>
                                                <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                                                <a class="btn btn-outline-primary"href="../imprimir/canalizaMedico.php?id=<?=$id?>"><p class="text-center">Imprimir</p></a>       
                                                </div>
                                            </div>
                                        </div>
                                           
                                           
                                                
                                              
                                        <br>
                                        <?php endforeach?>
                                        <?php endif?>

                                  
                                       <!-- aqui inicia seguro  escolar-->
                                <!--Aqui se cargan los folios de gastos medicos si hay-->
                        
                            
                               <?php if($c['seguros']!=""):?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  <hr></div>
                                    <div class="row">
                                   
                                        <div class="col-lg-12col-md-12 col-sm-12 col-xs-12">
                                    
                                            <h5 class="text-center"> Hojas de Seguro Escolar:</h5> 
                                        </div> 
                                    </div>
                                        <?php foreach ($c['seguros'] as $seguro):?>
                                        <div class="row form-control">
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                    <p>Folio: <b><?=$seguro->idseguro_escolar ?></b></p>
                                                <?php $fechaSE = substr($seguro->date,0,-9);
                                                    ?>
                                                <p>Fecha:<b><?=$fechaSE?></b></p>
                                                <p>Monto:<b><?php
                                                $numero = $seguro->monto.$espacios;
                                                $valor_moneda = '$' . number_format($numero, 2, '.', ',');
                                                echo $valor_moneda; 
                                               ?></b> </p> </div>
                                                <div class="col-lg-4 col-md-2 col-sm-4 col-xs-6"></div>
                                                    <div class="col-lg-4 col-md-2 col-sm-4 col-xs-6 m-0 p-0">
                                                    <a href="../imprimir/seguroEscolar.php?f=<?=$seguro->idseguro_escolar ?>" class="nav-button-cargar"><i class="fa-solid fa-print"></i>.  Imprimir </a><br>
                                                    <a  href="actualizaMonto.php?id=<?=$seguro->idseguro_escolar?>" class="nav-button-cargar">
                                                    <i class="fa-solid fa-circle-dollar-to-slot"></i>.   Actualizar Monto</a>   
                                                </div>
                                        </div>
                                            <br class="m-0 p-0">
                                            <?php endforeach?>
                                            
                                            <?php endif?>
                                          
                                 <!--Aqui se cargan las evidencias si hay-->
                                 <?php if($c['ev']!=""):?>
                                 <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  <hr></div>
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                   <h5 class="text-center">Archivos asociados:</h5>
                                            </div>
                                 </div>
                                                <?php foreach ($c['ev'] as $ev):?>
                                 <div class="row form-control">
                                      <p><b> Nombre:  <?=$ev->titulo ?></b></p>
                                                        
                                            <?php 
                                            switch($ev->tipo){
                                                case "png":
                                                case "jpg":
                                                case "jpeg":
                                                    echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'><p><b>Imagen: </div>
                                                    <div class='col-lg-2 col-md-3 col-sm-6 col-xs-6'><img class='logos-enfermeria' src='".$ev->imagen."'></b></p></div>
                                                    ";
                                                    break;
                                                case "mp4":

                                                    echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'><p><b>Archivo PDF:</b></p> </div>
                                                    <div class='col-lg-2 col-md-3 col-sm-6 col-xs-6'><img class='logos-enfermeria' src='../../img/icons/video.png'>  </div>";
                                                    break;
                                                case "pdf":
                                                    echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'><p><b>Archivo PDF:</b></p>  </div>
                                                    <div class='col-lg-2 col-md-3 col-sm-6 col-xs-6'><img class='logos-enfermeria' src='../../img/icons/pdf.png'>  </div>";
                                                    
                                                    break;
                                            }
                                            
                                            ?>
                                                      
                                                      <?php $nombre = explode("/",$ev->imagen);
                                                      $nm = $nombre[count($nombre)-1]; ?>
                                                
                                                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                                            <div class="row">
                                                        <p class="text-center m-0 p-0"> <a href="<?=$ev->imagen?>" download="<?=$nm?>"><img src="../../img/icons/download.png" class="logos-enfermeria"alt=""><br> </p>
                                                        <p class="text-center m-0 p-0">Descargar</p>
                                                         </a>
                                                       </div>
                                                      </div>
                                                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                                            <div class="row">
                                                        <p class="text-center m-0 p-0"> <a href="../../controlador/enfermeria/eliminarEvidenciaMedica.php?id=<?=$ev->idEvidenciaMedica?>&&mi=<?=$id?>">><img src="../../img/icons/delete.png" class="logos-enfermeria"alt=""><br> </p>
                                                        <p class="text-center m-0 p-0">Descargar</p>
                                                         </a>
                                                       </div>
                                                      </div>
                                                      
                                                      
                                                        
                                                      
                                                      </div> 
                                                      <br>
                                                     
                                                     
                                                <?php endforeach?>
                                <?php endif?>
                              
                                   <!-- termina archivos -->
                                   
                                </div>  <!-- termina contenido desplegable -->
                             
                              
                     
                  
            </div> </div>
           
            <?php endforeach; ?>
            <?php endif;?>
            <!--contenedor central -->
            
            
     <!-- FIN CENTRO -->                       </div>

<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->
                 <!--Mostrar estadisticas --> 
             


                     
    <!--contenedor derecha -->

       
    </div>
</div>
<!--  modal monto-->



 
<script src="../../js/colapsables.js"></script>

<?php require '../complementos/footer_2.php';?>