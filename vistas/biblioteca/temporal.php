
<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";

date_default_timezone_set("America/Tijuana");
if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}
$hoy = date("Y-m-d");
$idPrestamo =$_GET['id'];
$prestamo = buscaPrestamo($idPrestamo);
?>

<!-- body  -->
<div class="container"><!--inicia contenedor principal-->
    <div class="row"><!--inicia row principal-->
    <center><h1>Devolver libro</h1></center> <br><br><br>
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-0"> </div>
            <!--Contenido principal de la pagina-->
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12"> 
                        <?php foreach($prestamo as $p):?>
                    <form autocomplete ="off" action="../../controlador/biblioteca/devolverLibro.php" class="form-control2" method="post">
                  <br>  <b>Folio:</b>   <input class="form-control" type="text" name="idPrestamo" readonly value="<?=$p->idPrestamos?>">
                  <br><b>Título:</b>   <input class="form-control" type="text" name="titulo" readonly value="<?=$p->titulo?>">
                  <br> <b>Ejemplar:</b>   <input class="form-control" type="text" name="ejemplar" readonly value="<?=$p->ejemplar?>">
                     <input class="form-control" type="hidden" name="idEjemplar" value="<?=$p->idEjemplar?>">
                  <br>  <b>Fecha de Préstamo:</b>   <input class="form-control" type="date" name="fprestamo" readonly value="<?=$p->fecha_prestamo?>">
                  <br>  <b>Fecha de regreso:</b>   <input class="form-control" type="date" name="fregreso"  value="<?=$hoy?>">
                  <br>  <b>Observaciones:</b>   <input class="form-control" type="text" name="observaciones"  value="" >
                  <br> <button class="form-control btn btn-success">Finalizar Regreso de libro</button>
                    </form>

                    <?php endforeach?>
            </div>
            <!--termina contenido principal de la pagina-->
    </div><!--termina  row principall-->
</div>  <!--termina contenedor principal-->   
           
           <!--js-->
           
               <script src="../../js/peticiones.js">        </script>
               <script src="../../js/colapsables.js"></script>
           <?php require '../complementos/footer_2.php';?>