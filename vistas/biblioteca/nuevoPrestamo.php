<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require '../../modelo/biblioteca/comunesBiblioteca.php';
$today =  date('Y-m-d');
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
 //   header("Location:../../");
}


date_default_timezone_set("America/Tijuana");


$roles = buscaRoles();
if(isset($_POST['alumno'])){
    if($_POST['alumno'] ==""){
header("Location: nuevoPrestamo.php");
    }else{
    $separador = "/";
    $separada = explode($separador, $_POST['alumno']);
    $nombre = "$separada[0] $separada[1] $separada[2]";
    $grupo = $separada[3];
    $quien=$separada[4];
    $prestamoALumno =buscaPrestamosAlumno($quien);
    //busca los libros del usuario logeado para que cada docente pueda prestar los libros que tiene
    $libros =buscaTodosLibros();
    if(isset($_POST['libros'])){
        
        $libroElegido = $_POST['libros'];
        $libroSeparado = explode("/",$libroElegido);
        $idlibro = $libroSeparado[0]; //id del libro
        $idalumno = $_POST['idalumno'];
        $advertencia = buscaLibroLeidoAlumno($idlibro, $idalumno);
        $titulo =$libroSeparado[1];
        //busca los ehemplares del usuario logeado para que cada docente pueda prestar los ejemplares que tiene
        $ejemplares = buscaEjemplaresPorLibro($idlibro);

    }
       
}
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
                <p class="text-center"><a href="../../vistas/biblioteca/bprincipal.php">
                 <img class="img-menu" src="../../img/icons/libreria.jpg" alt="biblioteca"></a></p>
        </div>
        <div class="row">
                
                    <h4 class="text-center">Biblioteca</h4>
                
        </div>
        <div class="row">
                <h1 class="text-center">Menú</h1>
                <div class="list-group">
                  
                         <!--Menu desplegable-->
                         <a href="bprincipal.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="nuevoPrestamo.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Nuevo Préstamo</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="historialPrestamos.php"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Historial </p></a>
                        <br> <a href="binventario.php" class="list-group-item text-center list-group-item-action"><p> <img class="logos-enfermeria"
                                        src="../../img/icons/inventory.png" alt=""> <?=$espacios?>Inventario </p> </a>
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
         `````` </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
<div class="row"><h1 class="text-center">Nuevo Préstamo</h1></div>
<!-- aqui -->

<?php if(!isset($_POST['alumno'])):?>
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                        <form action="nuevoPrestamo.php"  class="form-control2"  method="post" autocomplete="off">
                        <div>
                            <label for="alumno">Buscar Alumno:</label>
                            <input type="text" class="form-control" name="alumno"  id="alumno">
                            <ul id="lista">        
                                    </ul>
                            </div>
                        <button class="nav-button-cargar form-control">Cargar Alumno</button>
                         </form>
                 </div>
    </div>
           <?php else :?>
            <div class="row">
               <h1 class="text-center"><?=$nombre?></h1>
               <h1 class="text-center"><?=$grupo?></h1>
                <div class="col-lg-5 col-md-1 col-sm-1 col-xs-0"></div>
                <div class="col-lg-2 col-md-10 col-sm-10 col-xs-12">
            <p class="text-center">   <a class="form-control btn btn-danger" href="nuevoPrestamo.php">Regresar</a></p>
               <?php if(isset($_POST['ejemplar'])):?> 
                <br>
                           <h3 class="text-center">Confirmar Préstamo</h3>
                            <br>
                        <?php else:?>
                            <br>
                           <h3 class="text-center">Iniciar Préstamo</h3>
                            <br>
                            <?php endif;?>
            </div>
               <div class="col-lg-5 col-md-1 col-sm-1 col-xs-0"></div>
               </div>
               <div class="row">
               <div class="col-lg-2 col-md-1 col-sm-1 col-xs-0"></div>
                    <div class="col-lg-8 col-md-10 col-sm-10 col-xs-12">
                     <!--columna izquierda formulario para pedir libro-->  
                     <?php if(isset($_POST['ejemplar'])):?> 
                       <form class="form-control" action="../../controlador/biblioteca/nuevoPrestamo.php" method="post">
                        <?php else:?>
                            <form class="form-control" action="nuevoPrestamo.php" method="post">
                            <input type="hidden" name = "idalumno" value="<?=$quien?>">
                        <?php endif?>
                            <div class="form-class">
                                <?php if(isset($_POST['alumno'])):?>
                                    <input type="hidden" name = "idalumno" value="<?=$quien?>">
                                              <input type="hidden" name="alumno" value="<?=$_POST['alumno']?>">
                                        <?php if(isset($_POST['fecha'])):?>
                                               Fecha Seleccionada: <input type="date" required name="fecha" id="fecha"  value ="<?=$_POST['fecha']?>" min="2022-09-11" max="<?=$today?>" class="form-control">
                                            <?php else:?>
                                               Selecciona Fecha: <input type="date" required name="fecha" id="fecha" value="<?=$today?>" min="2022-09-11" max="<?=$today?>" class="form-control">
                                         <?php endif?>
                                <?php endif;?>
                                <?php if(!isset($_POST['libros'])):?>
                                <label for="libros">Selecciona Libro:</label>
                                <select class ="form-control" name="libros" id="libros">
                                <?php foreach($libros as $libro):?>
                                        <option value="<?=$libro->idlibros."/".$libro->titulo?>"><?=$libro->titulo?></option> 
                                <?php endforeach?>
                                </select>
                                <?php else:?>
                                    <input type="hidden" name="libros" value="<?=$idlibro."/".$titulo?>"> 
                                    Libro Elegido<input class="form-control"type="text" enabled="off" name="libro" value="<?=$titulo?>">
                                   <br>
                                <?php if(isset($_POST['ejemplar'])):?> 
                                    Ejemplar seleccionado:
                                    <input type="hidden" class="form-control" name="ejemplar" id="ejemplar"  value="<?=$_POST['ejemplar']?>">
                                    <select class="form-control" name="ejemplar" id="ejemplar">
                                    <?php foreach ($ejemplares as $ejemplar):?>
                                        <option value="<?=$ejemplar->idEjemplar?>" <?php if($ejemplar->idEjemplar ==$_POST['ejemplar']){echo 'selected';}?>><?=$ejemplar->ejemplar?></option>
                                        <?php endforeach?>
                                        </select>
                                <?php else:?>
                                   <!--se hace verificacion de prestamos de ese libro a ese alumno previamente-->
                                   <?php if(isset($advertencia)):?>
                                    <?php if($advertencia !=false):?>
                                        <div class="row">
                                            <div class="form-message  me_formulario-active" id="">
                                            <?php foreach ($advertencia as $adv):?>
                                                        <p class="text-center"><b><h3>El alumno ya leyó este libro (Fecha de Préstamo: <?=$adv->fecha_prestamo?>)</h3></b> </p>
                                              <?php endforeach?>
                                                
                                            </div>    
                                        </div>
                                         <?php endif;?>
                                <?php endif;?>
                                    Selecciona Ejemplar:<select class="form-control" name="ejemplar" id="ejemplar">
                                    <?php foreach ($ejemplares as $ejemplar):?>
                                       
                                        <option value="<?=$ejemplar->idEjemplar?>"><?=$ejemplar->ejemplar?></option>
                                        <?php endforeach?>
                                        </select>
                                        <?php if($ejemplares==false):?>
                                            
    <br>
                                            <div class="form-message  me_formulario-active" id="">
                                                
                                            <h3 class="text-center" style="font-size:small;"><b>
                                            Lo siento pero están agotados estos ejemplares, selecciona otro libro</b></h3>
                                            </div>
                                            <?php endif?>
                                <?php endif;?>
                                     <?php endif;?>
                                    <br>
                        <?php if(isset($_POST['ejemplar'])):?> 
                           
                            <button class="form-control btn btn-success">Guardar Prestamo</button>
                            
                        <?php else:?>

                            <button class="form-control btn btn-primary">Continuar</button>
                        <?php endif?> 
                               
                            </div>
                       </form>
                    </div>
                 
            </div>
            <?php endif?>
    
            
            </div>
  
<!-- aqui -->
            <!--contenedor central -->
          
       
         
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
     
<?php if(isset($prestamoALumno)):?>
    <?php if($prestamoALumno !=""):?>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="background:#FFFF99; font-size: small; border-radius: 20px;">
    <!--contenedor derecha -->
<div class="row">
   
    <h4 class="text-center">Últimos préstamos del estudiante</h4>
    <br>
  
    <?php
  
    foreach($prestamoALumno as $pa):?>
      <hr>
    <br>
    <p><b>Título: </b><?=$pa->titulo?></p>
    <p><b>Fecha de préstamo: </b><?=$pa->fecha_prestamo?></p>
    <p><b>Folio: </b><?=$pa->idPrestamos?></p>
    <p><b>Ejemplar: </b><?=$pa->ejemplar?></p>
    <p><b>Fecha de devolución: </b><?=$pa->fecha_regreso?></p>

    <br>
    
    <?php endforeach?>
    </div>

    <!--contenedor derecha -->

        </div>
        <?php endif?>
    <?php endif?>

    </div>
</div>

<script src="../../js/peticiones.js">        </script>
<?php require '../complementos/footer_2.php';?>