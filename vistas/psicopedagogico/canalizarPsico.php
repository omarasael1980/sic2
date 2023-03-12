
<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/psicologia/psico.php';
require '../../modelo/config/comunes.php';
$motivos = cargaMotivosPsico();
$viaComunicacion = cargaMotivosNotificacion();
$today =  date('Y-m-d');
$caso = buscaCasoPsico($_GET['id']);
$especialistas = buscaEspecialistas();
$categoriaCanalPsico = buscaCategoCanalPsico(); 

if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
$pendiente = cargaPendientesPsico();
$tresDiasHabAntes = new DateTime();
$idal= $_GET['id'];
// resta 3 días hábiles
$contador_dias = 0;
while ($contador_dias < 3) {
  // resta un día
  $tresDiasHabAntes->modify('-1 day');

  // comprueba si el día es hábil
  $dia_semana = $tresDiasHabAntes->format('N');
  if ($dia_semana < 6) { // días hábiles son de lunes a viernes (1-5)
    $contador_dias++;
  }
}


?>
<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 form-control">
     <div class="row">
                <p class="text-center"><a href="../../vistas/psicopedagogico/pprincipal.php">
                 <img class="img-menu" src="../../img/icons/psicologa.jpg" alt="Psicopedagógico"></a></p>
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
<!-- inicia -->
<div class="row"></div>
<div class="col-lg-2 "></div>
<div class="col-lg-8 ">
        <div class="row form-control"> <!-- INICIO CENTRO -->
       
        <div class="col-12"> <h5 class="text-center"><b> Caso inicial </b></h5></div>
            <!-- se llaman datos del alumno -->
           <?php 
          //busca datos del estudiante
           $idalget = buscaAlumno($caso[0]->estudiantes_idestudiantes); //carga al alumno
             //se prepara para juntar el nombre
          $alumno = $idalget[0]->nombre." ".$idalget[0]->apaterno." ".$idalget[0]->amaterno;
          $grupo = $idalget[0]->grupo;

           ?>
              <div class="col-lg-4 "> <b>Folio:</b>  <?=" ".$caso[0]->idatencion_psico?></div>
              <div class="col-lg-4 "><b>Nombre:</b> <?=$alumno?></div>
              <div class="col-lg-4 "> <b>Fecha: </b><?=" ".$caso[0]->fecha?></div>
            
              <div class="col-lg-4"><b>Grupo: </b> <?=$grupo?></div>
              <div class="col-lg-4"><b>Motivo: </b> <?=$caso[0]->motivo?></div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "><b>Descripción:</b> <?=$caso[0]->descripcion?></div>
              <div class="row"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-3"></div>
             
            </div>
              
            </div>
    <br>
    <div class="row">
      <div class="text-center"><h1>Registrar canalización</h1></div>
            <form action="../../controlador/psicopedagogico/canalizarPsico.php" autocomplete="off" id="formulario" method="post">
                <!--  campo de la fecha  -->
                <div class="form-group " id="grupo__fecha">
                <div class="form-group-input  ">
                            <label for="fecha" class="form-label form-control2"> <b> Fecha:</b>
                            <input type="hidden"  id= "alumno" name="alumno" value=<?=$caso[0]->estudiantes_idestudiantes?>>
                            <input type="hidden"  id= "folio" name="folio" value=<?=$caso[0]->idatencion_psico?>>
                            <input type="date" required name="fecha" id="fecha" value="<?=$today?>" max="<?=$today?>" min="<?=$tresDiasHabAntes->format('Y-m-d')?>">
                                <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                           
                            </label>
                    <div class="form-message" id="mensaje_error__fecha">
                        <p>Escribe una descripción, debe contener letras y números pero no carácteres especiales</p>
                    </div>
                    </div> 
                    </div> 
                <!-- Aqui esta el campo de la descripcion  -->
                <div class="form-group " id="grupo__descripcion">
                    <div class="form-group-input  ">
                                <label for="descripcion" class="form-label form-control2"> <b> Descripción</b>
                                <input type="text" required spellcheck="true" lang="es"  onkeyup=" validarDesc()" class="form-control" id="descripcion" name="descripcion">
                                    <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                                
                                </label>
                        <div class="form-message" id="mensaje_error__descripcion">
                            <p>Escribe una descripción, debe contener letras y números pero no carácteres especiales</p>
                        </div>
                    </div> 
                 </div> 
                
                  <!--input especialistas-->
                  <div class="form-group " id="grupo__especialista">
                         <div class=" form-group-input">
                            <label for="especialista" class="form-label form-control2"> <b> Especialista:</b>
                                <div class="row align-items-start">
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">    
                                            <select title="Categoría" class="form-control" name="especialista" id="especialista"> 
                                                <option class=""value="0" >Elige una especialista</option>
                                                <?php foreach($especialistas as $esp):?>
                                                    <option value="<?=$esp->idespecialista_canaliza?>"><?=$esp->especialista?></option>
                                                 <?php endforeach?>
                                            </select> 
                                                    <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                                    </div>
                                            </label>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <a title =" Agregar Especialista" data-bs-toggle="modal" data-bs-target="#registroEspecialista" data-bs-whatever="@mdo" class="btn btn-primary align-items-center " ><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="form-message" id="mensaje_error__especialista">
                                                <p>Debes elegir alguna opción de Especialista</p>
                                    </div>
                                </div>
                            <br>
                            <!-- termina especialistas -->
                               <!--input categoria-->
                  <div class="form-group " id="grupo__categoria">
                         <div class=" form-group-input">
                            <label for="categoria" class="form-label form-control2"> <b> Categoría:</b>
                                <div class="row align-items-start">
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">    
                                            <select title="Categoría" class="form-control" name="categoria" id="categoria"> 
                                                <option class=""value="0" >Elige una categoria</option>
                                                <?php foreach($categoriaCanalPsico as $c):?>
                                                    <option value="<?=$c->idcategoria_canaliza_psico?>"><?=$c->categoria?></option>
                                                 <?php endforeach?>
                                            </select> 
                                                    <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                                    </div>
                                            </label>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <a title =" Agregar Categoría" data-bs-toggle="modal" data-bs-target="#registroCategoria" data-bs-whatever="@mdo" class="btn btn-primary align-items-center " ><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="form-message" id="mensaje_error__categoria">
                                                <p>Debes elegir alguna opción de categoría psicológica</p>
                                    </div>
                                </div>
                            <br>
                            <!-- termina categorias -->
                            <button class="btn btn-success"  onclick="validarFormularcio(event)" type="submit"> Guardar</button>
                   

            </form>
        </div>
        </div>
    </div> 
