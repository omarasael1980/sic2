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
    //busca los libros del usuario logeado para que cada docente pueda prestar los libros que tiene
    $libros =buscaLibros($_SESSION['user']->idUsuario);
    if(isset($_POST['libros'])){
        
        $libroElegido = $_POST['libros'];
        $libroSeparado = explode("/",$libroElegido);
        $idlibro = $libroSeparado[0]; //id del libro
        $idalumno = $_POST['idalumno'];
        $advertencia = buscaLibroLeidoAlumno($idlibro, $idalumno);
        $titulo =$libroSeparado[1];
        //busca los ehemplares del usuario logeado para que cada docente pueda prestar los ejemplares que tiene
        $ejemplares = buscaEjemplares($idlibro, $_SESSION['user']->idUsuario);
    }
       
}
}

?>


<!-- body  -->
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <center><H1  >Biblioteca</H1></center>
                  <center><div ><img  style="width: 120px;height: auto;" src="../../img/icons/libreria.jpg" alt="enfermeria">
                  </div></center>
          </div>
</div>
<br>
<br>
<?php if(!isset($_POST['alumno'])):?>
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                        <form action="nuevoPrestamo.php"  class="form-control"  method="post" autocomplete="off">
                        <div>
                            <label for="alumno">Buscar Alumno:</label>
                            <input type="text" class="form-control" name="alumno"  id="alumno">
                            <ul id="lista">        
                                    </ul>
                            </div>
                        <button class="btn btn-success form-control">Cargar Alumno</button>
                         </form>
                 </div>
    </div>
           <?php else :?>
            <div class="row">
                <center><h1><?=$nombre?></h1></center>
                <center><h1><?=$grupo?></h1></center>
                <div class="col-lg-5 col-md-1 col-sm-1 col-xs-0"></div>
                <div class="col-lg-2 col-md-10 col-sm-10 col-xs-12">
               <center> <a class="form-control btn btn-danger" href="nuevoPrestamo.php">Regresar</a></center>
               <?php if(isset($_POST['ejemplar'])):?> 
                <br>
                            <center><h3>Confirmar Préstamo</h3></center>
                            <br>
                        <?php else:?>
                            <br>
                            <center><h3>Iniciar Préstamo</h3></center>
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
                                                        <p><center> <b><h3>El alumno ya leyó este libro (Fecha de Préstamo: <?=$adv->fecha_prestamo?>)</h3></b> </p></center>
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
                                            <div class="form-message  me_formulario-active" id="">
                                            <p><center> <b><h3>Lo siento pero están agotados estos ejemplares, selecciona otro libro</h3></b></center> </p>
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
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <!--Columna derecha-->
                       
                        </div> 
            </div>
            <?php endif?>
    </div>

    <script src="../../js/peticiones.js">        </script>
<?php require '../complementos/footer_2.php';?>