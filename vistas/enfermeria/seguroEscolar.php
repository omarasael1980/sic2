<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}

$idenfermeria = $_GET['id'];// 
$idal = $_GET['c'];


$casos =cargarAtencionesMedicasAlumno($idal);
 ?>

 <?php

date_default_timezone_set("America/Tijuana");
setlocale(LC_ALL, 'es_ES');
$mes =date("m");
switch($mes){
    case '01':
        $meses = "Enero";
        break;
    case '02':
        $meses = "Febrero";
        break;
    case '03':
        $meses = "Marzo";
        break;
    case '04':
        $meses = "Abril";
        break;
     case '05':
            $meses = "Mayo";
            break;
     case '06':
            $meses = "Junio";
            break;
    case '07':
            $meses = "Julio";
            break;
    case '08':
            $meses = "Agosto";
            break;
       case '09':
                $meses = "Septiembre";
                break;
    case '10':
                $meses = "Octubre";
                break;
   case '11':
                $meses = "Noviembre";
                break;
   case '12':
                $meses = "Diciembre";
                break;
}
$dia = date("d");
$anio = date("Y");
$poliza="07000030";
$empresa = "Colegio Santee A.C.";
$domicilio ="Rio Champotón S/N, Fraccionamiento Villa Florida,  Mexicali, Baja California.";
$contacto ="686-580-74-24";
?>

<pre>
   

<!-- body  -->

    <div class="row">
        <center><h1>SEGURO ESCOLAR</h1></center>
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="div-logo col-lg-4 col-md-4 col-sm-5 col-xs-6">
                <label for="" class="logoSS"><a href="#">
                    <p><img src="../../img/empresarial/adalid.png" alt="Colegio Santee"> </p>    </a>
                </label>
            </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
            
        </div>
        <div class="div-logo col-lg-4 col-md-4 col-sm-5 col-xs-6">
                <label for="" class="logoSS"><a href="#">
                    <p><img src="../../img/empresarial/gmx.png" alt="Colegio Santee"> </p>    </a>
                </label>
            </div>
    </div>
    
    <div class="container">
        <div class="row ">
                   <center> <b> <h3 class=""> Mexicali, B.C. a <?=$dia?> de <?=$meses?> del <?=$anio?></h3></b></center> 
         </div>     
    </div>
    <hr>
    <center><h1>Declaración del siniestro</h1></center>
    <center><h4><?="Caso del alumno:".$casos["0"]['cas']->nombre." ".$casos["0"]['cas']->apaterno." ".$casos["0"]['cas']->amaterno?></h4></center>
    </div>

    <form class = "form-control"action="../../controlador/enfermeria/seguroEscolarAlta.php" method="post">

    <div class="container">
        <input type="text" hidden name="alumno" value="<?=$idal?>">
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
                    <textarea type="text"  class="form-control"name="descripcion"  value=""></textarea>
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
                    <input type="text"  name="queautoridad" class="form-control">
                    
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <label for=""> <b>No. de Acta</b></label> <input type="text" name="acta" class="form-control" >
                    </div>
                </fieldset>
            </div>
            <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                    <label for="percepcion" ><b>En su percepción, ¿Cuál fue la causa del siniestro? :</b></label>  
                    <input type="text"  class="form-control"name="causa"  value="">
                </div> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                    <label for="medidas " ><b>¿Qué medidas se tomaron después de tener conocimiento? :</b></label>  
                    <input type="text"  class="form-control"name="medidas"  value="">
                </div> 
                 
            </div>
            <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12 col-xs-12" > 
                    <label for="monto" ><b>Monto estimado: ($ en pesos)</b></label>  
                    <input type="number"  class="form-control"name="monto"  value="">
                </div> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                    <label for="danosTercero " ><b>¿En caso de existir terceros afectados, mencione sus nombres y teléfonos de contacto:</b></label>  
                    <input type="text"  class="form-control"name="terceros"  value="">
                </div> 
            </div>
            <div class="row">
                <center><b>Declaro que los datos que anteceden corresponden a la realidad al momento de la firma de este documento</b></center>
                <br>
                
                <center> <b> A <?=$dia?> de <?=$meses?> de <?=$anio?> </b></center>
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
            <button type ="submit" class="btn btn-success"><center>Guardar</center> </button>
        </div>
   
       
            
     </div>
     </form>
<?php require '../complementos/footer_2.php';?>