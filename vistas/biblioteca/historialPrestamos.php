<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";
  $espacios = "        ";
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
    if(strpos($alumno, '/') == false){
        //si no contiene / no existe en la base de datos y redirige a la misma pagina pero sin post
        header("Location:./historialPrestamos.php");
         }else{
            //si existe / entonces existe en la base de datos y carga los datos
   $al = explode("/",$alumno);
    $nAlumno = $al[0]." ".$al[1]." ".$al[2];
    $grupoAlumno=$al[3];
    $idal=trim($al[4]);
    $historial = "Historial del alumno:";
    $tema = $nAlumno;
    $prestamos = buscaPrestamosAlumno($idal);
    
}}
if(isset($_POST['grupo'])){
    $grupo= $_POST['grupo'];
    $historial = "Historial del grupo:";
    $tema = $grupillos[$grupo-1]->grupo;
    $prestamos = buscaTodosPrestamosGrupo($grupo);
}

if(isset($_POST['libro'])){

    $idlibros= $_POST['libro'];
    $historial = "Historial del libro:";
    
    $prestamos = buscaPrestamosLibro($idlibros);
    if($prestamos != false){
        $tema = $prestamos[0]->titulo;
        }else{
            $tema="";
        }
}
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
                 <center><a href="../../vistas/biblioteca/bprincipal.php">
                 <img class="img-menu" src="../../img/icons/libreria.jpg" alt="biblioteca"></a></center>
        </div>
        <div class="row">
                
                    <h4 class="text-center">Biblioteca</h4>
                
        </div>
        <div class="row">
                <h1 class="text-center">Menú</h1>
                <div class="list-group">
                  
                         <!--Menu desplegable-->
                         <a href="bprincipal.php" class=" btn list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="nuevoPrestamo.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Nuevo Préstamo</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action  btn-primary" href="historialPrestamos.php"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Historial </p></a>
                        <br> <a href="binventario.php" class="list-group-item text-center list-group-item-action"><p> <img class="logos-enfermeria"
                                        src="../../img/icons/inventory.png" alt=""> <?=$espacios?>Inventario </p> </a>
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
          <br><br><br>
     <!--busqueda de alumnos-->
     <?php if(isset($busca)):?><!--si existe busca entonces es que ya se selecciono un modo de busqueda-->
        <?php if($busca=="alumno"):?><!--busqueda de alumnos-->
            <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
            <div class="col-lg-8 col-md-8 col-sm-5 col-xs-12">
                                 <form action="historialPrestamos.php"  class="form-control"  method="post" autocomplete="off">
                                    <input type="hidden" name="busca" value="1" >
                                     <div>
                                        <label for="alumno"><h1>Buscar historial por alumno:</h1></label><br><br>
                                        <input type="text" required class="form-control" name="alumno"  id="alumno">
                                        <ul id="lista">                                                    
                                                </ul>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-2 col-md-1 col-sm-1 col-xs-0"></div>
                                        <div class="col-lg-3 col-sm-4 col-md-4 col-xs-6"> 
                                            <button type="submit" class=" form-control btn btn-primary">Buscar</button>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>
                                        <div class="col-lg-3 col-sm-4 col-md-4 col-xs-6">
                                        <a href="historialPrestamos.php"  class=" form-control  btn btn-danger">Regresar</a>
                                        </div>
                                     </div>
                                   
                                 </form>
                                 </div>
 
              
                        
            <!--Se cargan los historiales de los alumnos si existe la variable alumnos-->
              
           
            <?php endif;?><!--termina busqueda de alumnos-->
            
            <!--En caso de elegir por grupo-->
            <!--elegir grupo-->
            <?php if($busca=="grupo"):?><!--if busca grupos-->
               
               <h1 class="text-center">Búsqueda por grupo</h1><br><br><br>
            <div class="row">
              <div class="col-lg-2 col-md-3 col-sm-3 col-xs-0"></div>
              <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                        <form action="historialPrestamos.php" method="post" class="">
                            <input type="hidden" name="busca" value="0">
                         <h5>Elige un grupo:  </h5> <select class="form-control" name="grupo" id="grupo">
                           
                                <?php foreach($grupillos as $g):?>
                                    <option value="<?=$g->idgrupos?>"
                                    <?php if(isset($grupo)){ if($g->idgrupos == $grupo){echo 'selected';}}?>><p class="text-center"><?=$g->grupo?></p></option>
                                    <?php endforeach?>
                            </select>
                            <br>
                            <div class="row">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12"></div>
                                        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12"> 
                                            <a href="historialPrestamos.php" style ="height: 40px" class="  btn btn-danger">Regresar</a>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                                       
                        </form>
                                        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                        <button href="historialPrestamos.php" style ="height: 40px" class="   btn btn-primary"> 
                                            <p class="text-center">  Buscar</p></button>
                                        </div>
                                     </div>
                        </div>
               
            <?php endif?><!--terminabusqueda de grupos-->
            <br><br>
            
            <!--En caso de elegir por libro-->
            <!--elegir libro-->
            <?php if($busca=="libro"):?><!--busqueda de libros-->
               <h1 class="text-center">Búsqueda por libro</h1><br><br><br>
            <div class="row">
            <div class="col-lg-2 col-sm-2 col-md-1 col-xs-0"> </div>
            <div class="col-lg-8 col-sm-8 col-md-5 col-xs-12"> 
                <form action="historialPrestamos.php"  class="form-control2"method="post">
                    <div class="row">
                    <input type="hidden" name="busca" value="2">
                      Elige un libro  <select class="form-control" name="libro" id="libro">
                      <option value="0" >Selecciona un libro</option>
                        <?php foreach($libros as $l):?>
                                <option value="<?=$l->idlibros?>" 
                                <?php if(isset($idLibro)){
                                    if($idLibro == $l->idlibros){
                                        echo'selected';
                                        }
                                        }?>
                                ><?= $l->titulo?></option>
                                <?php endforeach?>
                                    </select>
                    </div>
                            <div class="row">
                                
                                <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12"> 
                                    <button type="submit" class=" form-control btn btn-primary">Cargar préstamos</button>
                                </div>
                                
                                <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                                <a href="historialPrestamos.php"  class=" form-control  btn btn-danger">Regresar</a>
                                </div>
                            </div>
                            <?php if(isset($_POST['libro'])):?>
                    <?php if($_POST['libro']==0):?>
                <div class="row"><h5 class="text-center form-message form-message-active"> <b> Debes elegir un libro</b></h5></div>
                        <?php endif ?>
                <?php endif?>
                </form>
              
                </div>
            </div>
            <?php endif?><!--terminabusqueda de libros-->
            <!--termina elegir libro-->
          
            <!--Se muestran resultados-->
            <?php if(isset($historial)):?>
                    <div class="row">
                    <br><br><h3 class="text-center"><?=$historial?></h3>
                    <h3 class="text-center"><?=$tema?></h3>
                    </div>
                <?php endif?>
            <?php if(isset($prestamos)):?>
            <?php if($prestamos !=false):?><!--si hay registros-->
                <?php foreach($prestamos as $p):?>
                  
                    <br>
                    <div class="row form-control" style="font-size:small;">
                         <!-- aqui se hace cambio cuando se ha buscado por libro --> 
                        <div class="col-lg-1 col-md-3 col-sm-6 col-xs-6"> 
                        <?php if($busca=="libro"):?><!--busqueda de libros-->
                            <b> Alumn@: </b>
                            <?php else:?>
                            <b> Folio: </b>
                            <?php endif?>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                        <?php if($busca=="libro"):?><!--busqueda de libros-->
                            <input type="text" readonly value="<?=$p->nombre?>">
                            <?php else:?>
                                <input type="text" readonly value="<?=$p->idPrestamos?>">
                                <?php endif?>
                        </div>
                      
                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                        <?php if($busca=="libro"):?><!--busqueda de libros-->
                            <b>  </b>
                            <?php else:?>
                       
                            <b> Título: </b>
                        
                        <?php endif?>
                        </div>
                   
                        <div class="col-lg-2 col-md-1 col-sm-6 col-xs-6">
                        <?php if($busca=="libro"):?><!--busqueda de libros-->
                            <input type="text" readonly value="<?=$p->apaterno." ".$p->amaterno?>">
                        <?php else:?>
                            <input type="text" readonly value="<?=$p->titulo?>">
                            <?php endif?>
                                 <!-- termina cambio por busqueda por libro -->
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
                   <h3 class="text-center">No hay préstamos registrados de este <?=$busca?></h3>
                    <?php endif;?> 
                    <?php endif;?> 
