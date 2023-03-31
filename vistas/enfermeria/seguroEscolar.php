<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require_once '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
$espacios = "    ";
$idenfermeria = $_GET['id'];// 
$idal = $_GET['c'];

$fecha_actual = date("Y-m-d h:i:s");
$casos =cargarAtencionesMedicasAlumno($idal);
 ?>

 <?php

date_default_timezone_set("America/Tijuana");
setlocale(LC_ALL, 'es_ES');
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
$hoy = date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
$dia = date('d');
$mes= $meses[date('n')-1];
$anio = date('Y');
$poliza="07000030";
$empresa = "Colegio Santee A.C.";
$domicilio ="Rio Champotón S/N, Fraccionamiento Villa Florida,  Mexicali, Baja California.";
$contacto ="686-580-74-24";
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
                         <a href="eprincipal.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>

                         <br>   <a href="e_nuevoCaso.php?id=<?=$_GET['c']?>" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="seguroEscolar.php?id=<?=$_GET['id']?>&c=<?=trim($_GET['c']);?>"><p>
                        <i class="fa-solid fa-hand-holding-medical"></i><?=$espacios?> Seguro escolar </p></a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="expedienteAlumno.php?id=<?=$_GET['c']?>"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Expedientes </p></a>
                     
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->

<div class="row" id="cuerpoImpresion">
<!-- aqui va formulario -->
<div class="row">
        <h1 class="text-center">SEGURO ESCOLAR</h1>
        
        <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="container">
                    <div class="row">
                        <p class="text-center">
                        <img src="http://<?=$_SERVER['HTTP_HOST']?>/img/empresarial/logoMembrete.png" height="120 px" alt="Logo">
                        </p>
                    </div>
            </div>
    </div>
    
    <div class="container">
    <div class="row ">
        <h6 class="text-right">Mexicali, B.C. a <?=$hoy?></h6>
         </div>     
    </div>
    <hr>
    <h1 class ="text-center">Declaración del siniestro</h1>
    <h4 class="text-center"><?="Caso del alumno:".$casos["0"]['cas']->nombre." ".$casos["0"]['cas']->apaterno." ".$casos["0"]['cas']->amaterno?></h4>
    </div>

    <form class = "form-control"action="../../controlador/enfermeria/seguroEscolarAlta.php" method="post">

    <div class="container">
        <input type="text" hidden name="alumno" value="<?=$idal?>">
        <input type="text" hidden name="fechaActual" value="<?=$fecha_actual?>">
        <input type="text" hidden name="idenfermeria" value="<?=$idenfermeria?>">
     <input type="text" hidden  name="fecha"value = "<?=$dia." ".$meses." ".$anio." ".$mes?>">
        <div class="row ">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" > 
                <label for="poliza" ><b> No. Poliza: </b></label>  <input disabled class="form-control" type="text" name="poliza" value="<?=$poliza?>">
                </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" > 
                <label for="poliza" ><b>Nombre del asegurado:</b></label>  <input disabled class="form-control" type="text" name="poliza" value="<?=$empresa?>">
                </div>
        </div>
        <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12" > 
                <label for="domicilio" ><b>Domicilio:</b></label>  <input disabled class="form-control" type="text" name="domicilio" value="<?=$domicilio?>">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12" > 
                <label for="poliza" ><b>Números de contacto:</b></label>  <input disabled class="form-control" type="text" name="contacto" value="<?=$contacto?>">
                </div>      
        </div>       
           
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" > 
                     <input type="text" hidden name="usuario" value="<?=$_SESSION['user']->idUsuario?>">
                    <label for="Nombredeclarante" ><b>Nombre de la persona que declara:</b></label>  
                    <input  class="form-control" type="text" name="declarante"  value="<?=$_SESSION['user']->nombre." ".$_SESSION['user']->apaterno." ".$_SESSION['user']->amaterno." "?>">
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6" > 
                    <label for="telFijo" ><b>Teléfono Fijo:</b></label>  
                    <input  class="form-control" type="text" name="telfijo"  value="<?=$_SESSION['user']->tel?>">
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6" > 
                    <label for="telmovil" ><b>Teléfono Movíl:</b></label>  
                    <input  class="form-control" type="text" name="telMovil"  value="<?=$_SESSION['user']->cell?>">
                </div> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                    <label for="domiciliodeclarante " ><b>Domicilio:</b></label>  
                    <input type="text"  class="form-control"name="domDeclarante"  value="<?=$_SESSION['user']->domicilio?>">
                </div> 
               

            </div>
            <hr>
            <center><h2>Descripción de los hechos</h2></center>
          <center>  <b>Nota: El declarante deberá mencionar detalles como lo son: fechas, horas, nombres, etc.</b></center>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                    <label for="descripcion " >Descripción:</label>  
                    <textarea type="text" autocomplete ="off"spellcheck="true" lang="es" class="form-control"name="descripcion"  value=""></textarea>
                </div> 
            </div>
            
              
            <div class="row">
                <fieldset>
                    <legend><b>¿Tomó conocimiento alguna autoridad?</b></legend>
                    <div>
                    <input type="radio" id="No" name="autoridad" value="No" checked>
                    <label for="No">No</label>
                    </div>

                    <div>
                    <input type="radio" id="si" name="autoridad" value="Si">
                    <label for="si">Si</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="si"><b> ¿Qué autoridad?</b></label>
                    <input type="text" autocomplete ="off"spellcheck="true" lang="es" name="queautoridad" class="form-control">
                    
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <label for=""> <b>No. de Acta</b></label> <input type="text" name="acta" class="form-control" >
                    </div>
                </fieldset>
            </div>
            <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                    <label for="percepcion" ><b>En su percepción, ¿Cuál fue la causa del siniestro? :</b></label>  
                    <input type="text" autocomplete ="off"spellcheck="true" lang="es" class="form-control"name="causa"  value="">
                </div> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                    <label for="medidas " ><b>¿Qué medidas se tomaron después de tener conocimiento? :</b></label>  
                    <input type="text" autocomplete ="off"spellcheck="true" lang="es" class="form-control"name="medidas"  value="">
                </div> 
                 
            </div>
            <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12 col-xs-12" > 
                    <label for="monto" ><b>Monto estimado: ($ en pesos)</b></label>  
                    <input type="number"  class="form-control"name="monto"  value="">
                </div> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                    <label for="danosTercero " ><b>¿En caso de existir terceros afectados, mencione sus nombres y teléfonos de contacto:</b></label>  
                    <input type="text" autocomplete ="off"spellcheck="true" lang="es"  class="form-control"name="terceros"  value="">
                </div> 
            </div>
            <div class="row">
                <center><b>Declaro que los datos que anteceden corresponden a la realidad al momento de la firma de este documento</b></center>
                <br>
                
                <h6 class="text-center"><b> A <?=$dia?> de <?=$mes?> de <?=$anio?> </b></h6> 
                <br><br>
            
            <div class="row">
                <br>
                <br>
                <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2" > 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8" > 
                    <hr>
                <center><b>Firma del solicitante</b></center> </div>
            </div>
            
      
   
            <div class="row">
            <button type="submit">Enviar</button>
        </div>
   
       
            
     </div>
     </form>
</div>

<div class="row" id="pdf">

</div>
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