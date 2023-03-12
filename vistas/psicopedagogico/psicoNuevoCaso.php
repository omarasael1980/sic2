
<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';

require '../../modelo/config/comunes.php';
require '../../modelo/psicologia/psico.php';


$today =  date('Y-m-d');
if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
if(isset($_GET['id']) ){
    
$idalget = buscaAlumno($_GET['id']);
$alumno = $idalget[0]->nombre." ".$idalget[0]->apaterno." ".$idalget[0]->amaterno;
$grupo = $idalget[0]->grupo;
$idal = $idalget[0]->idestudiantes;

}

if(isset($_POST["alumno"])){
 
 $a = $_POST["alumno"];
 if(strpos($a, '/') == false){
//si no contiene / no existe en la base de datos y redirige a la misma pagina pero sin post
header("Location:./psicoNuevoCaso.php");
 }else{
    //si existe / entonces existe en la base de datos y carga los datos
 $al = explode("/",$a);
 $alumno = $al[0]." ".$al[1]." ".$al[2];
 $grupo =$al[3];
 $idal= $al[4];

 }
}
$categorias = cargaCategoriasPsico();
$motivos = cargaMotivosPsico();
?>


<!-- body  -->
<div class="container2 ">
  
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 form-control2 ">
     <div class="row ">
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
                  <a href="pprincipal.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                  <p> <i class="fa-solid fa-bars"> </i> <?=$espacios?>Pendientes</p>  </a>
                 <a class="btn btn-primary list-group-item text-center list-group-item-action" href="psicoNuevoCaso.php"><p><i class="fa-solid fa-file-circle-plus"></i><?=$espacios?> Nuevo caso </p></a>
                 <a href="#" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                 <a href="#" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                 <a href="#" class="list-group-item text-center  list-group-item-action"><p><i class="fa-solid fa-route"></i><?=$espacios?>Canalizaciones</p> </a>
         </div>
                
            </div>

     </div>
      
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-control2">
<!--contenedor central -->
<h1 class="text-center">Nuevo Caso</h1>
<div class="row">
    <div class="container">
        <div class="row">
            <!--Seleccionar alumno 
        Si en no se conboce el alumno no se muestra-->
        <?php if(!isset($alumno)):?>  
        <form action="psicoNuevoCaso.php"  class="" method="post" autocomplete="off">
               
                <div class="col-lg-4 col-md-1 col-sm-2 col-xs-2"><label for="alumno" class="form-control2"><center><b> Buscar Alumno:</b></center></label></div>
                <div class="col-lg-8 col-md-4 col-sm-6 col-xs-10">
                    
                
                   
                            <input type="text" required class="form-control"name="alumno" id="alumno">

                        <ul id="lista">
                        
                             </ul>
                  
                  </div>
               
                  <div class="col-lg-4 col-md-3 col-sm-1 col-xs-0"></div>
                    <div class="col-lg-4 col-md-2 col-sm-3 col-xs-12">
                        <button class="form-control btn btn-success">Cargar Expediente</button>
                     
                  </div>
               
          </form>
          <?php else:?>
            <!--Se muestra el alumno seleccionado-->
         <h3 class="text-center"> Alumno: <?=$alumno?></h3>   <br><h3 class="text-center"> Grupo: <?=$grupo?> <br></h3>
         
 <div class="row">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-0"></div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <a class="btn btn-danger " href="psicoNuevoCaso.php">
            <i class="fa-solid fa-door-closed"></i>Cerrar </a>
            
    </div>
    <!--fin de datos de alumno-->
 </div>
 <div class="row">
    <!--Se abre atencion psicologica-->
   
    <form class="form-control2" action="../../controlador/psicopedagogico/insertaNuevoEvento.php" class="formulario" id="formulario" method='post'autocomplete="off">
                 <hr >
                        <h3 class="text-center">Registrando nuevo evento:</h3>  
                        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
            <!--centrado del div y ajuste de anchura diferentes pantallas--> 
                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">  
                    <!--input fecha-->
                    <div class="form-group " >
                            <div class="row">
                                <center><a href=""><img class=" img-menu"
                                src="../../img/icons/psicologa2.jpg" alt="nuevo evento">  </a> </center>
                            </div> 
                       
                        </div>
                        <div class="form-group" id="grupo__fecha">
                            
                                <div class="form-group-input  ">
                                    <label for="fecha" class="form-label"> <b> Fecha:</b>
                                    <input type="hidden"  id= "alumno" name="alumno" value=<?=$idal?>>
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
                           
                            <br>
                              <!--input categoria-->
                              <div class="form-group " id="grupo__categoria">
                            
                            <div class=" form-group-input">
                            <label for="categoria" class="form-label form-control2"> <b> Categoría:</b>
                                <div class="row align-items-start">
                           
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                          
                                            <select title="Categoría" class="form-control" name="categoria" id="categoria"> 
                                                <option class=""value="0" >Elige una categoria</option>
                                                <?php foreach($categorias as $cat):?>
                                                    <option value="<?=$cat->idcategoria_psico?>"><?=$cat->categoria_psico?></option>
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
                                                <p>Debes elegir alguna opción de categoría</p>
                                    </div>
                                </div>
                           
                            <br>
                              <!--input descripcion-->
                      
                        <div class="form-group " id="grupo__descripcion">
                            
                                <div class="form-group-input  ">
                                <label for="descripcion" class="form-label form-control2"> <b> Descripción:</b>
                              
                           <textarea name="descripcion"spellcheck="true" lang="es"  onkeyup="validadescripcion2(this.value)" id="descripcion" required class="form-control"></textarea>
                                    <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                                </div>
                                </label> 
                        <div class="form-message" id="mensaje_error__descripcion">
                            <p>Debe tener una descripción clara del evento inicial.</p>
                        </div>
                        </div>
                        
                            <br>
                           <!-- dar seguimiento -->
                           <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="darSeguimiento"value="1" id="darSeguimiento" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                  Dar seguimiento
                                </label>
                          </div>
                             <!--Mensaje de error-->
                            <br>
                            <div class="form-message  me_formulario" id="mensaje_error__formulario">
                            <p><center> <b><h3>Debes llenar todos los campos</h3></b></center> </p>
                        </div>
                        <?php if(isset($_GET['tipo'])):?>
                                
                                <div class="form-message  me_formulario-active" id="mensaje_error__formulario">
                            <p><center> <b><h3><?=$_GET['msg']?></h3></b></center> </p>
                        </div>
                                <?php endif?>
                    </div>
                    
                        
                        <br>
                        <!-- boton de submit del formulario -->
                        <button   name = "bEnviar" onclick="validarForm(event)" class="btn btn-primary form-control" id="bEnviar" value="Guardar">Guardar</button>
                    
                </div>
            </form>
 </div>
 
  <?php endif?>
        </div>

    </div>
