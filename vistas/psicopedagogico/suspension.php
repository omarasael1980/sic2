

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
$motivos = cargaMotivosNotificacion();
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
                        <a class="list-group-item text-center list-group-item-action" href="psicoNuevoCaso.php"><p><i class="fa-solid fa-file-circle-plus"></i><?=$espacios?> Nuevo caso </p></a>
                        <a href="#" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                        <a href="#" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                        <a href="#" class="list-group-item text-center  list-group-item-action"><p><i class="fa-solid fa-route"></i><?=$espacios?>Canalizaciones</p> </a>
                </div>
                
            </div>

     </div>
      
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-control">
<!--contenedor central -->
<center><h1>Suspensión</h1></center>
<hr>
<center><h3>Caso Inicial:</h3></center>
<div class="container card  mb-3" style="background:#A3D1F7;">
<div class="row ">
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
</div>
<hr>

<!-- formulario para agendar citatorio -->
<form action="../../controlador/psicopedagogico/suspensiones.php" class="formulario" id="formulario"  method="post">
           
           <div class="row">
            <div class="col-lg-12"><input type="text" class="text" id="folio" name="folio" value="<?=$caso[0]->idatencion_psico?>" hidden></div>
          </div>
            <center><h6><b>Datos de suspensión:</b></h6></center>
          <!-- inicio grupo fecha y via de comunicacion -->
          <div class="row form-row"><!--inicio del row de fecha y via de comunicacion-->
    <div class="col-12 col-md-6">
        <!--inicio fecha de registro-->
        <div class="form-group" id="grupo__fecha">
            <div class="form-group-input">
                <label for="fecha" class="form-label"><b>Fecha de registro:</b></label>
                <input class="form-control text-right" name="fecha" id="fecha" value="<?=$today?>" min="2022-09-11" max="<?=$today?>" type="date">
                <i class=""><img class="form-validation-state img-input" id="img-fecha" src="../../img/icons/cross.png" alt="incorrecto"></i>
                <div class="form-message" id="mensaje_error__fecha">
                    <p class="">Selecciona una fecha en el rango del inicio de clases a la fecha actual</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <!--inicio de tipo de comunicacion-->
        <div class="form-group" id="grupo__motivo">
            <div class="form-group-input">
                <label for="motivo" class="form-label"><b>Medio de comunicación:</b></label>
                <div class="row">
                    <div class="col-10">
                        <select title="Motivo" class="form-control form-control2" name="motivo" id="motivo">
                            <option class="" value="0">Selecciona un medio de comunicación</option>
                            <?php foreach($motivos as $e):?>
                            <option value="<?=$e->idmotivo_prefectura?>"><?=$e->motivo?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-2">
                        <a title =" Agregar Motivo" data-bs-toggle="modal" data-bs-target="#registroMotivo" data-bs-whatever="@mdo" class="btn btn-primary align-items-center" ><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
                <div class="form-message" id="mensaje_error__motivo">
                    <p>Elige un medio de comunicación</p>
                    <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                </div>
            </div>
        </div>
    </div>
</div> <!--final del row de fecha y via de comunicacion-->

          <!-- fin de grupo fecha y via de comunicacion -->
        <br>
        <!-- inicio de combo fecha inicial y fecha final -->
        <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group" id="grupo__fechaInicial">
            <label for="fechaInicial" class="form-label"><b>Fecha Inicial de suspensión:</b></label>
            <input class="form-control" name="fechaInicial" id="fechaInicial" value="<?php echo date('Y-m-d', strtotime($today.'+1 days')); ?>" 
            min="<?php echo date('Y-m-d', strtotime($today.'+1 days')); ?>" 
            max="<?php echo date('Y-m-d', strtotime($today.'+4 days')); ?>" type="date">
            <div class="form-message" id="mensaje_error__fechaInicial">
                <p>Selecciona una fecha en el rango adecuado</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group" id="grupo__fechaFinal">
            <label for="fechaFinal" class="form-label"><b>Fecha Final de suspensión:</b></label>
            <input class="form-control" name="fechaFinal" id="fechaFinal" value="<?php echo date('Y-m-d', strtotime($today.'+4 days')); ?>" 
            min="<?php echo date('Y-m-d', strtotime($today.'+2 days')); ?>"
             max="<?php echo date('Y-m-d', strtotime($today.'+6 days')); ?>" type="date">
            <div class="form-message" id="mensaje_error__fechaFinal">
                <p>Selecciona una fecha en el rango adecuado</p>
            </div>
        </div>
    </div>
</div>

        <!-- fin de combo fecha inicial y fecha final -->
                      <!--input motivo-->
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
                    <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <button type="submit"  name = "bEnviar" onclick="validarForm(event)" id="bEnviar"class="btn btn-success">Guardar</button>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <button class="btn btn-danger"> Cancelar</button>
                    </div>
                    
                    </div>
                    
                    
    
         </form>
<!-- termina el formulario para agendar citatorio -->
</div><!-- FIN CENTRO -->
<!--contenedor central -->
    
       
        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control">
    <!--contenedor derecha -->
contenedor derecha
    <!--contenedor derecha -->

        </div>
    </div>
</div>
   

 <script src="../../js/colapsables.js"></script>
 <script src="../../js/validaSuspension.js"></script>
<!-- Modal para insertar motivo -->

<div class="modal fade" id="registroMotivo" tabindex="-1" aria-labelledby="registroMotivoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="registroMotivoLabel">Guardar nuevo medio de comunicación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="fmiMotivo" action="../../controlador/psicopedagogico/nuevoMedioComunicacion.php" method="post">
        <div class="form-group " id="grupo__miMotivo">
                            
                            <div class="form-group-input  ">
                            <label for="miMotivo" class="form-label form-control2"> <b> Medio de comunicación:</b>
                          
                            <input type="hidden"  id= "alumnomiMotivo" name="alumno" value="<?=$id?>">
                            <input type="text" onkeyup="revisaMay('miMotivo')" class="form-control" id="miMotivo" name="miMotivo">
                                <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                            </div>
                            </label>
                    <div class="form-message" id="mensaje_error__miMotivo">
                        <p>Debes escribir un medio de comunicación, solo se permiten letras</p>
                    </div>
                    </div> 

      
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-6"> <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></div>
            <div class="col-6"> <input  onclick="validaMiMotivo(event)" type="submit"  id="bMotivo"class="btn btn-success" value="Guardar">
            </form>
      </div></div>
        </div>
       
       
    </div>
  </div>
</div>

<?php require '../complementos/footer_2.php';?>


