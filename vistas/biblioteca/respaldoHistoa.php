
<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";

$grupillos = buscarGrupoS();
$libros = buscaTodosLibros();
$fechaI='2022-08-21';
date_default_timezone_set("America/Tijuana");
$fechaF= date("Y-m-d");
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}
if(isset($_POST)){
    if(isset($_POST['busca'])){
    $busqueda = $_POST['busca'];
    if($busqueda ==0){
        $busca= "grupo";
      
       }
       if($busqueda==1){
        $busca= "alumno";
       }if($busqueda==2){
        $busca= "libro";
       }
    }
    
  
if(isset($_POST['alumno'])){
    $alumno= $_POST['alumno'];
   $al = explode("/",$alumno);
    $nAlumno = $al[0]." ".$al[1]." ".$al[2];
    $grupoAlumno=$al[3];
    $idal=trim($al[4]);
    $historial = "Historial del alumno:";
    $tema = $nAlumno;
    $prestamos = buscaPrestamosAlumno($idal);
}
if(isset($_POST['grupo'])){
    $grupo= $_POST['grupo'];
    $historial = "Historial del grupo:";
    $tema = $grupillos[$grupo]->grupo;
    $prestamos = buscaTodosPrestamosGrupo($grupo);
}

if(isset($_POST['libro'])){
    $libro= $_POST['libro'];
    $historial = "Historial del libro:";
    $tema = buscaLibroIdlibro($idlibros);
    $prestamos = buscaPrestamosLibro($libro);
}
}

?>

