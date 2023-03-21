
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
?>

<!-- body  -->
<div class="container"><!--inicia contenedor principal-->
    <div class="row"><!--inicia row principal-->
    <!--Contenido principal de la pagina-->
<center><h1>Inventario </h1></center>
<br><br><br>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <?php if(isset($libros)):?>
        <?php foreach ($libros as $li):?>
         <div class="form-control btn btn-primary">
           <center><h3><?=$li->titulo?></h3></center>
           </div>
           <?php $ejemplares =buscaEjemplaresPorLibro($li->idlibros) //se buscan los ejemplares?> 
           <?php if(isset($ejemplares)):?>
          
           <?php if($ejemplares == false):?>
            <div > <center>No hay ejemplares disponibles</center></div>
           <?php else: ?>
           <?php foreach ($ejemplares as $e):?>
           
               
           <div class="row">
            <form action="../../controlador/biblioteca/actualizaInventario.php" class="form-control2" method="post">
            <div class="col" > <input type="hidden" name="idEjemplar" value="<?=$e->idEjemplar?>"> </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">Ejemplar:<input type="text"  name="Ejemplar">  <b> <?=$e->ejemplar?> </b></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6"> Fecha de Alta:<input type="date" name="f_alta" class="form-control2" readonly value="<?=$e->fecha_alta?>"> </div>
             <?php if($e->fecha_baja != ""):?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">Fecha de Baja: <input type="date" name="f_baja"class="form-control2" readonly value="<?=$e->fecha_baja?>"></b></div>
                <?php endif ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6"> Estado: <input type="text" name="estado" value="<?php
                switch($e->disponible){
                    case 1:
                        echo "Disponible";
                        break;
                    case 2:
                            echo "Prestado";
                        break;
                    case 3:
                    echo "Mantenimiento";
                        break;
                    case 4:
                        echo "Dado de Baja";
                        break;

                }
               ?>"> </b></div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">Custodia: <select  class="form-control" name="idUsuario" id="">
                   
                    <?php foreach ($bibliotecarios as $bi):?>
                    <option 
                    <?php //se valida que el usuario sea administrador o directivo para cambiar la custodia
                    if( !in_array('Ajustes',$_SESSION['user']->perm)){
                       echo 'disabled';
                    }
                    ?>
                    value="<?=$bi->idUsuario?>"
                    <?php if($bi->idUsuario == $e->usuario_idUsuario){echo 'selected';}?>
                    ><?=$bi->nombre." ".$bi->apaterno?></option>
                   
                    <?php endforeach?>
                </select> </div>
                <?php //se valida que el usuario sea administrador o directivo para cambiar la custodia
                    if( in_array('Ajustes',$_SESSION['user']->perm)){
                     echo'   <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6"> <button class="form-control btn btn-success">Guardar</button> </div>';
                    }
                    ?>
               
            </div>
            </form>
                
            <hr> 
           
            <?php endforeach?>
            <?php endif?>
            <?php endif?>
            <?php endforeach?>
            
            
            <?php endif?>
    </div>
</div>
  
<pre>
    <?php
   // print_r($libros);
  // print_r($ejemplares);
    ?>
</pre>

    <!--termina contenido principal de la pagina-->
    </div><!--termina  row principall-->
</div>  <!--termina contenedor principal-->   
           
           <!--js-->
           
               <script src="../../js/peticiones.js">        </script>
               <script src="../../js/colapsables.js"></script>
           <?php require '../complementos/footer_2.php';?>