<!-- termina --><!-- FIN CENTRO -->
<!--contenedor central -->
      </div>
      </div>
        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control">
    <!--contenedor derecha -->
contenedor derecha
    <!--contenedor derecha -->

        </div>
    </div>
</div>
   <!-- Modal -->

  <!-- Modal para insertar categoria -->

  <div class="modal fade" id="registroCategoria" tabindex="-1" aria-labelledby="registroCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="registroCategoriaLabel">Guardar nueva categoría</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form id="fmiCategoria" action="../../controlador/psicopedagogico/nuevaCategoriaCanalizacion.php" method="post">
        <div class="form-group " id="grupo__miCategoria">
                            
                            <div class="form-group-input  ">
                            <label for="miCategoria" class="form-label form-control2"> <b> Nueva Categoria:</b>
                          
                            <input type="hidden"  id= "alumnomiCategoria" name="alumno" value=<?=$idal?>>
                            <input type="text" spellcheck="true" lang="es"  onkeyup="validaMiCategoria()" class="form-control" id="miCategoria" name="miCategoria">
                                <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                            </div>
                            </label>
                    <div class="form-message" id="mensaje_error__miCategoria">
                        <p>Debes escribir un Categoria, solo se permiten letras</p>
                    </div>
                    </div> 

      
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-6"> <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></div>
            <div class="col-6"> <input  onclick="validaMC(event)" type="submit"  id="bCategoria"class="btn btn-success" value="Guardar">
            </form>
        
      </div></div>
        </div>
       
       
    </div>
  </div>
</div>

    
    <!-- termina modal para insertar categoria-->
      <!-- Modal para insertar Especialista -->

<div class="modal fade" id="registroEspecialista" tabindex="-1" aria-labelledby="registroEspecialistaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="registroEspecialistaLabel">Guardar nuevo especialista</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form id="fmiEspecialista" action="../../controlador/psicopedagogico/nuevaEspecialistaCanalizacion.php" method="post">
        <div class="form-group " id="grupo__miEspecialista">
                            
                            <div class="form-group-input  ">
                            <label for="miEspecialista" class="form-label form-control2"> <b> Nuevo Especialista:</b>
                          
                            <input type="hidden"  id= "alumnomiEspecialista" name="alumno" value=<?=$idal?>>
                            <input type="text" spellcheck="true" lang="es"  onkeyup="validaEspecialidad()" class="form-control" id="miEspecialista" name="miEspecialista">
                                <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                            </div>
                            </label>
                    <div class="form-message" id="mensaje_error__miEspecialista">
                        <p>Debes escribir un Especialista, solo se permiten letras</p>
                    </div>
                    </div> 

      
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-6"> <button type="button"  class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></div>
            <div class="col-6"> <input  onclick="" type="submit"  onclick = "validaME(this)" id="bEspecialista"class="btn btn-success" value="Guardar">
            </form>
        
      </div></div>
        </div>
       
       
    </div>
  </div>
</div>

    
    <!-- termina modal para insertar Especialista-->
 <script src="../../js/colapsables.js"></script>
 <script src="../../js/validaCanalPsico.js"></script>
<?php require '../complementos/footer_2.php';?>


