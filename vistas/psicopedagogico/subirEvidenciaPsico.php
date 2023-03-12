<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
?>



<!-- body  -->
<div class="container">
    <div class="row">
        <center><h1>Subir Evidencia</h1></center>
        <br><br><br>
    </div>
</div>
<div class="container">
    <div class="row ">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
       
        <form class="form-control" id="formulario" action="../../controlador/psicopedagogico/subirEvidencia.php"
         autocomplete ="off"method="post" enctype="multipart/form-data">
            <input type="text" required hidden name = "idestudiante"  autocomplete="off"value="<?=$_GET['c']?>">
            <input type="text" required hidden name = "folioPsico" autocomplete="off"value="<?=$_GET['id']?>">
            
            <!-- inicia input nombre -->
            <div class="form-group " id="grupo__nombre">
            <div class="form-group-input">
                <label for="nombre" class="form-label form-control2"> <b> Asignar Nombre:</b>
                    <input type="text"  spellcheck="true" lang="es"  onkeyup="valida1('nombre')" class="form-control" id="nombre" required name="nombre">
                        <i class=""><img class="form-validation-state img-input" id="img-usuario"
                        src="../../img/icons/cross.png" alt="incorrecto"> </i>
                </div> 
                </label>
                <div class="form-message" id="mensaje_error__nombre">
                        <p>Debes escribir un nombre para el archivo, solo se permiten letras</p>
                </div>
            </div> <br>
            <!-- termina input nombre -->
              <!-- inicia input imagen -->
            <div class="form-group " id="grupo__Archivo">
            <div class="form-group-input">
                <label for="Archivo" class="form-label form-control2"> <b> Asignar Archivo:</b>
                <input type="file" required name="imagen" id="Archivo"class="form-control"><br>
                  <i class=""><img class="form-validation-state img-input" id="img-usuario"
                        src="../../img/icons/cross.png" alt="incorrecto"> </i>
                </div> 
                </label> 
                <div class="form-message" id="mensaje_error__Archivo">
                        <p>Debes seleccionar un archivo (pdf, jpg, mp4)</p>
                </div>
            </div> <br>
           
            <!-- termina input imagen  -->
            <!-- <input type="text" required name="nombre" placeholder ="nombre" class="form-control"><br><br> -->
           
            <input type="submit" onclick="validarform()" class="btn btn-success form-control" value="Aceptar">
        </form>
       
        </div>
    </div>

    </div>
    <script src="../../js/validaSubirEvidencia.js"> </script>
<?php require '../complementos/footer_2.php';?>