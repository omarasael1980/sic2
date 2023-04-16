<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require '../../modelo/config/comunes.php';

$espacios = "        ";
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}
$roles = buscaRoles();
$usuarios = cargaUsuarios();
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
                            <br><a class="nav-button-cargar2" href="../biblioteca/binventario.php"><p><i class="fa-brands fa-hive"></i> Asignar custodia de libro</p></a>
                          </div>
                        </div>
                        <!-- termina menu desplegable biblioteca -->
                               <!-- menu desplegable enfermeria -->
                       
                      <br>  <div class="dropdown">
                          <a class="list-group-item text-center list-group-item-action" data-bs-toggle="collapse" 
                           data-bs-target="#collapseEnfermeria" aria-expanded="false" aria-controls="collapseWidthExample">
                          <p> <i class="fa-solid fa-user-nurse"></i>
                            Ajustes de Enfermería</p>
                          </a>
                          <div class="collapse"  id="collapseEnfermeria" >
                            <br><a class="nav-button-cargar2" href="../biblioteca/nuevoLibro.php"><p>
                            <i class="fa-solid fa-plus"></i>Alta de libro</p> </a>
                            <br><a class="nav-button-cargar2" href="../biblioteca/editaEjemplar.php">Editar Ejemplares</a>
                            <br><a class="nav-button-cargar2" href="../biblioteca/binventario.php">Asignar custodia de libro</a>
                          </div>
                        </div>
                        <!-- termina menu desplegable enfermeria -->
                           <!-- menu desplegable Psicopedagogia -->
                       
                      <br>  <div class="dropdown">
                          <a class="list-group-item text-center list-group-item-action" data-bs-toggle="collapse" 
                           data-bs-target="#collapsePsicopedagogica" aria-expanded="false" aria-controls="collapseWidthExample">
                          <p> <i class="fa-solid fa-head-side-virus"></i> 
                            Ajustes de Psicopedagogía</p>
                          </a>
                          <div class="collapse"  id="collapsePsicopedagogica" >
                            <br><a class="nav-button-cargar2" href="../biblioteca/nuevoLibro.php"><p>
                            <i class="fa-solid fa-plus"></i>Alta de libro</p> </a>
                            <br><a class="nav-button-cargar2" href="../biblioteca/editaEjemplar.php">Editar Ejemplares</a>
                            <br><a class="nav-button-cargar2" href="../biblioteca/binventario.php">Asignar custodia de libro</a>
                          </div>
                        </div>
                        <!-- termina menu desplegable enfermeria -->
                      
                    
                     
                   
                     
        </div>
              
      </div>
      </div>
    
       
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-11 ">
          <!--contenedor central -->
    
          <div class="row">
          <h1 class="text-center">Editar Usuarios</h1>
    </div>


        


    <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;" >
        <!-- Se cargan los usuarios con sus datos   -->     
  <thead class="cabeceraTabla">
    <tr>
      
      <th  scope="col" hidden> id </th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido Paterno</th>
      <th scope="col">Apellido Materno</th>
      <th scope="col">Usuario</th>
      <th scope="col">Password</th>
      <th scope="col">Tipo de usuario</th>
      <th scope="col">acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($usuarios as $us):?>
        
    <tr class="" >
   
      <td hidden><?=$us->idUsuario?></td>
      <td style="border-top: 1px solid rgb(58, 56, 56);"><?=$us->nombre?></td>
      <td style="border-top: 1px solid rgb(58, 56, 56);"><?=$us->apaterno?></td>
      <td style="border-top: 1px solid rgb(58, 56, 56);"><?=$us->amaterno?></td>
      <td style="border-top: 1px solid rgb(58, 56, 56);"><?=$us->user?></td>
      <td type="password"style="border-top: 1px solid rgb(58, 56, 56);">**********</td>
      <td style="border-top: 1px solid rgb(58, 56, 56);">
      
      <select name="roles" disabled >
      <?php foreach ($roles as $rol):?>  
       
  <option value="<?=$rol->idRol?>" <?php if($us->roles_idRol == $rol->idRol){echo ' Selected';}?>><?=$rol->rol?></option>
  <?php endforeach?>
</select>

</td>
      <td style="border-top: 1px solid rgb(58, 56, 56);">
        <!--Editar usuarios-->
        <a href="actualizaUsuarios.php?id=<?=$us->idUsuario?>"><img class="user-icono" src="../../img/icons/edit.png" alt="usuario"> </a>
         <!--Borrar usuarios-->
        <a href="../../controlador/usuarios/eliminarUsuario.php?id=<?=$us->idUsuario?>"><img class="user-icono" src="../../img/icons/delete.png" alt="usuario"> </a>
    </td>
    </tr>
   
    <?php endforeach?>
   
  </tbody>
</table>
        
   

   
        





            <!--contenedor central -->
          
       
            </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
       
    </div>
</div>


       
<?php require '../complementos/footer_2.php';?>