<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";


if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}
$grupos =buscarGrupoS();
if(isset ($_POST['grupo'])){
    $grupoElegido = $_POST['grupo'];
    $prestamos =buscaPrestamosActivosGrupo($grupoElegido);
    if($prestamos == ""){
        unset($prestamos);
    } 
}

$estadisticas =  buscaEstadisticasPrestamos();


?>



<!-- body  -->
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <!--Inici titulo principal-->
                  <center><H1  >Biblioteca</H1></center>
                        <center>
                            <div class="div-logo" >
                            <img  class="img-menu" src="../../img/icons/libreria.jpg" alt="biblioteca">
                            </div></center>
          </div> <!--termina titulo principal-->
          
</div><br><br> <br><br>
<div class="row"> <!--inicia contenedor principal-->
                   <!--Inicial biblioteca--> 
                    
                   <div class="col-lg-4 col-md-4  col-sm-6 col-xs-12"><!--Inicial contenido izquierda--> 
                           
                            <!--Mostrar acciones --> 
                            <center><h3>Menú de opciones</h3></center>
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <center>
                                     <a href="nuevoPrestamo.php">
                                     <img class="logos-enfermeria"
                                        src="../../img/icons/plus.png" alt="NuevoPrestamo">    </a> </center> 
                                        <br>
                                        <center>Nuevo Préstamo </center> </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <center>
                                     <a href="historialPrestamos.php">
                                     <img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt="">    </a> </center> 
                                       <br> <center>Historial </center> </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <center>
                                     <a href="binventario.php">
                                     <img class="logos-enfermeria"
                                        src="../../img/icons/inventory.png" alt="">    </a> </center> 
                                    <br>    <center>Inventario </center> </div>
                                
                                    </div>
                   </div><!--final contenido izquierda-->
                    
                   <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <!--Inicial contenido central--> 
                   
                       
                          <!--Mostrar prestamos vigentes --> 
                          <center><h3>Préstamos vigentes por grupo</h3></center>
                          <br><br><br>
                            <div class="">
                                        <!--combobox para seleccionar  grupo-->
                                    <form class="form-control" action="bprincipal2.php" method="post">
                                            <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                <p><b>Selecciona Grupo:</b></p>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                    <select name="grupo" class="form-control">
                                                                    <?php foreach($grupos as $g):?>
                                                                        
                                                                    <option value="<?=$g->idgrupos?>"
                                                                        <?php if(isset($grupoElegido)){
                                                                            if($grupoElegido==$g->idgrupos) {
                                                                                echo 'selected';
                                                                            } 
                                                                        }?>
                                                                    ><?=$g->grupo?></option>
                                                                    <?php endforeach?>
                                                                    </select>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                <button type="submit" class="form-control btn btn-success">
                                                                <center>  Cargar Préstamos</center> 
                                                                </button>
                                                            </div>
                                                        </div>
                                            </div>
                                                        
                                    </form>  <!--FINcombobox para seleccionar  grupo-->
                            </div>            
                                       <!--Se cargan cada registro de prestamo-->     
                            
                                <?php if (isset($prestamos) ):
                                //se crea un boton para cada registro de prestamo?>
                               
                                            <?php foreach($prestamos as $presta):?>
                                <div class="row">        
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                        <button class="row   btn-primary  form-control" onclick="ocultar(<?=$presta->idPrestamos?>)">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si ">Folio: <?=$presta->idPrestamos ?>  </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si  "><p class="little"> <?=$presta->nombre." ".$presta->apaterno." ".$presta->amaterno ?></p>  </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si "><?=$presta->fecha_prestamo?>   </div>
                                            
                                        </button>  
                                               
                                        
                                     </div>
                                      
                                </div>
                            <!--row colapsable-->
                            <div class="row  desaparece desc<?=$presta->idPrestamos?>" id="<?=$presta->idPrestamos?>">
                            <center><h4>Detalles:</h4></center>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-6 si "><center> <b><?=$presta->titulo?></b></center> </div>
                                            <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div> 
                                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-6 si "><center><b>Ejemplar: <?=$presta->ejemplar ?></b></center>   </div> 
                                    </div>
                                    <!--se cargan iconos de accion-->
                                    <br><br>
                                    <div class="row">
                                    <hr>
                                    <center><h4>Acciones:</h4></center>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 si ">  <center> 
                                                <a href="devolverLibro.php?id=<?=$presta->idPrestamos?>">
                                                <img class="icono-seguimiento"
                                            src="../../img/icons/borrow.png" alt="otra nota">    </a> </center>
                                            <center>Devolver </center>
                                            </div>
                                            
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 si ">  <center> 
                                                <a href="seguimientoCaso.php?id=<?=$presta->idPrestamos?>">
                                                <img class="icono-seguimiento"
                                            src="../../img/icons/delete.png" alt="otra nota">    </a> </center> 
                                            <center>Eliminar Préstamo</center>
                                             </div> 
                                     </div>
                                    <!--temina carga iconos de accion-->
                                </div> 
                            </div><!--TERMINA row colapsable-->
                            
                            <?php endforeach?>
                            
                            <?php endif?> 
                   </div> <!--Final contenido central--> 
                   
                <div class="col-lg-4 col-md-4  col-sm-6 col-xs-12"> <!--Inici al contenido derecha-->
                     <!--Mostrar estadisticas --> 
                     <center><h3>Estadísticas de Biblioteca</h3></center>
                     <br><br>
                     <div class="row form-control">
                        <!--inicio libros prestados-->
                            <center><h4>Libros  Prestados Actualmente</h4></center>
                            <hr>
                                                <?php if(isset($estadisticas)):?>
                                                    <?php foreach($estadisticas as $e):?>
                                                       <center> <label for=""><b> <h3 class="blink success"><?=$e['prestados']->prestados?></h3></b></label></center>
                                                      
                                                       </div>  
                                                       <br> 
                                                        <!--inicio libros prestados-->
                                                        <div class="row form-control">
                            <center><h4>Total Prestados en el ciclo escolar</h4></center>
                            <hr>
                                            
                                                       <center> <label for=""><h3 class=""><b> <?=$e['Total'][0]->prestados?></h3></b></label></center>
                                                      
                                                       </div>  
                                                       <br>                       
                        <!--final libros prestados-->
                          <!--titulos mas prestados-->
                          <div class="row form-control">
                            <center><h2 class="">Top 10</h2></center>
                          <center><h3>Títulos mas leídos</h3></center>
                          <hr>
                                                
                      
                                                        <?php $x=0; ?>
                                                        <?php foreach($e['xTitulo'] as $xtitulo):?>
                                                            <?php if($xtitulo != ""):?>
                                                                <?php $x++; 
                                                                if($x<11): ?>
                                                            <div class="col-lg-7 col-md-6 col-xs-6 col-sm-6">
                                                             <label for=""><b> <p><?=$xtitulo['titulo']?>:</div>
                                                            <div class="col-lg-5 col-md-6 col-xs-6 col-sm-6">
                                                            <center>  <?=$xtitulo['prestamos']?></p></b></label></center>
                                                            </div>
                                                            <?php endif?>
                                                             <?php endif?>
                                                        <?php endforeach?>

                            </div>
                            <br>
                              <!--grupos con mas prestamos-->
                          <div class="row form-control">
                        <h3 class="text-center">Grupos con  más préstamos</h3>
                          <hr>
                                                
                                        
                                                       <?php $i=0; ?>
                                                        <?php foreach($e['xGrupo'] as $xGrupo):?>
                                                            <?php if($xGrupo != ""):?>
                                                                <?php $i++; 
                                                                if($i<6): ?>
                                                            <div class="col-lg-7 col-md-6 col-xs-6 col-sm-6">
                                                             <label for=""><b> <p><?=$xGrupo['Grupo']?>:</div>
                                                            <div class="col-lg-5 col-md-6 col-xs-6 col-sm-6">
                                                            <p class="text-center">  <?=$xGrupo['prestamos']?></p></b></label></p>
                                                            </div>
                                                           
                                                            
                                                            <?php endif?>
                                                             <?php endif?>
                                                        <?php endforeach?>
                                                     
                            </div>
                                                        <?php endforeach?>
                                                    <?php endif?>

                        <!--final titulos mas prestados-->


                     </div>
                </div><!--final contenido derecha-->
               
</div><!--termina contenedor principal-->
           
           
<!--js-->

    <script src="../../js/peticiones.js">        </script>
    <script src="../../js/colapsables.js"></script>
<?php require '../complementos/footer_2.php';?>