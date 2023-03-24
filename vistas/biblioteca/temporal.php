<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";


if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}
$bibliotecarios = buscaBibliotecarios();
$libros = buscaTodosLibros();
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
                         <a href="bprincipal.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="nuevoPrestamo.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Nuevo Préstamo</p>  </a>
                         <br>
                        <a class="list-group-item text-center list-group-item-action" href="historialPrestamos.php"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Historial </p></a>
                        <br> <a href="binventario.php" class="list-group-item btn-primary text-center list-group-item-action"><p> <img class="logos-enfermeria"
                                        src="../../img/icons/inventory.png" alt=""> <?=$espacios?>Inventario </p> </a>
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12  m-0 p-0">
          <!--contenedor central -->
<div class="row m-0 p-0"><h1 class="text-center">Inventario</h1></div>
<!-- aqui empiza  inventario -->
<br>

<div class="row m-0 p-0">
    <div class="col m-0 p-0"></div>
    <div class="col m-0 p-0">
    <?php // calculo de estadisticas para panel derecho
            $clibros =0;
            $cejemplares=0;
            $cprestados = 0;
            $cdisponibles = 0;
            $cmantinimiento = 0;
            $cbaja = 0;
            ?>
        <?php if(isset($libros)):?>
         
        <?php foreach ($libros as $li):?>
            <?php  $clibros =$clibros + 1;?>
         <div class=" btn btn-primary m-0 p-0">
          <h5 class="text-center"><?=$li->titulo?></h5>
           </div>
           <?php $ejemplares =buscaEjemplaresPorLibro($li->idlibros) //se buscan los ejemplares?> 
           <?php if(isset($ejemplares)):?>
          
           <?php if($ejemplares == false):?>
            <p class="text-center " style="font-size: small"> No hay ejemplares disponibles</p>
           <?php else: ?>
           <?php foreach ($ejemplares as $e):?>
           
               <?php $cejemplares = $cejemplares+1;?>
           <div class="row m-0 p-0">
            <form action="../../controlador/biblioteca/actualizaInventario.php" class="form-control2  m-0 p-0" method="post">
            <div class="" > <input type="hidden" name="idEjemplar" value="<?=$e->idEjemplar?>"> </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 m-0 p-o"><p class="xs-4 " style="font-size: small">Ejemplar:<input type="text"  name="Ejemplar" value="<?=$e->ejemplar?>">  <b>  </b></p></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 m-0 p-o"> <p class="xs-4 " style="font-size: small">Fecha de Alta:<input style="font-size: small;" type="date" name="f_alta" class="form-control2" readonly value="<?=$e->fecha_alta?>"> </p></div>
             <?php if($e->fecha_baja != ""):?>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 m-0 p-o"><p class="xs-4 " style="font-size: small">Fecha de Baja: <input type="date" name="f_baja"class="form-control2" readonly value="<?=$e->fecha_baja?>"></b></p></div>
                <?php endif ?>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 m-0 p-o"> <p class="xs-4 " style="font-size: small">Estado: <input type="text" name="estado" value="<?php
                switch($e->disponible){
                    case 1:
                        echo "Disponible";
                        $cdisponibles = $cdisponibles+1;
                        break;
                    case 2:
                            echo "Prestado";
                            $cprestados = $cprestados+1;
                        break;
                    case 3:
                    echo "Mantenimiento";
                    $cmantinimiento = $cmantinimiento+1;
                        break;
                    case 4:
                        $cbaja = $cbaja+1;
                        echo "Dado de Baja";
                        break;

                }
               ?>"></p> </b></div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 m-0 p-o"><p class="xs-4 " style="font-size: small">Custodia: <select  class="form-control m-0 p-0" name="idUsuario" id="">
                   
                    <?php foreach ($bibliotecarios as $bi):?>
                    <option 
                    <?php //se valida que el usuario sea administrador o directivo para cambiar la custodia
                    if( !in_array('Ajustes',$_SESSION['user']->perm)){
                       echo 'disabled';
                    }
                    ?>
                    value="<?=$bi->idUsuario?>"
                    <?php if($bi->idUsuario == $e->usuario_idUsuario){echo 'selected';}?>
                    ><p style="font-size: 12; "><?=$bi->nombre." ".$bi->apaterno?></p></option>
                    </p>
                    <?php endforeach?>
                </select> </div>
                <?php //se valida que el usuario sea administrador o directivo para cambiar la custodia
                    if( in_array('Ajustes',$_SESSION['user']->perm)){
                     echo'   <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 m-0 p-o"> <button class="form-control btn btn-success">Guardar</button> </div>';
                    }
                    ?>
               
            </div>
            </form>
                
            <hr class=" m-0 p-0"> 
           
            <?php endforeach?>
            <?php endif?>
            <?php endif?>
            <?php endforeach?>
            
            
            <?php endif?>
    </div>
</div>
<!-- aqui termina inventario -->

            <!--contenedor central -->
          </div>
       
         
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
    <!--contenedor derecha -->

    
   
  
   
                <div class="row"  style="background:#FFFF99; font-size: small; border-radius: 20px;">
            
                <h4 class="text-center xs-3"><b>Algunos datos:</b> </h4>
                <br>
                    <p class="text-center xs-3"><b> Hay <?=" ".$clibros." "?> libros en existencia.</b></p>
                    <hr class=" m-0 p-0">
                    <p class="text-center xs-3"><b> Tenemos <?=" ".$cejemplares." "?> ejemplares para nuestros alumnos.</b></p>
                    <hr class=" m-0 p-0"> <p class="text-center xs-3"><b> Se tienen <?=" ".$cprestados." "?> ejemplares prestados actualmente.</b></p>
                    <hr class=" m-0 p-0"> <p class="text-center xs-3"><b> Y <?=" ".$cdisponibles." "?> libros disponibles en biblioteca para prestar.</b></p>
                    <?php if($cmantinimiento !=0):?>
                    <hr class=" m-0 p-0"> <p class="text-center xs-3"><b> Se tienen <?=" ".$cmantinimiento." "?> libros en mantenimiento.</b></p>
                    <?php endif?>
                    <?php if($cbaja !=0):?>
                    <hr class=" m-0 p-0"> <p class="text-center xs-3"><b> y en este ciclo se han dado de baja<?=" ".$cbaja." "?> libros.</b></p>
               <?php endif?>
                </div>
               
              
              
    <!--contenedor derecha -->

        </div>
    </div>
</div>
<script src="../../js/peticiones.js">        </script>
               <script src="../../js/colapsables.js"></script>
           <?php require '../complementos/footer_2.php';?>