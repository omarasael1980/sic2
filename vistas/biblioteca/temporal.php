

<?php       
            include '../../modelo/usuarios/usuarios.php';
            require '../complementos/header_2.php';
            require '../complementos/nav_2.php';
            require_once '../../modelo/enfermeria/comunesEnfermeria.php';
            require '../../modelo/config/comunes.php';
            $id=$_GET['id'];
            $al =buscaAlumno($id);
           
            $casos =cargarAtencionesMedicasAlumno($id);
?>
<?php


if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
?>

  
<!-- body  -->
<!-- tITULO  -->
<div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
        <center><h1>Expediente Médico</h1></center>
        <center><h1><?=$al['0']->nombre." ".$al['0']->apaterno." ".$al['0']->amaterno." ".$al['0']->apaterno?></h1></center>
       <center><h2>Grupo <?=$al['0']->grupo?></h2></center>
        </div>
</div>
    <!-- Nuevo incidente  -->
<div class="row">
        <center><a href="e_nuevoCaso.php?id=<?=$al[0]->idestudiantes?>"><H4>Nuevo Incidente </H4> 
        <img class="logos-enfermeria" src="../../img/icons/plus.png" alt="altaNuevoCasoMedico"> </a></a></center>
</div>
    <!-- Informacion de expediente Medico  -->
    <div class="row expediente">
        <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Expediente Médico
        </button>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
  <div class="card card-body">
    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
  </div>
