
<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';
require "../../modelo/biblioteca/comunesBiblioteca.php";


if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}

?>

<!-- body  -->
<div class="container"><!--inicia contenedor principal-->
    <div class="row"><!--inicia row principal-->
    <!--Contenido principal de la pagina-->
    
<center><h1>Alta de nueva editorial</h1></center>
<br><br><br><br><br>
<div class="col-lg-4 col-md-4 col-sm-3 col-xs-1"></div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-10">
    <form action="../../controlador/biblioteca/guardarEditorial.php"autocomplete="off" class="form-control" id="formulario" method="post">
     <!--Inicia campo editorial-->
        <div class="form-group " id="grupo__editorial">
                     
                <div class="form-group-input  ">
                    <label for="editorial" class="form-label"> <b> Editorial:</b>
                        <input class="form-control img-container " id="editorial" type="text" name="editorial" placeholder="Editorial">
                        <i class=""><img class="form-validation-state img-input" id="img-editorial"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                    </label>
                </div>
               
                <div class="form-message" id="mensaje_error__editorial">
                     <p>Escribe el nombre de editorial, debe contener entre 4-12 caracteres solo se aceptan letras</p>
                </div>
        </div>
                     <div class="form-message  me_formulario" id="mensaje_error__formulario">
                    <p><center> <b><h3>Debes llenar todos los campos correctamente</h3></b></center> </p>
                   </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-0 "></div>
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 ">
                        <button type="submit" class="btn btn-success form-control">Guardar Editorial</button>
                    </div>
                  </div>
    </form>
</div>
    <!--termina contenido principal de la pagina-->
    </div><!--termina  row principall-->
</div>  <!--termina contenedor principal-->   
           
           <!--js-->
           
           <script src="../../js/validaNuevaEditorial.js">        </script>
           <?php require '../complementos/footer_2.php';?>