<?php else:?><!--fin de ifinicial-->
    
   
            <h1 class="text-center">Historial de préstamos de libros</h1><br><br><br>
             <div class="row">
                <form class="form-control2" autocomplete="off" action="historialPrestamos.php" method="post">
                    
              <h3 class="text-center"><b>Selecciona un tipo de búsqueda</b> </h3>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-0"></div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6"><b> Por Grupo </b></div>
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6"><input type="radio" value="0"name="busca" id="grupo" ></div>
                        <div class="col-lg-5 col-md-5 col-sm-3 col-xs-0"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-0"></div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6"><b>Por Alumno </b></div>
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6"><input type="radio" value="1"name="busca" id="alumno" ></div>
                        <div class="col-lg-5 col-md-5 col-sm-3 col-xs-0"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-0"></div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6"><b>Por Libro </b></div>
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6"> <input type="radio" value="2"name="busca" id="libro"></div>
                        <div class="col-lg-5 col-md-5 col-sm-3 col-xs-0"></div>
                </div>
               
                <br><br> 
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3"></div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"> <button type="submit" class="form-control btn btn-primary">Siguiente</button></div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3"></div>
                 
                  </div>
               
                    
                </form> 
       
    <?php endif;?>
            <!--contenedor central -->
          </div>
          </div>
       
         
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->
   
    <?php if(isset($_POST['alumno'])):?>
    <?php if($prestamos !=""):?>
  
   
                <div class="row"  style="background:#FFFF99; font-size: small; border-radius: 20px;">
            
                <h4 class="text-center">Datos interesantes:</h4>
                <br>
               
              
                <?php $cuantos = count($prestamos,COUNT_RECURSIVE);
                $fprestamo = date_create($prestamos[0]->fecha_prestamo);
                $hoy = date_create($fechaF);
                $devolvio = date_create($prestamos[0]->fecha_regreso);
                $ultimo= date_diff($fprestamo, $hoy);
                $tardo =  date_diff($fprestamo, $devolvio);
                
                ?>
                <p class="text-center"> <b><?=$nAlumno."  "?></b></p>
                <br><hr> 
                <p class="text-center"><b> Ha leido <?=" ".$cuantos." "?>libros</b></p> 
                <br>
                <hr>
                <?php if($ultimo->format('%a') == 0):?>
                    <p class="text-center"> <b>Hoy solicitó un libro</b> </p>
                    <?php else :?>
                <p class="text-center"> <b>Tiene   <?= $ultimo->format('%a días')?> desde su último préstamo</b> </p>
              <?php endif?>

                <br>
                <hr>
                <p class="text-center"> <b>Tardó  <?= $tardo->format('%a días ' )?>en leer su último libro</b> </p>
                 
            
                
        </div>
        <?php endif?>
    <?php endif?>
    <!--contenedor derecha -->

        </div>
    </div>
</div>
<script src="../../js/peticiones.js">        </script>
               <script src="../../js/colapsables.js"></script>
           <?php require '../complementos/footer_2.php';?>