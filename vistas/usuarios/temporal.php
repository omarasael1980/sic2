<?php
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
        header("Location:../../");
    }
?>
<?php require '../complementos/header_2.php';?>
<?php require '../complementos/nav_2.php';

require '../../modelo/config/comunes.php';

$roles = buscaRoles();
$usuario = cargarUsuariosID($_GET['id']);
$espacios ="         ";
?>


<!-- body  -->
<div class="container2">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
     <div class="row">
                 <center><a href="usuariosPrincipal.php">
                 <img class="img-menu" src="../../img/icons/settings2.png" alt="enfermeria"></a></center>
        </div>
        <div class="row">
                
                    <h4 class="text-center">Ajustes</h4>
                
        </div>
        <div class="row">
        
              
              <div class="list-group">
              
                       <!--Menu desplegable-->
                      
                       <a href="usuariosPrincipal.php?id=0" class=" <?=$id0?> list-group-item text-center list-group-item-action " aria-current="true">
                       <p> <i class="fa-solid fa-list-check"></i><?=$espacios?>Generales</p>  </a>
                        <!-- menu desplegable ususarios -->
                       
                      <br>  <div class="dropdown">
                          <a class="btn btn-primary list-group-item text-center list-group-item-action" data-bs-toggle="collapse" 
                           data-bs-target="#collapse" aria-expanded="false" aria-controls="collapseWidthExample">
                            <p><i class="fa-solid fa-user-tie"></i>
                           Ajustes de usuarios</p>
                          </a>
                          <div class="collapse"  id="collapse" >
                            <br><a class="nav-button-cargar2" href="crearUsuarios.php"><p>
                              <i class="fa-solid fa-plus"></i>Agregar Usuarios</p>
                              </a>
                            <br><a class="nav-button-cargar2" href="editaUsuarios.php"><p><i class="fa-solid fa-user-pen"></i> Editar Usuarios</p></a>
                            <br><a class="nav-button-cargar2" href="permisosUsuario.php"><p><i class="fa-solid fa-pen"></i> Editar Permisos</p></a>
                          </div>
                        </div>
                        <!-- termina menu desplegable usuarios -->
                           <!-- menu desplegable bibluoteca -->
                       
                      <br>  <div class="dropdown">
                          <a class="list-group-item text-center list-group-item-action" data-bs-toggle="collapse" 
                           data-bs-target="#collapseBiblioteca" aria-expanded="false" aria-controls="collapseWidthExample">
                          <p> <i class="fa-solid fa-book"></i> 
                            Ajustes de Biblioteca</p>
                          </a>
                          <div class="collapse"  id="collapseBiblioteca" >
                            <br><a class="nav-button-cargar2" href="../biblioteca/nuevoLibro.php"><p>
                            <i class="fa-solid fa-plus"></i>Alta de libro</p> </a>
                            <br><a class="nav-button-cargar2" href="../biblioteca/editaEjemplar.php"><p><i class="fa-solid fa-pen"></i> Editar Ejemplares</p></a>
                            <br><a class="nav-button-cargar2" href="../biblioteca/binventario.php?idprocedencia='Ajustes"><p><i class="fa-brands fa-hive"></i> Asignar custodia de libro</p></a>
                          </div>
                        </div>
                        <!-- termina menu desplegable biblioteca -->
                               <!-- menu desplegable enfermeria -->
                               <br>  <div class="dropdown">
                        <a href="usuariosPrincipal.php?id=3" class=" <?=$id3?> list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-list-check"></i><?=$espacios?>Enfermería</p>  </a>
                           
                          </div>
                      
                      
                    
                     
                   
                     
        </div>
              
      </div>
      </div>
    
       
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-11 ">
          <!--contenedor central -->
          <h1 class="text-center">Subir archivos masivamente</h1>

          <form action="../../controlador/ajustes/subirMasivamente.php" method="post" enctype="multipart/form-data">
                       <h6>Elige el archivo CSV</h6> 
                       <input type="file" name="archivo" id="archivo">
                       <input type="submit" value="Cargar">
          </form>

            <!--contenedor central -->
          
       
            </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
       
    </div>
</div>

 
<script src="../../js/valida.js">        </script>
        <script src="../../js/valida-usuarios.js">        </script>
        <script>
                campos.usuario= true;
        </script>
<?php require '../complementos/footer_2.php';?>