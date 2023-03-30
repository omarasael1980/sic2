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
  $espacios = "        ";
$estadisticas =  buscaEstadisticasPrestamos();?>


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
                         <a href="bprincipal.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="nuevoPrestamo.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Nuevo Préstamo</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="historialPrestamos.php"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Historial </p></a>
                        <br> <a href="binventario.php" class="list-group-item text-center list-group-item-action"><p> <img class="logos-enfermeria"
                                        src="../../img/icons/inventory.png" alt=""> <?=$espacios?>Inventario </p> </a>
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-7 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->



<!-- aqui -->
  <!--Mostrar prestamos vigentes --> 
                         <h3 class="text-center">Préstamos vigentes por grupo</h3>
                          <br>
                            <div class="">
                                        <!--combobox para seleccionar  grupo-->
                                    <form class="form-control" action="bprincipal.php" method="post">
                                            <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                <h6 class="text-center"><b>Selecciona Grupo:</b></h6>
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
                                                                <p class="text-center">Cargar Préstamos</p> 
                                                            </div>
                                                        </div>
                                            </div>
                                                        
                                    </form>  <!--FINcombobox para seleccionar  grupo-->
                            </div>            
                                       <!--Se cargan cada registro de prestamo-->     
                            <br>
                                <?php if (isset($prestamos) ):
                                //se crea un boton para cada registro de prestamo?>
                               
                                            <?php foreach($prestamos as $presta):?>
                                <div class="row m-0 p-0">        
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-0 p-0"> 
                                        <button class="row   btn-primary  form-control collapsed" aria-expanded="false"  data-bs-toggle="collapse" href="#info<?=$presta->idPrestamos?>">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si ">Folio: <?=$presta->idPrestamos ?>  </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si  "><h6 class="text-center"> <?=$presta->nombre." ".$presta->apaterno." ".$presta->amaterno ?></h6>  </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si "><?=$presta->fecha_prestamo?>   </div>
                                            
                                        </button>  
                                               
                                        
                                     </div>
                                      
                                </div>
                                <br>
                            <!--row colapsable-->
                            <div class=" row collapse "  id="info<?=$presta->idPrestamos?>">
                          
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-0 p-0">
                                    <div class="row m-0 p-0">
                                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 m-0 p-0">  <h6 class="text-center"> Detalles:</h6></div> 
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si m-0 p-0"> <p class="text-center"><b><?=$presta->titulo?></b> </p></div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si m-0 p-0"><p class="text-center"><b>Ejemplar: <?=$presta->ejemplar ?></b></p></div> 
                                    </div>
                                    <!--se cargan iconos de accion-->
                                    
                                    <div class="row m-0 p-0">
                                    <hr>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si m-0 p-0"> 
                                            <h6 class="text-center">Acciones:</h6>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si m-0 p-0"> 
                                              <p class="text-center"> <a href="devolverLibro.php?id=<?=$presta->idPrestamos?>">
                                                <img class="icono-seguimiento"
                                            src="../../img/icons/borrow.png" alt="otra nota">    </a></p> 
                                           <p class="text-center">Devolver </p>
                                            </div>
                                            
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 si m-0 p-0"> <p class="text-center">
                                               <p class="text-center"> <a href="seguimientoCaso.php?id=<?=$presta->idPrestamos?>">
                                                <img class="icono-seguimiento"
                                            src="../../img/icons/delete.png" alt="otra nota">    </a></p>
                                           <p class="text-center">Eliminar Préstamo</p>
                                             </div> 
                                     </div>
                                    <!--temina carga iconos de accion-->
                                </div> 
                            </div><!--TERMINA row colapsable-->
                            
                            <?php endforeach?>
                            
                            <?php endif?> 
                   </div> <!--Final contenido central--> 
<!-- termina aqui -->
            <!--contenedor central -->
          
       
         
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->
                 <!--Mostrar estadisticas --> 
               <h5 class="text-center"><b> Algunos datos importantes </b></h4>
                     <br>
                     <div class="row form-control m-0 p-0"  style="background:#FFFF99; font-size: small; border-radius: 20px;">
                        <!--inicio libros prestados-->
                          <h6 class="text-center">Libros  Prestados Actualmente</h6>
                          <hr class="m-0 p-0">
                                                <?php if(isset($estadisticas)):?>
                                                    <?php foreach($estadisticas as $e):?>
                                                    <label for=""><b> <h3 class=" text-center blink success"><?=$e['prestados']->prestados?></h3></b></label>                                                     
                                                       </div>  
                                                       <br> 
                                                        <!--inicio libros prestados-->
                                                        <div class="row form-control m-0 p-0"  style="background:#FFFF99; font-size: small; border-radius: 20px;">
                                                     <h6 class="text-center">Total Prestados en el ciclo escolar</h6>
                                                      <hr class="m-0 p-0">
                                            
                                                      <label for=""><h3 class="text-center"><b> <?=$e['Total'][0]->prestados?></h3></b></label>
                                                      
                                                       </div>  
                                                       <br>                       
                        <!--final libros prestados-->
                          <!--titulos mas prestados-->
                          <div class="row form-control m-0 p-0"  style="background:#FFFF99; font-size: small; border-radius: 20px;">
                            <h4 class="text-center">Top 10</h4>
                          <h4 class="text-center">Títulos mas leídos</h4>
                          <hr>
                                                
                                                        <?php $x=0; ?>
                                                        <?php  foreach($e['xTitulo'] as $xtitulo):?>
                                                          
                                                            <?php if($xtitulo != ""):?>
                                                                <?php $x++; 
                                                                if($x<11): ?>
                                                             <div class="row m-0 p-0" >
                                                                    <p class="text-left m-2 p-0">   <b> <?=$x.".- ".$xtitulo['titulo']?>   </b> </p>
                                                          </div>
                                                            <?php endif?>
                                                             <?php endif?>
                                                             
                                                        <?php endforeach?>
                            </div>
                            <br>
                              <!--grupos con mas prestamos-->
                          <div class="row form-control  " style="background:#FFFF99; font-size: small; border-radius: 20px;">
                        <h4 class="text-center">Grupos con  más préstamos</h4>
                          <hr>
                                                
                                        
                                                       <?php $i=0; ?>
                                                        <?php foreach($e['xGrupo'] as $xGrupo):?>
                                                            <div class="row m-0 p-0">
                                                            <?php if($xGrupo != ""):?>
                                                                <?php $i++; 
                                                                if($i<6): ?>
                                                            <div class="col-lg-5 col-md-5 col-xs-7 col-sm-6 p-0">
                                                             <p><b> <?=$xGrupo['Grupo']?>:</b></div>
                                                            <div class="col-lg-7 col-md-6 col-xs-4 col-sm-5 p-0">
                                                            <p class="text-center">  <b> <?=$xGrupo['prestamos']?></b></p>
                                                            </div>
                                                           
                                                            
                                                            <?php endif?>
                                                             <?php endif?>
                                                             </div>
                                                        <?php endforeach?>
                                                     
                            </div>
                                                        <?php endforeach?>
                                                    <?php endif?>

                        <!--final titulos mas prestados-->


                     </div>
    <!--contenedor derecha -->

        </div>
    </div>
</div>

    <script> </script>
<?php require '../complementos/footer_2.php';?>