
<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";


if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}

if(isset($_POST)){
    if(isset($_POST['libro'])){
        if($_POST['libro'] != ""){
                    $libro = $_POST['libro'];
                    $idlibro = buscaLibroXTitulo($libro);
if($idlibro !=""){
   
    $ejemplares = buscaEjemplaresPorLibro($idlibro[0]->idlibros);
    $bibliotecarios = buscaBibliotecarios();
    $procedencia = buscaProcedencia();}
}else{ 
    header("Location:./nuevoLibro.php");
}
     
    }else{
       
    }
}
if(isset($_GET['id'])){
$proceso="nuevoLibro";
$editorial = buscaEditoriales();
}
?>


<!-- body  -->
<div class="container"><!--inicia contenedor principal-->
        <div class="row"><!--inicia row titulo-->
                    <!--Contenido principal de la pagina-->
                <center><h1>Alta de libros</h1></center>
                <br>
                <hr>
      </div>  <!--termina contenedor titulo-->  
      <?php if(!isset($proceso)):?> 
           <!--filtra libros-->   

        <div class="row">
      
                <?php if(!isset($ejemplares)):?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10">
                        <form action="nuevoLibro.php" id="formulario1" class="form-control2"method="post" autocomplete="off">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-9">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4"> <label for="libro">Buscar Libro:</label> </div> 
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                                    <input type="text" required class="form-control" value =""name="libro" id="libro">
                                    <ul id="listaLibro"></ul>  </div> 
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"> 
                                    <button class="form-control btn btn-success">Seleccionar</button>           
                                    </div>
                                    <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6"><a href="nuevoLibro.php?id=1" class="form-control btn btn-primary"><center>Nuevo Libro</center></a></div>
                                </div>
                            </div> 
                    
                        </form>
                </div>
        </div>
                 
               
                
                    
             
                
                <?php else:?>
       
           
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"></div>
            <div class="col-lg-8 col-md-3 col-sm-6 col-xs-12">
               
                <form action="../../controlador/biblioteca/registranuevoLibro.php" method="post" class="form-control2">
                    <input type="hidden" name="idlibros" value="">
                  <div> <p><b> Título:</b></p><h1><?=$libro?></h1></div>
                  <br>
                  <hr>
                  <?php $i=1;?>
                  <center><h3>Ejemplares encontrados:</h3></center>
                 
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
                    <br>
                  
                    
                    <center><h3>Dar de alta ejemplar <?=$i?> del libro "<?=$libro?>"</h3></center> <br><br>
                    <center><h3>Llena los siguientes campos</h3></center>
                    <br><br>
                    <div class="row"> 
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"> </div> 
                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 form-control2" >
                            <input type="hidden" name="idlibro" value="<?=$idlibro[0]->idlibros?>">
                        <br> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">Nuevo Ejemplar:   <input readonly type="text" value="  <?=$i?>" name="ejemplarNuevo"  ><br></div>
                        <br><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">Fecha de Alta:<input class="form-control"  required type="date" name="f_alta" id=""><br></div>
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
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"><button type="submit" class="form-control2 btn btn-success">Guardar</button></div>
                        <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6"> <a href="nuevoLibro.php" class="form-control btn btn-danger"> <center>Cancelar</center> </a></div>
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
        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-0"></div>
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
          <br><br><br>
          <form action="../../controlador/biblioteca/registranuevoLibro.php" class="form-control formulario" id="formulario" method='post'autocomplete="off">
                <div class="form-group " >
                                       
                 <div class="row"> 
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><h1 class="">Ingresa los datos del nuevo libro </h1></center></div>
               
                         </div>
                   
                </div>
                <div class="form-group row " id="grupo__titulo">
                     
                        <div class="form-group-input   ">
                        <label for="titulo" class="form-label"> <b> Título:</b>
                             <input class="form-control img-container " type="text" id="titulo"name="titulo" placeholder="titulo">
                             <i class=""><img class="form-validation-state img-input" id="img-titulo"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                        </label>
                   <div class="form-message" id="mensaje_error__titulo">
                    <p>Puede contener letras y números</p>
                   </div>
                </div>
                    <br>
                    <!--autor-->
                <div class="form-group row " id="grupo__autor">
                     <div class=" form-group-input ">
                     <label for="autor" class="form-label"> <b> Autor:</b>
                          <input class="form-control img-container " type="text" id="autor" name="autor" placeholder="Autor">
                          <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     <div class="form-message" id="mensaje_error__autor">
                    <p>Solo puede contener letras mayúsculas y minúsculas</p>
                    </label>   
                    </div>
                </div>
                    <!--editorial-->
                    <div class="form-group " id="grupo__editorial row">
                     <div class=" form-group-input col-lg-9 col-md-8 col-sm-8 col-xs-8">
                     <label for="editorial" class="form-label"> <b> Editorial:</b>
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
                    <p>Elige una opción</p>
                    </label>   
                    </div>
                </div>
                     <!--isbn-->
                     <div class="form-group row" id="grupo__isbn">
                     <div class=" form-group-input">
                     <label for="isbn" class="form-label"> <b> ISBN:</b>
                          <input class="form-control img-container "id="isbn" type="text" name="isbn" placeholder="isbn">
                          <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     <div class="form-message" id="mensaje_error__isbn">
                    <p>Este campo admite solo números, deben ser 13 caracteres</p>
                    </label>   
                    </div>
                </div>
                      <!--fin-->
                     <br>
                     <br>
                     <div class="form-message  me_formulario" id="mensaje_error__formulario">
                    <p><center> <b><h3>Debes llenar todos los campos correctamente de acuerdo a las indicaciones</h3></b></center> </p>
                   </div>
             </div>
            
                
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs12"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs12">
                    <p class="center "><button class="btn btn-primary form-control" type="submit">
                     Guardar Libro</button></p> 
                    </div>
                </div>
              
               
            </form>
            
        </div>
       
    </div>
        <?php endif?>
    
               
                   
               
       
           <!--js-->
           
               <script src="../../js/filtraLibros.js">        </script>
               <script src="../../js/validaNuevoLibro.js">        </script>
             
           <?php require '../complementos/footer_2.php';?> 