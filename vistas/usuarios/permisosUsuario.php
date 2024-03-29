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
$permisos = buscaPermisos();
$usuarios = cargaUsuarios();
if(isset( $_SESSION['msg'])){
  $mensaje =  $_SESSION['msg']['msg'];
  $tipo = $_SESSION['msg']['tipo'];
  if($tipo == "success"){ $encabezado = "Excelente!";}else{ $encabezado = "Lo siento!";}
  echo"<script   type= text/javascript >

  Swal.fire(
  '$encabezado',
  '$mensaje',
  '$tipo'
)

</script>";
unset($_SESSION['msg']);
}
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
                        <!-- termina menu desplegable enfermeria -->
                           <!-- menu desplegable Psicopedagogia -->
<!--                        
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
                        </div> -->
                        <!-- termina menu desplegable enfermeria -->
                      
                    
                     
                   
                     
        </div>
              
      </div>
      </div>
    
       
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-11 ">
          <!--contenedor central -->
    
          <div class="row">
                
                <h1 class="text-center">Asignación de permisos</h1>
                <?php foreach ($permisos as $rol): ?>
                 <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <hr>
                        <h6 class="text-center"><b><?=$rol['name']?></b></h2>
                             <form class="form-control2" action="../../controlador/usuarios/ajustarPermisos.php" method="post">
                               <input type="text"name="perfil" hidden value="<?=$rol['id']?>">
                                
                                 <?php foreach ($rol['permisos'] as $perm): ?>
                                     
                                             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                               <div class="row">
                                                         <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6"> 
                                                         <h6 style ="color:black;"><b><?=$perm->permisos?></b></h6>
                                                        </div>
                                                         
                                                            <input class="micheck col-lg-4 col-md-4 col-sm-4 col-xs-4" name="permisos[]" value="<?=$perm->idPermisos?>" 
                                                             type="checkbox" <?=$perm->set ? 'checked': ''?>>
                                                      
                                                </div>  
                                             </div>
                                 <?php endforeach?>
                                 <div class="row">
                                 <div class="col-lg-4 col-md-3 col-sm-2 col-xs-0"></div>
                                 <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
                                 <button type="submit" class=" form-control nav-button-cargar">Guardar </button></div>
                             
                             </form>
                             </div>`
                 </div>
                 <?php endforeach?>
                 </div>
             </div>
         
            <!--contenedor central -->
          
       
            </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
       
    </div>
</div>


       
<?php require '../complementos/footer_2.php';?>