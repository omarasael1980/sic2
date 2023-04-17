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
                       
                      <!-- <br>  <div class="dropdown">
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
          <div class="container">
    <div class="row">
    
 <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
 <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
       



        
          <form action="../../controlador/usuarios/insertarUsuarios.php" id="formulario"method="post" autocomplete="off" class="form-control2">
          <center><h1>Crear Usuarios</h1></center>
       
                <div class="row ">
                    <!--inicia nombre-->
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__nombre">
                            <div class="form-group-input  ">
                            <label class="form-label" for="nombre">Nombre:</label>
                                <input class="form-control img-container " required id="nombre" type="text" name="nombre" placeholder="Nombre">
                                    <i class=""><img class="form-validation-state img-input" id="img-nombre"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                            </div>
                            <div class="form-message" id="mensaje_error__nombre">
                            <p>Escribe el nombre, puede contener solo letras</p>
                            </div>
                    </div>
                   <!--inicia Apaterno-->
                   <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__apaterno">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="apaterno">Apellido Paterno:</label>
                            <input class="form-control img-container " required id="apaterno" type="text" name="apaterno" placeholder="Apellido Paterno">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-apaterno"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__apaterno">
                        <p>Puede contener solo letras</p>
                        </div>
                    </div>
                     <!--inicia amaterno-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__amaterno">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="amaterno">Apellido Materno</label>
                            <input class="form-control img-container " required id="amaterno" type="text" name="amaterno" placeholder="Apellido Materno">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-amaterno"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__amaterno">
                        <p>Puede contener solo letras</p>
                        </div>
                    </div>
                     <!--inicia usuario-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__usuario">
                        
                        <div class="form-group-input  ">
                            <label class="form-label" for="usuario">Usuario</label>
                            <input class="form-control img-container " required id="usuario" type="text" name="usuario" placeholder="Usuario">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__usuario">
                        <p>Escribe el usuario, puede contener letras, números, guión alto o bajo.</p>
                        </div>
                    </div>
                     <!--inicia password-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__password">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="password">Contraseña:</label>
                            <input class="form-control img-container " required id="password" type="password" name="password" placeholder="Password">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-password"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__password">
                        <p>El password debe tener entre 8 a 14 caracteres.</p>
                        </div>
                    </div>
                     <!--inicia rol-->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" >
                    <label class="form-label" for="rol">Tipo de Usuario:</label>
                            <select id="rol" name="rol" class="form-control">
                                <?php foreach($roles as $rol):?>
                                <option value="<?=$rol->idRol?>"><?=$rol->rol?></option>
                               <?php endforeach?>.
                            </select>
                        </div>
                     <!--inicia domicilio-->
                     <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 " id="grupo__domicilio">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="domicilio">Domicilio:</label>
                            <input class="form-control img-container " required id="domicilio" type="text" name="domicilio" placeholder="Domicilio">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-domicilio"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__domicilio">
                        <p>Escribe domicilio, puede contener solo letras y números</p>
                        </div>
                    </div>
                     <!--inicia tel-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__tel">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="tel">Teléfono:</label>
                            <input class="form-control img-container " required id="tel" type="tel" name="tel" placeholder="Teléfono">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-tel"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__tel">
                        <p>El número de teléfono solo admite números,recibe 10 dígitos ejemplo: 123-456-7890</p>
                        </div>
                    </div>
                     <!--inicia cell-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__cell">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="cell">Celular:</label>
                            <input class="form-control img-container " required id="cell" type="tel" name="cell" placeholder="Celular">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-cell"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__cell">
                        <p>El número de celular solo admite números, recibe 10 dígitos ejemplo: 123-456-7890</p>
                        </div>
                    </div>
                     <!--inicia usuario-->
                        
                    
                   
                </div>  
                <div class="form-message  me_formulario" id="mensaje_error__formulario">
                    <p><center> <b><h3>Debes llenar todos los campos con las instrucciones que se indican.</h3></b></center> </p>
                   </div>
                <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-1 col-xs-12" ></div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" ><button class="form-control nav-button-cargar" type="submit">Guardar Registro</button></div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" ><a class="form-control nav-button-cargar" href="usuariosPrincipal.php"> <center>Cancelar</center> </a></div>
               
            </div>
        </form>
        </div>
        </div>
        </div>

            <!--contenedor central -->
          
       
            </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
       
    </div>
</div>

 
<script src="../../js/valida.js">        </script>
        <script src="../../js/valida-usuarios.js">        </script>
       
<?php require '../complementos/footer_2.php';?>