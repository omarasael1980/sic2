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
          <div class="row">
    <form action="../../controlador/usuarios/actualizaUsuarios.php" id="formulario" method="post" class="form-control2">
          <center><h1>Modificar Usuario</h1></center>
       
                <div class="row form-control">
                     <!--inicia nombre-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__nombre">
                     
                     <div class="form-group-input  ">
                     <label class="form-label" for="">Nombre:</label><input type="text" id="nombre" name="nombre" class="form-control" value="<?=$usuario['0']->nombre?>" placeholder="Nombre" required autocomplete="off">  
                             <i class=""><img class="form-validation-state img-input" id="img-nombre"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                   
                     <div  class="form-message " id="mensaje_error__nombre">
                     <p>Escribe el nombre, puede contener solo letras</p>
                     </div>
             </div>
            <!--inicia Apaterno-->
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__apaterno">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="">Apellido Paterno:</label>  <input type="text" id="apaterno" name="apaterno" value="<?=$usuario['0']->apaterno?>" class="form-control"required placeholder="Apellido paterno" autocomplete="off" >
                           
                                <i class=""><img class="form-validation-state img-input" id="img-apaterno"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__apaterno">
                        <p>Puede contener solo letras</p>
                        </div>
                    </div>
                     <!--inicia amaterno-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__amaterno">
                        
                        <div class="form-group-input  ">
                        <label  class="form-label" for="">Apellido Materno:</label>   <input type="text" id="amaterno"name="amaterno" value="<?=$usuario['0']->amaterno?>"class="form-control" required placeholder="Apellido materno" autocomplete="off">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-amaterno"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__amaterno">
                        <p>Puede contener solo letras</p>
                        </div>
                    </div>
                     <!--inicia usuario-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__usuario">
                        
                        <div class="form-group-input  ">
                        <label for="">Usuario:</label>    <input type="text" disabled id="usuario"name="usuario"value="<?=$usuario['0']->user?>" class="form-control"required placeholder="Usuario" autocomplete="off">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__usuario">
                        <p>Escribe el usuario, puede contener letras, números, guión alto o bajo.</p>
                        </div>
                    </div>
                     <!--inicia password-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__password">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="">Contraseña:</label>    <input type="password" id="password" name="password" value="" class="form-control"placeholder="Contraseña"autocomplete="off" >
                           
                                <i class=""><img class="form-validation-state img-input" id="img-password"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__password">
                        <p>El password debe tener entre 8 a 14 caracteres.</p>
                        </div>
                    </div>
                     <!--inicia rol-->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" >
                    <label class="form-label" for="">Tipo de usuario:</label><select name="roles" class="form-control" >
             <?php foreach ($roles as $rol):?>  
       
                    <option value="<?=$rol->idRol?>" <?php if($usuario['0']->roles_idRol == $rol->idRol){echo ' Selected';}?>>
                    <?=$rol->rol?></option>
                    <?php endforeach?>
            </select>
                        </div>
                     <!--inicia domicilio-->
                     <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 " id="grupo__domicilio">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="">Domicilio:</label>    <input type="text"  id="domicilio"name="domicilio"value="<?=$usuario['0']->domicilio?>" class="form-control"required placeholder="Domicilio" autocomplete="off">
                           
                                <i class=""><img class="form-validation-state img-input" id="img-domicilio"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__domicilio">
                        <p>Escribe domicilio, puede contener solo letras y números</p>
                        </div>
                    </div>
                     <!--inicia tel-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__tel">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="">Tel. Fijo:</label>    <input type="text" id="tel" name="tel" value="<?=$usuario['0']->tel?>" class="form-control"placeholder="Teléfono"autocomplete="off" >
                           
                                <i class=""><img class="form-validation-state img-input" id="img-tel"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__tel">
                        <p>El número de teléfono solo admite números, recibe de 10 a 12 dígitos</p>
                        </div>
                    </div>
                     <!--inicia cell-->
                     <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " id="grupo__cell">
                        
                        <div class="form-group-input  ">
                        <label class="form-label" for="">Tel. Celular:</label>    <input type="text" id="cell" name="cell" value="<?=$usuario['0']->cell?>" class="form-control"placeholder="Celular"autocomplete="off" >
                           
                                <i class=""><img class="form-validation-state img-input" id="img-cell"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    
                        <div class="form-message" id="mensaje_error__cell">
                        <p>El número de celular solo admite números, recibe de 10 a 12 dígitos</p>
                        </div>
                    </div>
                     <!--inicia oculto-->
                    <input type="text" name="id" value="<?=$_GET['id']?>" hidden>
                     <!--inicia mensaje de error d eformulario-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-message  me_formulario" id="mensaje_error__formulario">
                    <p><center> <b><h3>Debes llenar todos los campos con las instrucciones que se indican.</h3></b></center> </p>
                   </div>
                    
                    
                   
                      
                       
                   <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" ></div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" ><button class="btn btn-success form-control" type="submit">Guardar Registro</button></div>
                </div>   
                        
                     
                   
                </div>  
             
        </form>
       
    </div>

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