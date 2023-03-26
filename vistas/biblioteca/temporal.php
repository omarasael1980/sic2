<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';
$id=$_GET['id'];
$c=$_GET['c'];
$al =buscaAlumno($c);
date_default_timezone_set("America/Tijuana");
$especialistas=buscaEspecialista();
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}?>

<!-- body  -->

    <div class="row">
        <center><h1>Canalización Médica</h1></center>
        <br>
        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <form action="../../controlador/enfermeria/canalizar.php" name="formulario" id="formulario" method="post" class="form-control">
             <div>
                
            <input class="form-control" type="hidden"name="idalumno"  value="<?=$al[0]->idestudiantes?>">
            <input class="form-control" type="hidden"name="idenfermeria"  value="<?=$id?>">
            </div>
            <br>
          
            <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                <label for="nombre"><b>Nombre del Alumno:</b></label></div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                <input class="form-control" type="text" name="nombre" value="<?=$al[0]->nombre." ".$al[0]->apaterno." ".$al[0]->amaterno?>" disabled>
                </div>
            </div>
            <br>

            <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                <label for="nombre"><b> Especialista:</b></label></div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                <select class="form-control" name="especialista" id="especialista">
                
                <?php foreach($especialistas as $esp):?>
                    <option value="<?=$esp->idespecialiste_medico?>"><?=$esp->especialista?></option>
                    <?php endforeach?>
            </select>
                </div>
            </div>
            <br>  

         
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                <label for="motivo"><b> Fecha y Hora:</b></label></div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
                <input required type="datetime-local"  name="fecha" class="form-control">
                </div>
            </div>
            <br> 
              <!--inicia formulario con validacion-->
              <div class="form-group " id="grupo__motivo">
                     
                     <div class="form-group-input  ">
                     <label for="motivo" class="form-label"> <b> Motivo:</b>
                     <input class="form-control" type="text" name="motivo" placeholder ="Motivo" autocomplete="off">
                          <i class=""><img class="form-validation-state img-input" id="img-motivo"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     </label>
                <div class="form-message" id="mensaje_error__motivo">
                 <p>Escribe el motivo, debe contener entre 4 a 50 caracteres, solo se admiten letras</p>
                </div>
             </div>
                 <br>
                   <!--finaliza formulario con validacion--> 
             <!--inicia formulario con validacion-->
             <div class="form-group " id="grupo__desc">
                     
                     <div class="form-group-input  ">
                     <label for="desc" class="form-label"> <b> Descipción:</b>
                     <textarea class="form-control"  name="desc" value="" cols="30" rows="7" placeholder ="Descripción" autocomplete="off"></textarea>
                          <i class=""><img class="form-validation-state img-input" id="img-desc"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     </label>
                <div class="form-message" id="mensaje_error__desc">
                 <p>Escribe la descripcíon, debe contener entre 1 a 300 caracteres</p>
                </div>
             </div>
                 <br>
                   <!--finaliza formulario con validacion--> 
           
            <div class="form-message  me_formulario" id="mensaje_error__formulario">
                    <p><center> <b><h3>Debes llenar todos los campos</h3></b></center> </p>
            </div> 
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6"><button class="form-control btn btn-success">Guardar</button></div>
                <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6"><center><a  class="form-control  btn btn-danger"href="expedienteAlumno.php?id=<?=$c?>">Cancelar</a></center></div>
            </div>
                    
                    
            </form>
          
          
        
       
        </div>
    </div>

    <script src="../../js/validaCanalizacionMedica.js">        </script>
<?php require '../complementos/footer_2.php';?>