</div>
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
            <div class="form-group"> 
                    <!-- pendiente trabajar con expediente medico  en espera de los formatos de la empresa-->
                         <!-- pendiente trabajar con expediente medico  en espera de los formatos de la empresa-->
               
            </div> 
        </div>
        <!-- Boton para editar expediente medico  -->
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0">
        <a href="editaExpediente.php?id=<?=$id?>">
        <img class="logos-enfermeria" src="../../img/icons/edit.png" alt="editaExpediente"> </a>
        </div>
    </div>
    <!-- ultimas atenciones medicas  -->
    <div class="row " >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 principal " >
                                <center><h2 class="form-control btn-primary">Atenciones  Médicas</h2></center>   
                            </div>
                            <!-- Cada atencion medica colapsable  -->
                            <?php if($casos!=""):?>
                            <?php foreach($casos as $c):?>
            <div class="row  ">
                    <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 caso "   >
                                <button class="row   btn-gray  form-control" onclick="ocultar(<?=$c['cas']->idenfermeria?>)">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si "> <?=$c['cas']->fecha ?>  </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si "><?=$c['cas']->categoriaMedica?>   </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 ">  <?=$c['cas']->motivo?> </div>
                                </button>    
                    
            </div>
            

                        <div class="row  desaparece desc<?=$c['cas']->idenfermeria?>" id="<?=$c['cas']->idenfermeria?>">
                                <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                            
                                <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                        <div class="row form-control">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <Label>Descripción: </Label>
                                                </div>  
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <?=$c['cas']->descripcion?>
                                                </div>  
                                    
                                        </div>

                                </div>
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
                               
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">  <hr></div>
                                    <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                  
                                        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                                      
                                        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                        
                                          <center><h3>Actualizaciones del caso:</h3></center>
                                        </div>
                                </div>
                                    <?php if($c['ac']!=""):?>
                                 <?php foreach( $c['ac'] as $ac):?>
                                   <div class="row"> 
                                   <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                                   <div class=" col-lg-8 col-md-10 col-sm-12 col-xs-12 form-control">
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
                                   <br>
                                    <?php endforeach?>
                                    <?php endif?>
                                <!--Aqui se cargan las canalizaciones si hay-->\
                                <div class="row">
                                            <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">  <hr></div>
                                            <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                            <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                                    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                
                                        <center><h3> Canalizaciones médicas:</h3></center>
                                                <?php if($c['Canalizacion']!=""):?>
                                                <?php foreach ($c['Canalizacion'] as $can):?>
                                        <div class="row form-control">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                <p>Folio: <b><?=$can->idCanaliza_med ?></b></p>
                                                </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                    <center> <p>Fecha:<b><?=$can->fecha?></b></p>  </center>
                                                    </div>
                                               <?php
                                               $cadena = $can->Descripcion;
                                               $separado ="-";
                                               $separada = explode($separado,$cadena);
                                               $motivo=$separada[0];
                                               $descripcion = $separada[1];
                                               ?>
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-6"> Motivo:<b><?=$motivo?></b>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    Descripción: <b><?=$descripcion?></b> 
                                                    </div>
                                            
                                                </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-2 col-sm-2 col-xs-0"> </div>
                                                <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                                                <button class="form-control btn btn-primary"><center>Imprimir</center></button>        
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <br>
                                        <?php endforeach?>
                                        <?php endif?>
                                </div>
                               
                                 <!--Aqui se cargan los folios de gastos medicos si hay-->
                             <div class="row">
                                     <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">  <hr></div>
                                    <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                     <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                                 <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                
                                         <center><h3> Hojas de Seguro Escolar:</h3></center>
                                        <?php if($c['seguros']!=""):?>
                                        <?php foreach ($c['seguros'] as $seguro):?>
                                        <div class="row form-control">
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                    <p>Folio: <b><?=$seguro->idseguro_escolar ?></b></p>
                                                <?php $fechaSE = substr($seguro->date,0,-9);
                                                    ?>
                                                <p>Fecha:<b><?=$fechaSE?></b></p> </div>
                                                <div class="col-lg-4 col-md-2 col-sm-4 col-xs-6"></div>
                                                    <div class="col-lg-4 col-md-2 col-sm-4 col-xs-6">
                                                    <a href="" class="btn btn-primary form-control">Imprimir</a>
                                                    </div>
                                                </div>
                                            <br>
                                            <?php endforeach?>
                                            <?php endif?>
                                            </div>
                                        </div>
                                  <!--Aqui se cargan las evidencias si hay-->
                                <div class="row">
                                         <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                         <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">  <hr></div>
                                            <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                                         <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                                        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                
                                                <center><h3>Archivos asociados:</h3></center>
                                                <?php if($c['ev']!=""):?>
                                                <?php foreach ($c['ev'] as $ev):?>
                                                <div class="row form-control">
                                                        <p>Nombre:<b>  <?=$ev->titulo ?></b></p>
                                                        
                                                      <?php 
                                                      switch($ev->tipo){
                                                            case "png":
                                                            case "jpg":
                                                            case "jpeg":
                                                                echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'><p>Imagen: </div>
                                                                <div class='col-lg-2 col-md-3 col-sm-6 col-xs-6'><img class='logos-enfermeria' src='".$ev->imagen."'></p></div>
                                                                ";
                                                                break;
                                                            case "mp4":

                                                                echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'><p>Archivo PDF:</p>  </div>
                                                                <div class='col-lg-2 col-md-3 col-sm-6 col-xs-6'><img class='logos-enfermeria' src='../../img/icons/video.png'>  </div>";
                                                                break;
                                                            case "pdf":
                                                                echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'><p>Archivo PDF:</p>  </div>
                                                                <div class='col-lg-2 col-md-3 col-sm-6 col-xs-6'><img class='logos-enfermeria' src='../../img/icons/pdf.png'>  </div>";
                                                              
                                                                break;
                                                      }
                                                      
                                                      ?>
                                                      
                                                      <?php $nombre = explode("/",$ev->imagen);
                                                      $nm = $nombre[count($nombre)-1]; ?>
                                                
                                                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                                            <div class="row">
                                                        <center>  <a href="<?=$ev->imagen?>" download="<?=$nm?>"><img src="../../img/icons/download.png" class="logos-enfermeria"alt=""><br> </center>
                                                            </div>
                                                         <div class="row"><center>Descargar</center></a></div>
                                                       
                                                      </div>
                                                      <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                                        <div class="row">
                                                      <center>  <a href="../../controlador/enfermeria/eliminarEvidenciaMedica.php?id=<?=$ev->idEvidenciaMedica?>&&mi=<?=$id?>"><img src="../../img/icons/delete.png" class="logos-enfermeria"alt=""><br> </center>
                                                        </div>
                                                        <div class="row"><center>Eliminar</center></a>
                                                    </div>
                                                        
                                                      </div>
                                                      </div> 
                                                      <br>
                                                     
                                                     
                                                <?php endforeach?>
                                                </div>
                                                </div>
                                                             
                                       
                                  
                   
                               
                                <?php endif?>
                               
                              
                                         
                              
                                </div>
                                   
                                   </div>
                                   <!-- termina archivos -->
         
       </div>
   
                               
               </div>
                        <?php endforeach?>
                    <?php endif?>
     
                  

    
 
   <script src="../../js/colapsables.js"></script>

    <?php require '../complementos/footer_2.php';?>
