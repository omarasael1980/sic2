<?php
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}

 require '../complementos/header_2.php';
require '../complementos/nav_2.php';
?>


<!-- body  -->

    <div class="row">
     
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h1>Ajustes Generales</h1></center>
        <br><hr>
        <center><h2>Ajustes de Usuarios</h2></center>
       
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="crearUsuarios.php">
          <center>  <img  class="img-menu-settings" src="../../img/icons/plus.png" alt="crearUsuarios"></center>
       <center><h2>Agregar Usuarios</h2></center></a>
        </div>     
        <br>
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="editaUsuarios.php">
          <center>  <img  class="img-menu-settings" src="../../img/icons/edit.png" alt="editaUsuario"></center>
          <center><h2>Ver/Modificar Usuarios</h2></center> </a>
        </div> 
        <br>    
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="permisosUsuario.php">
          <center>  <img  class="img-menu-settings" src="../../img/icons/profile.png" alt="permisosUsuario"></center>
          <center><h2>Modificar Permisos</h2></center> </a>
        </div>
        <br>
        <!--En definicion antes de construccion
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="tiposUsuario.php">
          <center>  <img  class="img-menu-settings" src="../../img/icons/tiposusuario.jpg" alt="tiposUsuario"></center>
          <center><h2>Tipos de Usuario</h2></center> </a>
        </div>-->
        <br>
    </div>
<hr>
<br>
<div class="row">
  <br>
  <center> <h2>Ajustes de Biblioteca</h2></center>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="../biblioteca/nuevoLibro.php">
          <center>  <img  class="img-menu-settings" src="../../img/icons/book.png" alt="nuevoLibro"></center>
       <center><h2>Alta de libro</h2></center></a>
        </div>     
        <br>
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="../biblioteca/editaEjemplar.php">
          <center>  <img  class="img-menu-settings" src="../../img/icons/edit.png" alt="editaUsuario"></center>
          <center><h2>Editar Ejemplares</h2></center> </a>
        </div> 
        <br>    
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="../biblioteca/binventario.php">
          <center>  <img  class="img-menu-settings" src="../../img/icons/book-back-button-.png" alt="permisosUsuario"></center>
          <center><h2>Asignar custodia de libro</h2></center> </a>
        </div>
        <br>
</div>

<?php require '../complementos/footer_2.php';?>