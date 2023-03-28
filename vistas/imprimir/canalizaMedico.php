<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/cabeceraImpresion.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';


$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
$hoy = date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
//Resultado: Domingo 26 de Enero del 2020
$espacios = "        ";
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
if(isset($_GET['id'])){
  
    $id = $_GET['id'];
}else{
    if(isset($_POST)){
        $id = $_POST['id'];
        $asunto = $_POST['asunto'];
        $destinatario = $_POST['destinatario'];
        $mensaje = $_POST['mensaje'];
    }
}
$caso = buscaAtencionMedicaporId($id);

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
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
            <h3 class="text-center">Redacta oficio</h3>
            <form action="canalizaMedico.php"id="formulario" class="form-control2" method="post">
              <input type="text" hidden value="<?=$id?>" name="id" id="id">
          
            <!-- input asunto -->
            <div class="form-group  col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__asunto">
                    <div class="form-group-input col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <label for="asunto" class="form-label col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b> Asunto:</b>
                        <?php if(isset($asunto)):?>
                        <input autocomplete="off" value="<?=$asunto?>" spellcheck="true" lang="es" type="search" name="asunto" id="asunto" class="form-control ">
                         <?php else:?> 
                            <input autocomplete="off" value="" spellcheck="true" lang="es" type="search" name="asunto" id="asunto" class="form-control ">
                            <?php endif?>
                        <i class=""><img class="form-validation-state img-input" id="img-asunto"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                            </label>
                    </div>
            </div>
         <div class="form-message  col-lg-12 col-md-12 col-sm-12 col-xs-12 " id="mensaje_error__asunto">
                 <p>Escribe el descripción, debe contener entre 10-200 caracteres.</p>
         </div>
             
                 <br>
            <!-- input destinatario -->
            <div class="form-group  col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__destinatario">
                    <div class="form-group-input col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                     <label for="destinatario" class="form-label col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b> Destinatario:</b>
                     <input autocomplete="off"  value="<?php if(isset($destinatario)){echo $destinatario;}?>"spellcheck="true" lang="es" type="search" name="destinatario" id="destinatario" class="form-control ">
                          <i class=""><img class="form-validation-state img-input" id="img-Destinatario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
         </div>
         <div class="form-message  col-lg-12 col-md-12 col-sm-12 col-xs-12 " id="mensaje_error__destinatario">
                 <p>Escribe el descripción, debe contener entre 10-200 caracteres.</p>
                </div>
             
                 <br>
            <!-- input contenido -->
            <div class="form-group  col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__mensaje">
                    <div class="form-group-input col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                     <label for="mensaje" class="form-label col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b> Mensaje:</b>
                     <textarea autocomplete="off" value="<?php if(isset($mensaje)){echo $mensaje;}?>" spellcheck="true" lang="es" type="search" rows="20" name="mensaje" id="mensaje" class="form-control "></textarea>
                          <i class=""><img class="form-validation-state img-input" id="img-mensaje"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
         </div>
         <div class="form-message  col-lg-12 col-md-12 col-sm-12 col-xs-12 " id="mensaje_error__mensaje">
                 <p>Escribe el descripción, debe contener entre 10-400 caracteres.</p>
                </div>
             
                 <br>
<div class="col-lg-4 col-md-4 col-sm-3 col-xs-0"></div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><input type="submit" class="btn btn-outline-primary"value="Vista previa"></div>

            </form>
      
            <div class="row"id="cuerpoImpresion" >
          <!--contenedor central -->
<!-- Aqui se hace el encabezado de impresiones -->
            <div class="container">
                    <div class="row">
                        <p class="text-center">
                        <img src="http://<?=$_SERVER['HTTP_HOST']?>/img/empresarial/logoMembrete.png" height="120 px" alt="Logo">
                        </p>
                    </div>
            </div>
   <div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">

</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
    <h4 class="text-right"><?php if(isset($asunto)){echo $asunto;}?></h4>
    <h6 class="text-right">Mexicali, B.C. a <?=$hoy?></h6>
</div>
   </div>
   <div class="row">
    
<h5> <?php if(isset($destinatario)){echo $destinatario;}?></h5>
<h6>Presente.- </h6>
<br><br>
<h6>Por medio de la presente se le notifica que: </h6>
<h6 class="text-center"><b><?=$espacios.$caso[0]->nombre." ".$caso[0]->apaterno." ".$caso[0]->amaterno?></b></h6>
<h6 class="text-justify"><?php if(isset($mensaje)){echo $mensaje;}?></h6>
<br>
<div class="row">
                        <p class="text-center">
                        <img src="http://<?=$_SERVER['HTTP_HOST']?>/img/empresarial/firmaEnfermeria.png" height="120 px" alt="Logo">
                        </p>
                    </div>
   </div>
    <!-- termina el encabezado -->

            <!--contenedor central -->
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-0"></div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="col-12"><button class="btn btn-outline-primary" id="imprimirCanalizacion">Imprimir</button></div>
                </div></div>
            
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

 
<script src="../../js/pruebahtml2pdf.js"></script>
<?php require '../complementos/footer_2.php';?>