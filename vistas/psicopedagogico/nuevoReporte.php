
<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/psicologia/psico.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$id= $_GET['id'];
$today =  date('Y-m-d');
$motivos = cargaMotivosPsico();
$caso = buscaCasoPsico($id);
$al = $caso[0]->estudiantes_idestudiantes;
$alumno = buscaAlumno($al);
$nombreAlumno =$alumno[0]->nombre." ".$alumno[0]->apaterno." ".$alumno[0]->amaterno;
?>


<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 form-control">
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
                         <a href="pprincipal.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-bars"> </i> <?=$espacios?>Pendientes</p>  </a>
                      <br>  <a class="list-group-item text-center list-group-item-action" href="psicoNuevoCaso.php"><p><i class="fa-solid fa-file-circle-plus"></i><?=$espacios?> Nuevo caso </p></a>
                    <br>    <a href="historialPsico.php?id=<?=$al?>" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                    <br>    <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                    
                </div>
                
            </div>

     </div>
      
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-control">
<!--contenedor central -->
<center><h1>Reporte</h1></center>
<hr>
<center><h3>Antecedentes</h3></center>
<div class="row">
    <!-- datos del alumno -->
    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-6"><b>Alumno:</b> <?=$nombreAlumno?></div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-6"><b>Grupo:</b> <?=$alumno[0]->grupo?></div>
    <div class="col-lg-2 col-md-0 col-sm-0 col-xs-0"></div>

</div>
<!-- datos del caso -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6"><b>Folio:</b> <?=" ".$caso[0]->idatencion_psico?></div>
    <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6"><b>Fecha:</b> <?=" ".$caso[0]->fecha?></div>
    <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6"><b>Motivo:</b><?=" ".$caso[0]->motivo?></div>
    <div class="col-lg-1 col-md-1 col-sm-0 col-xs-6"></div> 
    
</div>
<div class="row">
   <b>Descripción:</b> 
</div>
<div class="row">
    <?=$caso[0]->descripcion?>
</div>
<hr>
<div class="row">
    <!-- inicia form -->
  <div class="col-lg-3 col-md-3 col-sm-2 col-xs-0"></div>
  <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
    <form action="../../controlador/psicopedagogico/agregarSeguimiento.php" class="formulario" id="formulario"  method="post">
           
           <div class="row">
               <div class="col-lg-12"><input type="text" class="text" id="folio" name="folio" value="<?=$caso[0]->idatencion_psico?>" hidden></div>
               
           </div>
               <center><h6>Formato de reporte:</h6></center>
           <!--input fecha-->
           <div class="form-group" id="grupo__fecha">
              <div class="form-group-input  ">
                    <label for="fecha" class="form-label"> <b> Fecha:</b>
                       <input class="form-control text-rigth" name="fecha"  id="fecha"value="<?=$today?>" min="2022-09-11" max="<?=$today?>" type="date">
                           <i class=""><img class="form-validation-state img-input" id="img-fecha"src="../../img/icons/cross.png" alt="incorrecto"></i>
                   </label>   
                           <div class="form-message " id="mensaje_error__fecha">
                               <p class="">Selecciona una fecha en el rango del inicio de clases a la fecha actual</p>
                           </div>
                </div>
           </div>
                        <!--input fecha-->
                         <!--input motivo-->
                         <br>
                       <div class="form-group " id="grupo__motivo">
                           <div class=" form-group-input">
                               <label for="motivo" class="form-label form-control2"> <b> Motivo:</b>
                               <div class="row">
                                   <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                           <select title="Motivo" class="form-control" name="motivo" id="motivo"> 
                                               <option class=""value="0" >Elige un motivo</option>
                                                    <?php foreach($motivos as $e):?>
                                                <option value="<?=$e->motivoPsico?>"><?=$e->motivoPsico?></option>
                                                   <?php endforeach?>
                                           </select>    
                                   </div>
                               <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                       <a title =" Agregar Motivo" data-bs-toggle="modal" data-bs-target="#registroMotivo" data-bs-whatever="@mdo" class="btn btn-primary align-items-center " ><i class="fa-solid fa-plus"></i></a>
                               </div>
                           </div>
                           <div class="form-message" id="mensaje_error__motivo">
                                               <p >Debes elegir alguna opción de motivo</p>
                                               <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                           </div>
                               </label>
                           </div>
                           </div>
                           <br>

           <!-- input descripcion -->
           <div class="form-group " id="grupo__descripcion"> 
                <div class="form-group-input  ">
                   <label for="descripcion" class="form-label form-control2"> <b> Descripción:</b>
                       <textarea name="descripcion" spellcheck="true" lang="es"  onkeyup="validadescripcion(this.value)" id="descripcion" required class="form-control"></textarea>
                           <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                       </div>
                   </label> 
                   <div class="form-message" id="mensaje_error__descripcion">
                       <p>Debe tener una descripción clara del evento inicial.</p>
                   </div>
           </div>
                   <!-- termina input descripcion -->
                       <br>
                       <button type="submit"  name = "bEnviar" onclick="validarForm(event)" id="bEnviar"class="nav-button-cargar">Guardar</button>
       </form></div>
    
    <!-- termina form -->
</div>
</div><!-- FIN CENTRO -->
<!--contenedor central -->
      </div>
       
        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control">
    <!--contenedor derecha -->
contenedor derecha
    <!--contenedor derecha -->

        </div>
    </div>
</div>
   
 <script src="../../js/colapsables.js"></script>
 <script src="../../js/validacionesSeguimientoPisco.js"></script>
 
<!-- Modal para insertar motivo -->

<div class="modal fade" id="registroMotivo" tabindex="-1" aria-labelledby="registroMotivoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="registroMotivoLabel">Guardar nuevo motivo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="fmiMotivo" action="../../controlador/psicopedagogico/nuevoMotivo.php" method="post">
        <div class="form-group " id="grupo__miMotivo">
                            
                            <div class="form-group-input  ">
                            <label for="miMotivo" class="form-label form-control2"> <b> Motivo Nuevo:</b>
                          
                            <input type="hidden"  id= "alumnomiMotivo" name="alumno" value="0">
                            <input type="text" spellcheck="true" lang="es"  onkeyup="revisaMay('miMotivo')" class="form-control" id="miMotivo" name="miMotivo">
                                <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                            </div>
                            </label>
                    <div class="form-message" id="mensaje_error__miMotivo">
                        <p>Debes escribir un motivo, solo se permiten letras</p>
                    </div>
                    </div> 

      
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-6"> <button type="button" class="nav-button-cargar" data-bs-dismiss="modal">Cancelar</button></div>
            <div class="col-6"> <input  onclick="validaMiMotivo(event)" type="submit"  id="bMotivo"class="nav-button-cargar" value="Guardar">
            </form>
      </div></div>
        </div>
       
       
    </div>
  </div>
</div>

    
    <!-- termina modal para insertar motivo-->
<?php require '../complementos/footer_2.php';?>