</div>
</div>
</div>

<!-- espacio abajo central -->

</div>
<!--contenedor central -->
    
        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->

    <!--contenedor derecha -->

        </div>
 
</div>
<script src="../../js/peticiones.js">        </script> 
<script src="../../js/validacionesNuevoPsico.js"> </script>

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
                          
                            <input type="hidden"  id= "alumnomiMotivo" name="alumno" value=<?=$idal?>>
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
            <div class="col-6"> <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></div>
            <div class="col-6"> <input  onclick="validaMiMotivo(event)" type="submit"  id="bMotivo"class="btn btn-success" value="Guardar">
            </form>
      </div></div>
        </div>
       
       
    </div>
  </div>
</div>

    
    <!-- termina modal para insertar motivo-->
    <!-- Modal para insertar categoria -->

<div class="modal fade" id="registroCategoria" tabindex="-1" aria-labelledby="registroCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="registroCategoriaLabel">Guardar nueva categoría</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form id="fmiCategoria" action="../../controlador/psicopedagogico/nuevaCategoria.php" method="post">
        <div class="form-group " id="grupo__miCategoria">
                            
                            <div class="form-group-input  ">
                            <label for="miCategoria" class="form-label form-control2"> <b> Nueva Categoria:</b>
                          
                            <input type="hidden"  id= "alumnomiCategoria" name="alumno" value=<?=$idal?>>
                            <input type="text" spellcheck="true" lang="es"  onkeyup="revisaMay('miCategoria')" class="form-control" id="miCategoria" name="miCategoria">
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
            <div class="col-6"> <input  onclick="validaMiCategoria(event)" type="submit"  id="bCategoria"class="btn btn-success" value="Guardar">
            </form>
        
      </div></div>
        </div>
       
       
    </div>
  </div>
</div>

    
    <!-- termina modal para insertar categoria-->
   
<?php require '../complementos/footer_2.php';?>