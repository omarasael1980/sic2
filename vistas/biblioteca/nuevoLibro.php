<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";

$espacios="       ";
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}
date_default_timezone_set("America/Tijuana"); 
$hoy= date("Y-m-d");
$min = date("Y-m-d",strtotime($hoy."- 7 days"));
$max = date("Y-m-d",strtotime($hoy."+ 5 days"));

if(isset($_POST)){
    if(isset($_POST['libro'])){
        if($_POST['libro'] != ""){
                    $libro = $_POST['libro'];
                    $idlibro = buscaLibroXTitulo($libro);
            if($idlibro !=""){
            
                $ejemplares = buscaEjemplaresPorLibro($idlibro[0]->idlibros);
                $bibliotecarios = buscaBibliotecarios();
                $procedencia = buscaProcedencia();
            }else{
                //se manda error de que no puede estar el campo vacio
              
            }
            }else{ 
                header("Location:./nuevoLibro.php");
            }
                 
                }
}
if(isset($_GET['id'])){
$proceso="nuevoLibro";
$editorial = buscaEditoriales(); 
}
if(isset( $_SESSION['msg'])){
    $mensaje =  $_SESSION['msg']['msg'];
    $tipo = $_SESSION['msg']['tipo'];
    if($tipo == "success"){ $encabezado = "Excelente!";}else{ $encabezado = "Lo siento!";}
    echo"<script   type= text/javascript >
  
    Swal.fire(
    '$encabezado',
    '$mensaje',
    '$tipo'
  )
  
  </script>";
  unset($_SESSION['msg']);
  }
?>


<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
         <div class="row">
                 <center><a href="usuariosPrincipal.php">
                 <img class="img-menu" src="../../img/icons/settings2.png" alt="enfermeria"></a></center>
        </div>
        <div class="row">
                
                    <h4 class="text-center">Ajustes</h4>
                
        </div>
        <div class="row">
        
              
        <div class="list-group">
        
                 <!--Menu desplegable-->
                
                 <a href="../usuarios/usuariosPrincipal.php?id=0" class=" <?=$id0?> list-group-item text-center list-group-item-action " aria-current="true">
                 <p> <i class="fa-solid fa-list-check"></i><?=$espacios?>Generales</p>  </a>
                  <!-- menu desplegable ususarios -->
                 
                <br>  <div class="dropdown">
                    <a class="btn btn-primary list-group-item text-center list-group-item-action" data-bs-toggle="collapse" 
                     data-bs-target="#collapse" aria-expanded="false" aria-controls="collapseWidthExample">
                      <p><i class="fa-solid fa-user-tie"></i>
                     Ajustes de usuarios</p>
                    </a>
                    <div class="collapse"  id="collapse" >
                      <br><a class="nav-button-cargar2" href="../usuarios/crearUsuarios.php"><p>
                        <i class="fa-solid fa-plus"></i>Agregar Usuarios</p>
                        </a>
                      <br><a class="nav-button-cargar2" href="../usuarios/editaUsuarios.php"><p><i class="fa-solid fa-user-pen"></i> Editar Usuarios</p></a>
                      <br><a class="nav-button-cargar2" href="../usuarios/permisosUsuario.php"><p><i class="fa-solid fa-pen"></i> Editar Permisos</p></a>
                    </div>
                  </div>
                  <!-- termina menu desplegable usuarios -->
                     <!-- menu desplegable bibluoteca -->
                 
                <br>  <div class="dropdown">
                    <a class="list-group-item text-center list-group-item-action" data-bs-toggle="collapse" 
                     data-bs-target="#collapseBiblioteca" aria-expanded="false" aria-controls="collapseWidthExample">
                    <p> <i class="fa-solid fa-book"></i> 
                      Ajustes de Biblioteca</p>
                    </a>
                    <div class="collapse"  id="collapseBiblioteca" >
                      <br><a class="nav-button-cargar2" href="../biblioteca/nuevoLibro.php"><p>
                      <i class="fa-solid fa-plus"></i>Alta de libro</p> </a>
                      <br><a class="nav-button-cargar2" href="../biblioteca/editaEjemplar.php"><p><i class="fa-solid fa-pen"></i> Editar Ejemplares</p></a>
                      <br><a class="nav-button-cargar2" href="../biblioteca/binventario.php?idprocedencia='Ajustes"><p><i class="fa-brands fa-hive"></i> Asignar custodia de libro</p></a>
                    </div>
                  </div>
                  <!-- termina menu desplegable biblioteca -->
                         <!-- menu desplegable enfermeria -->
                 
                         <br>  <div class="dropdown">
                        <a href="../usuarios/usuariosPrincipal.php?id=3" class=" <?=$id3?> list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-list-check"></i><?=$espacios?>Enfermería</p>  </a>
                           
                          </div>
                  <!-- termina menu desplegable enfermeria -->
                     <!-- menu desplegable Psicopedagogia -->
                 
                <!-- <br>  <div class="dropdown">
                    <a class="list-group-item text-center list-group-item-action" data-bs-toggle="collapse" 
                     data-bs-target="#collapsePsicopedagogica" aria-expanded="false" aria-controls="collapseWidthExample">
                    <p> <i class="fa-solid fa-head-side-virus"></i> 
                      Ajustes de Psicopedagogía</p>
                    </a>
                    <div class="collapse"  id="collapsePsicopedagogica" >
                      <br><a class="nav-button-cargar2" href="../biblioteca/nuevoLibro.php"><p>
                      <i class="fa-solid fa-plus"></i>Alta de libro</p> </a>
                      <br><a class="nav-button-cargar2" href="../biblioteca/editaEjemplar.php">Editar Ejemplares</a>
                      <br><a class="nav-button-cargar2" href="../biblioteca/binventario.php?idprocedencia='Ajustes">Asignar custodia de libro</a>
                    </div>
                  </div> -->
                  <!-- termina menu desplegable enfermeria -->
                
              
               
             
               
  </div>
        
