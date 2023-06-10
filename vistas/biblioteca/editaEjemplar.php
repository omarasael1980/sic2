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
if(isset($_GET['idejemplar'])){
    $buscaEjemplar = buscaEjemplaresPorEjemplar($_GET['idejemplar']);
$proceso="editaEjemplar";
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
<!--                  
                <br>  <div class="dropdown">
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
               <h1 class="text-center">Editar Ejemplares</h1>
                
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-0 com-xs-0"></div>
                    <div class="col-lg-10 col-md-10 col-sm-12 com-xs-12"><hr></div>
                </div>
                
      </div>  <!--termina contenedor titulo-->  
      <?php if(!isset($proceso)):?> 
           <!--filtra libros-->   

        <div class="row">
      <!-- Cuando se carga la pagina si  no  eligio ejemplares -->
                <?php if(!isset($ejemplares)):?>
                <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <form action="editaEjemplar.php" id="formulario1" class="form-control2"method="post" autocomplete="off">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"> <label for="libro">Buscar Libro:</label> </div> 
                                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8">
                                    <input type="text" required class="form-control" value =""name="libro" id="libro">
                                    <ul id="listaLibro"></ul>  </div> 
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"> 
                                    <button class="form-control nav-button-cargar">Seleccionar</button>           
                                    </div>
                                    
                                </div>
                            </div> 
                            <div class="row"><label for="error" hidden class="form-message form-message-active" id="error" name="error"></label></div>
                        </form>
                       
                </div>
        </div>
                 
               
                
                    
             
            
                <?php else:?>
       <!-- SI ya se eligio ejemplares -->
               
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
               
                  <div> <h3><b> Título:</b></h3><h1><?=$libro?></h1></div>
                  
                  <hr>
                  <?php $i=1;?>
                  <h3 class="text-center">Ejemplares encontrados:</h3>
                  <hr>
                  <!-- Si existen ejemplares -->
                 <?php if ($ejemplares != ""):?>
                  <?php  foreach($ejemplares as $e):?>
                    <div class="row antecedentes m-0 p-0">
                            
                             <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 form-control2 m-0 p-0">Ejemplar: <?=$e->ejemplar?> </div>
                             <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 form-control2 m-0 p-0">Fecha de Alta: <?=$e->fecha_alta?></div>
                             <?php if(!$e->fecha_baja==""):?>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-control2 m-0 p-0">Fecha de Baja: <?=$e->fecha_baja?></div>
                            <?php endif ?>
                    <!-- </div>
                    <div class="row m-0 p-0"> -->
                    
                            
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 m-0 p-0"><label for="custodia">Custodia:
                                
                                   
                            <?php foreach($bibliotecarios as $b):?>
                             
                                <?php if($b->idUsuario == $e->usuario_idUsuario):?>
                                <?=$b->nombre." ".$b->apaterno." ".$b->amaterno?>
                                <?php endif ?>
                                <?php endforeach?>
                                </label></div>
                            <?php $i=$i+1;?>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 form-control2 m-0 p-0">Observaciones: <?=$e->observaciones?></div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" > <a class="nav-button-chico" href="editaEjemplar.php?idejemplar=<?=$e->idEjemplar?>">
                                    <i class="fa-solid fa-pencil"></i></a></div>
                        </div>
                    <hr>
                    <?php endforeach?>
                    <?php else:?>
                        <h6 class="text-center"> <b>Aún no hay ejemplares registrados</b></h6>
                    <?php endif?>
                    <br>
                  
                    
                    
                    </div>
           
            </div>
         
        </div>
                <?php endif?>

           
    </div>
      <!--termina filtra libros-->  
     
        
        <?php endif?>

      <?php if( isset($proceso)):?>
            <?php if ($proceso == 'editaEjemplar'):?>
                    <?php if(isset($buscaEjemplar)):?>
                        <?php foreach($buscaEjemplar as $e):?>
                                <div class="row antecedentes">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <h6><b>Libro: <?=$espacios.$e->titulo?></b></h6>  </div>
                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12"><h6><b>Autor: <?=$espacios.$e->autor?></b></h6></div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><h6><b>Editorial: <?=$espacios.$e->editorial?></b></h6></div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><h6><b>Procedencia: <?=$espacios.$e->procedencia?></b></h6></div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><h6><b>Custodia: <?=$espacios.$e->nombre." ".$e->apaterno." ".$e->amaterno?></b></h6></div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><h6><b>ISBN: <?=$espacios.$e->isbn?></b></h6></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                    <form class="col-lg-8 col-md-8 col-sm-10 col-xs-12 miform form-control2"action="../../controlador/biblioteca/editaEjemplar.php" method="post">
                                        <input type="hidden" class="form-control" name="idEjemplar" value="<?=$e->idejemplar?>">
                                        Ejemplar:
                                        <input type="text" class="form-control" name="ejemplar" disabled value="<?=$e->ejemplar?>">
                                        Fecha de alta:
                                        <input type="date" class="form-control" min="2021/08/19" max="<?=$hoy?>"name="fecha_alta" value="<?=$e->fecha_alta?>">
                                      
                                        Observaciones:
                                        <input type="text" class="form-control" name="observaciones" value="<?=$e->observaciones?>">
                                        <div class="row">
                                        <br>
                                            <div class="col-lg-4 col-sm-3 col-md-4 col-xs-0"></div>
                                            <div class="col-lg-4 col-sm-3 col-md-4 col-xs-12">      
                                                 <button class="nav-button-cargar"type="submit">Guardar</button>
                                                </div>
                                         
                                     
                                        </div>
                                    </form>
                                </div>
                        <?php endforeach?>
                    <?php endif?>
            <?php endif?>
        <?php endif?>
            <!--contenedor central -->
</div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
     
    </div>
</div>

      <!--js-->
      <script src="../../js/errorNuevoLibro.js"></script>
               <script src="../../js/filtraLibros.js">        </script>
               <script src="../../js/validaNuevoLibro.js">        </script>
             
           <?php require '../complementos/footer_2.php';?> 