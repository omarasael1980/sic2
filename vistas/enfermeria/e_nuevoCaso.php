
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

?>



<!-- body  -->

    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
          
                    <div class="row">
                        <center><H1  >Registro de Nueva atención</H1></center>
                        <center><div ><img  style="width: 120px;height: auto;" src="../../img/icons/enfermeria.webp" alt="enfermeria">
                                </div></center>
                            <center><h3><?=$al[0]->nombre." ".$al[0]->apaterno." ".$al[0]->amaterno?></h3></center>
                    </div>
       
        </div>
    </div>
    <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-2 col-xs-0"></div>
    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
        <form id="formulario" action="../../controlador/enfermeria/nuevoCaso.php" class="form-control2"method="post">
        
       <div class="row"> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <Label><h4>Fecha y hora</h4></Label><input type="datetime"
                       id="fecha"  name="fecha" value="<?=$today?>" min="2022-09-11" max="<?=$today?>"  class="form-control"></div>

                         <!--div con validacion de motivo-->
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__motivo">
                    <div class="form-group-input  ">
                     <label for="motivo" class="form-label"> <b> Motivo:</b>
                     <input type="text" name="motivo"  id="motivo" autocomplete="off"class="form-control">
                          <i class=""><img class="form-validation-state img-input" id="img-motivo"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                     
                <div class="form-message" id="mensaje_error__motivo">
                 <p>Escribe el motivo, debe contener entre 4-30 caracteres, solo se permiten letras.</p>
                </div>
             </div>
                 <br>
                         <!--div con validacion de motivo-->
                <div class="form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <Label><h4>Categoria</h4></Label>
                    <select id="categoria" name="categoria" class="form-control">
                                <?php foreach($categorias as $cat):?>
                                <option value="<?=$cat->idcategoria_medica?>"><?=$cat->categoriaMedica?></option>
                               <?php endforeach?>.
                            </select></div>   
                            </div> 
         </div>
         <div class="row">
            <!---->
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__desc">
                    <div class="form-group-input  ">
                     <label for="desc" class="form-label"> <b> Descripción:</b>
                     <textarea autocomplete="off" type="search" name="desc" id="desc" class="form-control"></textarea>
                          <i class=""><img class="form-validation-state img-input" id="img-desc"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                     
             
                         <!---->
             
         </div>
         <div class="form-message" id="mensaje_error__desc">
                 <p>Escribe el descripción, debe contener entre 10-200 caracteres.</p>
                </div>
             </div>
                 <br>
         <div class="row">
         <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
         <input type="hidden"name="id" value="<?=$_GET['id']?> ">
         
         <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
         <button class="form-control btn btn-success" type="submit">Guardar</button>
         </div>

         <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
         <a class="form-control btn btn-danger" href="expedienteAlumno.php?id=<?=$id?>"> <center>Cancelar</center> </a>
         </div>
         </div>
        </form>
    </div>
    </div>

<script src="../../js/validaCanalizacionMedica.js"></script>
<?php require '../complementos/footer_2.php';?>