<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/cabeceraImpresion.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}

$espacios="        ";
$folio = $_GET['f'];
$casos =getSeguroEscolarxFolio($folio);
$casoEnfermeria= buscaAtencionMedicaporId($casos[0]->enfermeria_idenfermeria);
$poliza="07000030";
$empresa = "Colegio Santee A.C.";
$domicilio ="Rio Champotón S/N, Fraccionamiento Villa Florida,  Mexicali, Baja California.";
$contacto ="686-580-74-24";
$id= $casoEnfermeria[0]->estudiantes_idestudiantes;

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
$hoy = "Mexicali, B.C. a ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
//Resultado: Domingo 26 de Enero del 2020

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
                         <a href="../enfermeria/eprincipal.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                        
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="../enfermeria/expedienteAlumno.php?id=<?=$id?>"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Expedientes </p></a>
                     
                        <br> <a href="../enfermeria/estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
 
       <!--contenedor central -->
       
       <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
           <!-- Aqui inicia area de pdf -->
      
            <div class="row"id="cuerpoImpresion" >
                          <!-- empieza contenido seguro escolar-->
         <div class="row">
             <img src="http://<?=$_SERVER['HTTP_HOST']?>/img/empresarial/encabezadoSeguro.png" width="100%" alt="Logo">
             <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
            <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                <!-- generales -->
               
                        <h4 class="text-center" >Declaración de siniestro</h4>
                    <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0"style="height:15px;" > <p style="font-size:12 px; background:#c8c8c8;" class="m-0 p-0" ><b>Nombre del asegurado:  </b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0 " style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b>Colegio Santee </b> <hr class="m-0 p-0"></p>
                            </div>                                    
                    </div>
                    
                        <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; background:#c8c8c8;" class="m-0 p-0"><b>Domicilio: </b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0"style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b>Rio Champoton SN Fracc. Villaflorida </b> <hr class="m-0 p-0"></p>
                            </div>                                     
                        </div>
                        <div class="row m-0 p-0"style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; background:#c8c8c8;" class="m-0 p-0"><b>Número de poliza: </b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b><?=$poliza?> </b> <hr class="m-0 p-0"></p>
                            </div>                                      
                        </div>
                        
                        <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; background:#c8c8c8;" class="m-0 p-0"><b>Teléfono de contacto: </b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b><?=$contacto?> </b> <hr class="m-0 p-0"></p>
                            </div>                                      
                        </div>
                    
                        <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0"><b>Nombre Persona que declara: </b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b><?=$_SESSION['user']->nombre." ".$_SESSION['user']->apaterno." ".$_SESSION['user']->amaterno?> </b> <hr class="m-0 p-0"></p>
                            </div>                            
                        </div>
                    
                            <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; background:#c8c8c8;" class="m-0 p-0"><b>Teléfono fijo: </b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b><?=$_SESSION['user']->tel?> </b> <hr class="m-0 p-0"></p>
                            </div>                                
                        </div>
                    
                        <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0" ><b>Teléfono celular: </b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b><?=$_SESSION['user']->cell?> </b> <hr class="m-0 p-0"></p>
                            </div>                                
                        </div>
                       </div>  
                       
                       <!-- inicia cuerpo de hoja de seguro -->
                       <div class="row text-center"  style="font-size: 14px; height:15px; background:#063971; color:white;"><h6>Descripción de los hechos</h6></div>
                        <div class="row form-control " style="background: #97e9ff;height:18px; ">
                            <p style="font-size:12 px;; text-decoration:underline #9196ac ;" class="text-justify m-0 p-0" ><b><?=$casos[0]->descripcion?> </b></p> <hr class="m-0 p-0">
                        </div>
                        <br>
                    <div class="row p-0 m-0">
                        <!-- tomo conocimiento autoridad -->
                    <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0" ><b>¿Tomó conocimiento alguna autoridad? </b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b><?=$espacios.$espacios.$espacios.$espacios?>             Si<?=$espacios.$espacios?>           NO<?=$espacios?>    X  <?=$espacios.$espacios?>      Cual? </b> <hr class="m-0 p-0"></p>
                            </div>                                
                        </div>

                              <!-- numero de acta -->
                    <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0" ><b>Número de acta:</b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b> #</b> <hr class="m-0 p-0"></p>
                            </div>                                
                        </div>
                           <!-- causa -->
                    <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0" ><b> En su percepción ¿Cuál fue la causa del siniestro?</b></p></div>
                            <div class="col-lg-0 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b><?=$espacios.$espacios.$casos[0]->causa?>  </b> <hr class="m-0 p-0"></p>
                            </div>                                
                        </div>
                            <!-- medidas tomadas -->
                            <div class="row m-0 p-0" style="height:15px;">
                                    <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0" ><b>  ¿Qué medidas se tomaron después de tener conocimiento? </b></p></div>
                                    <div class="col-lg-0 col-md-0 col-sm-0 col-xs-0"></div>
                                    <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b><?=$espacios.$espacios.$casos[0]->medidas?>  </b> <hr class="m-0 p-0"></p>
                                    </div>                                
                           </div>
                   
                             <!-- medidas tomadas -->
                             <div class="row m-0 p-0" style="height:15px;">
                                    <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0" ><b>  Las pérdidas consistieron en:  </b></p></div>
                                    <div class="col-lg-0 col-md-0 col-sm-0 col-xs-0"></div>
                                    <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b>. </b> <hr class="m-0 p-0"></p>
                                    </div>                                
                           </div>
                             <!-- monto estimado -->
                    <div class="row m-0 p-0" style="height:15px;">
                            <div class="col-lg-4 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0" ><b>Monto estimado:</b></p></div>
                            <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
                            <div class="col-lg-7 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b> $</b> <hr class="m-0 p-0"></p>
                            </div>                                
                        </div>
                    
                       <!-- danios -->
                       <div class="row m-0 p-0" style="height:15px;">
                                    <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px;background:#c8c8c8; " class="m-0 p-0" ><b>  En caso de existir terceros afectados, mencione los nombres y teléfonos de contacto   </b></p></div>
                                    <div class="col-lg-0 col-md-0 col-sm-0 col-xs-0"></div>
                                    <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b> .<?=$espacios.$casos[0]->terceros?> </b> <hr class="m-0 p-0"></p>
                                    </div>                                
                           </div>
                                <!-- danios -->
                       <div class="row m-0 p-0" style="height:15px;">
                                    
                                   
                                    <div class="col-lg-12 m-0 p-0" style="height:15px;"> <p style="font-size:12 px; " class="m-0 p-0"><b> Declaro que los datos que anteceden corresponden a la realidad al momento de la firma de este documento. </b> <hr class="m-0 p-0"></p>
                                    </div>                                
                           </div>
                    
                 <br><br>
                   </div>
                   <div class="row">
                    <br>  <br>  <br>
                      
                         <div class="col-lg-12 m-0 p-0" style="height:18px;" >
                        <p  style="color:black; font-size:12 px;" class=" col-lg-12 m-0 p-0  text-center"  ><b>  <?=$hoy?> </b></p> 
                         </div>   
                    </div>
                    <br><br><br>
                   <div class="row">
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4"><hr></div>
                  <div class="col-lg-4"></div>
                         <div class="col-lg-12 m-0 p-0" style="height:18px;" > 
                              
                                  <p  style="color:#063971; font-size:12 px;" class="col-12 m-0 p-0  text-center"  ><b> FIRMA DEL DECLARANTE </b></p> 
                         </div>   
                            <br> <br> <br>
                    </div>
                       <!-- termina cuerpo  -->
                 </div>
            </div>
         </div>
         <!-- termina contenido seguro escolar -->
    <!-- termina el encabezado -->

            <!--contenedor central -->

            <!-- termina area de impresion pdf -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-0"></div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="col-12"><button class="btn btn-outline-primary"  id="imprimirSeguro">Imprimir</button></div>
                </div>
            </div>
            
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


 
<script src="../../js/imprimeSeguroEscolar.js"></script>
<?php require '../complementos/footer_2.php';?>