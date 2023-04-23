<?php
require '../complementos/header_2.php' ;
include '../../modelo/usuarios/usuarios.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';

$id = $_GET['id'];
$al =buscaAlumno($id);
date_default_timezone_set("America/Tijuana");
$hoy = getdate();
$today = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday']."T".$hoy['hours'].':'.$hoy['minutes'];
$categorias =getCategoriasMedicas();
?>
<?php
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
$espacios = "        ";
?>


<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
       <div class="row">
                <p class="text-center"><a href="eprincipal.php">
                 <img class="img-menu" src="../../img/icons/enfermeria.webp" alt="enfermeria"></a></p>
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
                         <br>   <a href="e_nuevoCaso.php?id=<?=$id?>" class=" btn btn-primary  list-group-item text-center list-group-item-action " >
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="expedienteAlumno.php?id=<?=$id?>"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Expedientes </p></a>
                     
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->

          <div class="row">
                       <H3 class="text-center"  >Registro de Nueva atención</H3>
                       
                               
                          <h6 class="text-center"><?=$al[0]->nombre." ".$al[0]->apaterno." ".$al[0]->amaterno?></h6>
                    </div>
       
     
    <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <form id="formulario" action="../../controlador/enfermeria/nuevoCaso.php" class="form-control2"method="post">
        
       <div class="row"> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <Label><h6><b> Fecha y hora</b></h6></Label><input type="datetime"
                       id="fecha"  name="fecha" value="<?=$today?>" min="2022-09-11" max="<?=$today?>"  class="form-control"></div>

                         <!--div con validacion de motivo-->
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__motivo">
                    <div class="form-group-input   col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                     <label for="motivo" class="form-label  col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b> Motivo:</b>
                     <input type="text" name="motivo"  id="motivo" autocomplete="off"class="form-control">
                          <i class=""><img class="form-validation-state img-input" id="img-motivo"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                     
                <div class="form-message col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mensaje_error__motivo">
                 <p class="text-center" ><b> Escribe el motivo, debe contener entre 4-30 caracteres, solo se permiten letras.</b></p>
                    <br>
                </div>
             </div>
                 <br>
                         <!--div con validacion de motivo-->
                <div class="form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <Label><h6><b>Categoria</b></h6></Label>
                    <select id="categoria" name="categoria" class="form-control">
                                <?php foreach($categorias as $cat):?>
                                <option value="<?=$cat->idcategoria_medica?>"><?=$cat->categoriaMedica?></option>
                               <?php endforeach?>.
                            </select></div>   
                            </div> 
         </div>
         <div class="row">
            <!---->
            <div class="form-group  col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__desc">
                    <div class="form-group-input col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                     <label for="desc" class="form-label col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b> Descripción:</b>
                     <textarea autocomplete="off"  spellcheck="true" lang="es" type="search" name="desc" id="desc" class="form-control "></textarea>
                          <i class=""><img class="form-validation-state img-input" id="img-desc"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                     
             
                         <!---->
             
         </div>
         <div class="form-message  col-lg-12 col-md-12 col-sm-12 col-xs-12 " id="mensaje_error__desc">
                 <p>Escribe el descripción, debe contener entre 10-200 caracteres.</p>
                </div>
             </div>
                 <br>
         <div class="row">
         
         <input type="hidden"name="id" value="<?=$_GET['id']?> ">
         <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
         <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
         <button class="form-control nav-button-cargar" type="submit">Guardar</button>
         </div>
         <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
         <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
         <a class="form-control nav-button-cargar" href="expedienteAlumno.php?id=<?=$id?>"><p class="text-center"> Cancelar</p> </a>
         </div>
         </div>
        </form>
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

 

<script src="../../js/validaCanalizacionMedica.js"></script>
<?php require '../complementos/footer_2.php';?>