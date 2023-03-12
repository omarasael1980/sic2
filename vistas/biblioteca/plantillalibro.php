
<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";


if(!isset($_SESSION['user']) || !in_array('Biblioteca',$_SESSION['user']->perm)){
    header("Location:../../");
}

?>

<!-- body  -->
<div class="container"><!--inicia contenedor principal-->
    <div class="row"><!--inicia row principal-->
    <!--Contenido principal de la pagina-->
    <!--inicia busqueda por alumno-->
    <?php if(isset($busca)):?>
        <?php if($busca=="alumno"):?>
    <div class="row">
                        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
                        <center>  <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                 <form action="nuevoPrestamo.php"  class="form-control"  method="post" autocomplete="off">
                                     <div>
                                        <label for="alumno">Buscar Alumno:</label>
                                        <input type="text" class="form-control" name="alumno"  id="alumno">
                                        <ul id="lista">                                                    
                                                </ul>
                                     </div>
                                    <button class="btn btn-success">Cargar historial del alumno</button>
                                 </form>

              
                        </div></center>

            </div>
            <?php endif;?>
<?php endif;?>


    <!--termina contenido principal de la pagina-->
    </div><!--termina  row principall-->
</div>  <!--termina contenedor principal-->   
           
           <!--js-->
           
               <script src="../../js/peticiones.js">        </script>
               <script src="../../js/colapsables.js"></script>
           <?php require '../complementos/footer_2.php';?>