<!-- body  -->
<div class="container"><!--inicia contenedor principal-->
    <div class="row"><!--inicia row principal-->
    <!--Contenido principal de la pagina-->
   
     <!--busqueda de alumnos-->
     <?php if(isset($busca)):?><!--si existe busca entonces es que ya se selecciono un modo de busqueda-->
        <?php if($busca=="alumno"):?><!--busqueda de alumnos-->
            <div class="row">
                        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                        <center>  <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                 <form action="historialPrestamos.php"  class="form-control"  method="post" autocomplete="off">
                                    <input type="hidden" name="busca" value="1" >
                                     <div>
                                        <label for="alumno"><h1>Buscar historial por alumno:</h1></label><br><br>
                                        <input type="text" class="form-control" name="alumno"  id="alumno">
                                        <ul id="lista">                                                    
                                                </ul>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-2 col-md-1 col-sm-1 col-xs-0"></div>
                                        <div class="col-lg-3 col-sm-4 col-md-4 col-xs-6"> 
                                            <button type="submit" class=" form-control2 btn btn-success">Cargar historial del alumno</button>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                        <div class="col-lg-3 col-sm-4 col-md-4 col-xs-6">
                                        <a href="historialPrestamos.php"  class=" form-control2  btn btn-danger">Regresar</a>
                                        </div>
                                     </div>
                                   
                                 </form>
 
              
                        </div></center>


            </div>
            <!--Se cargan los historiales de los alumnos si existe la variable alumnos-->
               
           
            <?php endif;?><!--termina busqueda de alumnos-->
          
            <!--En caso de elegir por grupo-->
            <!--elegir grupo-->
            <?php if($busca=="grupo"):?><!--if busca grupos-->
                <center><h1>Búsqueda por grupo</h1></center><br><br><br>
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-2 col-xs-0"></div>
                <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
                        <form action="historialPrestamos.php" method="post" class="form-control2">
                            <input type="hidden" name="busca" value="0">
                          Elige un grupo  <select class="form-control" name="grupo" id="grupo">
                                <?php foreach($grupillos as $g):?>
                                    <option value="<?=$g->idgrupos?>"
                                    <?php if($g->idgrupos == $grupo){echo 'selected';}?>><center><?=$g->grupo?></center></option>
                                    <?php endforeach?>
                            </select>
                            <div class="row">
                                         
                                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6"> 
                                            <button type="submit" class=" form-control btn btn-success">Cargar préstamos</button>
                                        </div>
                                        
                                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                        <a href="historialPrestamos.php"  class=" form-control  btn btn-danger">Regresar</a>
                                        </div>
                                     </div>
                        </form>
                        
                </div>
            </div>
            <?php endif?><!--terminabusqueda de grupos-->
            <br><br>
            <!--En caso de elegir por libro-->
            <!--elegir libro-->
            <?php if($busca=="libro"):?><!--busqueda de libros-->
                <center><h1>Búsqueda por libro</h1></center><br><br><br>
            <div class="row">
                <form action="historialPrestamos.php"  class="form-control2"method="post">
                    <input type="hidden" name="busca" value="2">
                      Elige un libro  <select class="form-control" name="libro" id="libro">
                        <?php foreach($libros as $l):?>
                                <option value="<?=$l->idlibros?>" 
                                <?php if(isset($idLibro)){
                                    if($idLibro == $l->idlibros){
                                        echo'selected';
                                        }
                                        }?>
                                ><?= $l->titulo?></option>
                                <?php endforeach?>
                </form>
            </div>
            <?php endif?><!--terminabusqueda de libros-->
            <!--termina elegir libro-->
            
            <!--Se muestran resultados-->
            <?php if(isset($historial)):?>
                    <div class="row">
                    <br><br><center><h3><?=$historial?></h3></center>
                    <center><h3><?=$tema?></h3></center>
                    </div>
                <?php endif?>
            <?php if(isset($prestamos)):?>
            <?php if($prestamos !=false):?><!--si hay registros-->
                <?php foreach($prestamos as $p):?>
                    <br><hr>
                    <div class="row form-control">
                        
                        <div class="col-lg-1 col-md-3 col-sm-6 col-xs-6"> 
                            <b> Folio: </b>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                            <input type="text" readonly value="<?=$p->idPrestamos?>">
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                            <b> Título: </b>
                        </div>
                        <div class="col-lg-2 col-md-1 col-sm-6 col-xs-6">
                            <input type="text" readonly value="<?=$p->titulo?>">
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                           <b> Ejemplar: </b>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                            <input type="text" readonly value="<?=$p->ejemplar?>">
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                           <b> Fecha Préstamo: </b>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                            <input type="text" readonly value="<?=$p->fecha_prestamo?>">
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                           <b> Fecha Devolución: </b>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                            <input type="text" readonly value="<?=$p->fecha_regreso?>">
                        </div>
                    
                    </div>
                <?php endforeach?>
                <?php else:?><!--si no hay registros-->
                    <br><br><hr>
                    <center><h3>No hay préstamos registrados de este <?=$busca?></h3></center>
                    <?php endif;?> 
                    <?php endif;?> 
<?php else:?><!--fin de ifinicial-->
            <center><h1>Historial de préstamos de libros</h1></center> <br><br><br>
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-2 col-xs-0"></div>
            <div class="col-lg-8 col-md-6 col-sm-8 col-xs-12 form-control">
                <form class="form-control2" autocomplete="off" action="historialPrestamos.php" method="post">
                <center><h3>Tipo de búsqueda</h3></center>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">Por Grupo </div><div class="col-lg-10 col-md-8 col-sm-6 col-xs-6"><input type="radio" value="0"name="busca" id="grupo" ></div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">Por Alumno</div><div class="col-lg-10 col-md-8 col-sm-6 col-xs-6"><input type="radio" value="1"name="busca" id="alumno" ></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">Por Libro </div><div class="col-lg-10 col-md-8 col-sm-6 col-xs-6"> <input type="radio" value="2"name="busca" id="libro"></div>
                    <button type="submit" class="form-control2 btn btn-primary">Elegir tipo de búsqueda</button>
                </form> 
            </div>
    </div>
    <?php endif;?>
    <!--termina contenido principal de la pagina-->
    </div><!--termina  row principall-->
</div>  <!--termina contenedor principal-->   
           
           <!--js-->
           
               <script src="../../js/peticiones.js">        </script>
               <script src="../../js/colapsables.js"></script>
           <?php require '../complementos/footer_2.php';?>