</div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 ">
          <!--contenedor central -->
          <div class="container"><!--inicia contenedor principal-->
        <div class="row"><!--inicia row titulo-->
                    <!--Contenido principal de la pagina-->
               <h1 class="text-center">Alta de libros</h1>
                <br>
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-0 com-xs-0"></div>
                    <div class="col-lg-10 col-md-10 col-sm-12 com-xs-12"><hr></div>
                </div>
                
      </div>  <!--termina contenedor titulo-->  
      <?php if(!isset($proceso)):?> 
           <!--filtra libros-->   

        <div class="row">
      
                <?php if(!isset($ejemplares)):?>
                <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <form action="nuevoLibro.php" id="formulario1" class="form-control2"method="post" autocomplete="off">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"> <label for="libro">Buscar Libro:</label> </div> 
                                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8">
                                    <input type="text" required class="form-control" value =""name="libro" id="libro">
                                    <ul id="listaLibro"></ul>  </div> 
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"> 
                                    <button class="form-control nav-button-cargar">Seleccionar</button>           
                                    </div>
                                    <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6"><a href="nuevoLibro.php?id=1" class="form-control nav-button-cargar"><center>Nuevo Libro</center></a></div>
                                </div>
                            </div> 
                            <div class="row"><label for="error" hidden class="form-message form-message-active" id="error" name="error"></label></div>
                        </form>
                       
                </div>
        </div>
                 
               
                
                    
             
                
                <?php else:?>
       
           
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
               
                <form action="../../controlador/biblioteca/registroNuevoEjemplar.php" method="post" class="form-control2">
                    <input type="hidden" name="idlibros" value="">
                  <div> <p><b> Título:</b></p><h1><?=$libro?></h1></div>
                  <br>
                  <hr>
                  <?php $i=1;?>
                  <h3 class="text-center">Ejemplares encontrados:</h3>
                 <?php if ($ejemplares != ""):?>
                  <?php  foreach($ejemplares as $e):?>
                    <div class="row">
                            
                             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-control2">Ejemplar: <?=$e->ejemplar?></div>
                             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-control2">Fecha de Alta: <?=$e->fecha_alta?></div>
                             <?php if(!$e->fecha_baja==""):?>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 form-control2">Fecha de Baja: <?=$e->fecha_baja?></div>
                            <?php endif; ?>
                    </div>
                    <div class="row">
                        <br>
                             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-control2">Observaciones: <?=$e->observaciones?></div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 "><label for="custodia">Custodia:</label></div>
                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 "><select class="form-control2"name="idUsuario" id="">
                            <?php foreach($bibliotecarios as $b):?>
                                <option disabled value="<?=$b->idUsuario?>"
                                <?php if($b->idUsuario == $e->usuario_idUsuario){echo 'selected';}?>
                                ><?=$b->nombre." ".$b->apaterno." ".$b->amaterno?></option>
                                <?php endforeach?>
                            </select></div>
                            <?php $i=$i+1;?>
                    </div>
                    <hr>
                    <?php endforeach?>
                    <?php else:?>
                        <h6 class="text-center"> <b>Aún no hay ejemplares registrados</b></h6>
                    <?php endif?>
                    <br>
                  
                    
                    <h3 class="text-center">Dar de alta ejemplar <?=$i?> del libro "<?=$libro?>"</h3> <br><br>
                    <h3 class="text-center">Llena los siguientes campos</h3>
                    <br><br>
                    <div class="row"> 
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"> </div> 
                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 form-control2" >
                            <input type="hidden" name="idlibro" value="<?=$idlibro[0]->idlibros?>">
                        <br> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">Nuevo Ejemplar:   <input readonly type="text" value="  <?=$i?>" name="ejemplarNuevo"  ><br></div>
                        <br><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">Fecha de Alta:
                            <input class="form-control"  required type="date" min ="<?=$min?>" max="<?=$max?>"value="<?=$hoy?>"name="f_alta" id=""><br></div>
                        <br><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                        Procedencia: <select class="form-control" name="procedencia" id="">
                            <?php foreach($procedencia as $pr):?>
                                <option value="<?=$pr->idProcedencia?>"><?=$pr->procedencia?></option>
                                <?php endforeach?>
                        </select><br></div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
                        Asignar a:   <select class="form-control"name="custodiaNejemplar" id="">
                            <?php foreach($bibliotecarios as $b):?>
                                <option  value="<?=$b->idUsuario?>"                            
                                ><?=$b->nombre." ".$b->apaterno." ".$b->amaterno?></option>
                                <?php endforeach?>  
                            </select><br>
                        </div>
                        </div>
                    </div>
                    <br>
                        <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"> </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"><button type="submit" class="form-control2 nav-button-cargar">Guardar</button></div>
                        <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6"> <a href="nuevoLibro.php" class="form-control nav-button-cargar"> <center>Cancelar</center> </a></div>
                        </div> 
                    
                    </div>
                    
                </form>
            </div>
         
        </div>
                <?php endif?>

           
    </div>
      <!--termina filtra libros-->  
      <?php else:?>
           <!--inicia nuevo libros-->  
           <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"></div>
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10">
          
          <form action="../../controlador/biblioteca/registranuevoLibro.php" class="form-control2 formulario" id="formulario" method='post'autocomplete="off">
                <div class="form-group " >
                                       
                 <div class="row"> 
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><h1 class="text-center">Ingresa los datos del nuevo libro </h1></div>
               
                         </div>
                   
                </div>
                <div class="form-group row " id="grupo__titulo">
                     
                        <div class="form-group-input form-control2  ">
                        <label for="titulo" class="form-label form-control2"> <b> Título:</b>
                             <input class="form-control img-container " type="text" id="titulo"name="titulo" placeholder="titulo">
                             <i class=""><img class="form-validation-state img-input" id="img-titulo"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                        </label>
                   <div class="form-message" id="mensaje_error__titulo">
                    <h6 class="text-center"><b> Puede contener letras y números </b></h6>
                   </div>
                </div>
                    <br>
                    <!--autor-->
                <div class="form-group row " id="grupo__autor">
                     <div class=" form-group-input ">
                     <label for="autor" class="form-label form-control2"> <b> Autor:</b>
                          <input class="form-control img-container " type="text" id="autor" name="autor" placeholder="Autor">
                          <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     <div class="form-message" id="mensaje_error__autor">
                    <h6 class="text-center"><b>Solo puede contener letras mayúsculas y minúsculas</b></h6>
                    </label>   
                    </div>
                </div>
                    <!--editorial-->
                    <div class="form-group " id="grupo__editorial row">
                     <div class=" form-group-input col-lg-9 col-md-8 col-sm-8 col-xs-8">
                     <label for="editorial" class="form-label form-control2"> <b> Editorial:</b>
                         <select name="editorial" id="editorial" class="form-control">
                         <?php foreach($editorial as $ed):?>
                            <option value="<?=$ed->idEditorial?>"><?=$ed->editorial?></option>
                            <?php endforeach?>
                        </select>
                     </div>
                     <div  class=" form-group-input col-lg-3 col-md-4 col-sm-4 col-xs-4">
                        <div class="row">
                        <b> <center>Nueva Editorial:</center><b>
                        </div>
                        <div class="row">
                        <center><a href="nuevaEditorial.php"><img class="icono-seguimiento"src="../../img/icons/plus.png" alt=""></a></center> 
                        </div>
                    
                     </div>
                     <div class="form-message" id="mensaje_error__Editorial">
                    <h6><b>Elige una opción</b></h6>
                    </label>   
                    </div>
                </div>
                     <!--isbn-->
                     <div class="form-group row" id="grupo__isbn">
                     <div class=" form-group-input">
                     <label for="isbn" class="form-label form-control2"> <b> ISBN:</b>
                          <input class="form-control img-container "id="isbn" type="text" name="isbn" placeholder="isbn">
                          <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     <div class="form-message" id="mensaje_error__isbn">
                    <p><b>Este campo admite solo números, deben ser 13 caracteres</b></p>
                    </label>   
                    </div>
                </div>
                      <!--fin-->
                     <br>
                     <br>
                     <div class="form-message  me_formulario" id="mensaje_error__formulario">
                    <h6 class="text-center"><b>Debes llenar todos los campos correctamente de acuerdo a las indicaciones</b></h6>
                   </div>
             </div>
            
                
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs12"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs12">
                    <p class="center "><button class="nav-button-cargar form-control" type="submit">
                     Guardar Libro</button></p> 
                    </div>
                </div>
              
               
            </form>
            
        </div>
       
    </div>
        <?php endif?>
    
            <!--contenedor central -->
</div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
     
    </div>
</div>

      <!--js-->
      ````<script src="../../js/errorNuevoLibro.js"></script>
               <script src="../../js/filtraLibros.js">        </script>
               <script src="../../js/validaNuevoLibro.js">        </script>
             
           <?php require '../complementos/footer_2.php';?> 