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
          
        <form class="form-control"action="../../controlador/enfermeria/subirArchivo.php" method="post" enctype="multipart/form-data">
            <input type="text" required hidden name = "idestudiante" autocomplete="off"value="<?=$_GET['c']?>">
            <input type="text" required hidden name = "idenfermeria" autocomplete="off"value="<?=$_GET['id']?>">
            <input type="text" name="nombre" placeholder ="nombre" class="form-control"><br><br>
            <input type="file" name="imagen" class="form-control"><br><br>
            <input type="submit" class="btn btn-success form-control" value="Aceptar">
        </form>
       
        </div>
    </div>

    </div>
<?php require '../complementos/footer_2.php';?>