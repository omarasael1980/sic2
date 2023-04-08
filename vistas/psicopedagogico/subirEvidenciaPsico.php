<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Psicopedagogico',$_SESSION['user']->perm)){
    header("Location:../../");
}
?>


<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 form-control2">
     <div class="row">
                 <center><a href="../../vistas/psicopedagogico/pprincipal.php">
                 <img class="img-menu" src="../../img/icons/psicologa.jpg" alt="Psicopedagógico"></a></center>
            </div>
            <div class="row">
                
                    <h4 class="text-center">Psicopedagógico</h4>
                
            </div>
            <div class="row">
                <h1 class="text-center">Menú</h1>
                <div class="list-group">
                  
                         <!--Menu desplegable-->
                        <?php  $espacios = "        ";?>
                         <a href="pprincipal.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-bars"> </i> <?=$espacios?>Pendientes</p>  </a>
                      <br>  <a class="list-group-item text-center list-group-item-action" href="psicoNuevoCaso.php"><p><i class="fa-solid fa-file-circle-plus"></i><?=$espacios?> Nuevo caso </p></a>
                       <br> <a href="historialPsico.php?id=<?=$_GET['c']?>" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-file-lines"></i> <?=$espacios?>Historial Alumno</p></a>
                       <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-column"></i><?=$espacios?>Estadísticas </p> </a>
                        
                </div>
                
            </div>

     </div>
      
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-control2">
<!--contenedor central -->
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
       
        <form class="form-control2" id="formulario" action="../../controlador/psicopedagogico/subirEvidencia.php"
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
           <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0 "></div>
            <input type="submit" onclick="validarform()" class="col-lg-4 col-md-4 col-sm-6 col-xs-6 nav-button-cargar form-control" value="Aceptar">
            <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0 "></div>
            <a href="pprincipal.php" class="col-lg-4 col-md-4 col-sm-6 col-xs-6  nav-button-cargar"> Cancelar</a>
            </div>
        </form>
       
        </div>
    </div>

    </div>
<!--  termina contenedor central-->
</div><!-- FIN CENTRO -->
<!--contenedor central -->
    
       
        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->

    <!--contenedor derecha -->

        </div>
    </div>
</div>
   

 

<?php require '../complementos/footer_2.php';?>


