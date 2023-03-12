<?php
include 'modelo/usuarios/usuarios.php';
abreSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SICS</title>
    <link rel="stylesheet" type="text/css" href="css/myStyles.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>

<body>
 
 
<pre>
    <?php
    print_r($_SESSION);
    ?>
</pre>
    <div class="container">
    <div class="container">
        <div class="nav-logo row">
     
            <div class="div-logo col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <label for="" class="logoS"><center><a href="#">
                    <p><img src="img/empresarial/logoSantee.png" alt="Colegio Santee"> </p>    </a></center>
                </label>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <nav>
                
                <?php if(!isset($_SESSION['user'])):?>
                <a class="nav-bar desaparece" href="vistas/usuarios/login.php"><center>Login</center> </a>
                
                        
                <?php else:?>
                            <?php if(in_array('Enfermeria',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="vistas/enfermeria/eprincipal.php"> <center>Enfermeria</center></a>
                        <?php endif?>
                        <?php if(in_array('Biblioteca',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" style=" vertical-align: middle;" href="#"><center>Biblioteca</center> </a>
                        <?php endif?>
                        <?php if(in_array('Directorio',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="#"> <center>Directorio</center></a>
                        <?php endif?>
                        <?php if(in_array('Psicopedagogico',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="#"><center>Psicopedagógico</center> </a>
                        <?php endif?>
                        <?php if(in_array('Prefectura',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="#"> <center>Prefectura</center></a>
                        <?php endif?>
                        <?php if(in_array('Ajustes',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="/vistas/usuarios/usuariosPrincipal.php"><center>Configuración</center> </a>             
                        <?php endif?>
                       
                        <button class="nav-button" onclick="accion()">Menú</button>
                        </div>
                        
               
            </nav>
          
                
                       
                       
            </div>
        </div>
        <div class="row">
        <div class="col-lg-11 col-md-11 col-sm-9 col-xs-8 "></div>
        <div class="col-lg-1 col-md-1 col-sm-3 col-xs-4 ">
                        <a class="form-control btn btn-danger"  href="controlador/usuarios/logout.php"><center>LogOut</center> </a></div>
                       
                        <?php endif?>
                        </div>
    </div>
<!--AQui inicia todo el contenido de index-->
<!--AQui inicia todo el formulario de login-->
<?php if(!isset($_SESSION['user'])):?>
<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-3 col-xs-0"></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          
            <form action="controlador/control/login.php" class="form-control" method='post'autocomplete="off">
                <div class="form-group ">
                    <div class="row">
                         <center><a href=""><img class=" img-menu"
                         src="img/icons/profile.png" alt="usuario"> </a> </center>
                    </div> 
                 <div class="row"> 
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><h3 class="title">Ingresar </h3></center></div>
               
                         </div>
                   
                </div>
                <div class="form-group">
                    <input class="form-control " type="text" name="username" placeholder="Usuario">
                    </div>
                    <br>
                <div class="form-group">
                    <input class="form-control " type="password" name="password" placeholder="Contraseña">
                </div>
                <br>
               <p class="center "><button class="btn btn-primary form-control" type="submit">
               Entrar</button></p> 
               
            </form>
            
        </div>
       
    </div>
</div>
<!--AQui inicia todo el contenido menu principal-->
<!--Si esta logueado el usuario se muestra el menu principal Sino se manda a login-->


    <?php endif?>
    <?php if(isset($_SESSION['user'])):?>
    <div class="row">
        <center><h1>Welcome <?=$_SESSION['user']->nombre?></h1></center>
        <br>
        <br>
        <br>
        <br>
        <Center><H3>Menú de opciones</H3></Center>
        <br>
        <br>

        <?php if(in_array('Ajustes',$_SESSION['user']->perm)):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 ">
            <div class="row ">
                 <center><a href="vistas/usuarios/usuariosPrincipal.php">
                 <img class="img-menu" src="img/icons/settings.webp" alt="Configuracion"></a></center>
            </div>
            <div class="row">
                <h3><center>Configuración</center></h3>
            </div>   
        </div> 
        <?php endif?>
        <?php if(in_array('Enfermeria',$_SESSION['user']->perm)):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div class="row">
                 <center><a href="vistas/enfermeria/eprincipal.php">
                 <img class="img-menu" src="img/icons/first-aid-kit.png" alt="Enfermeria"></a></center>
            </div>
            <div class="row">
                <h3><center>Enfermeria</center></h3>
            </div>   
        </div> 
        <?php endif?>
        <?php if(in_array('Psicopedagogico',$_SESSION['user']->perm)):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div class="row">
                 <center><a href="vistas/psicopedagogico/pprincipal.php">
                 <img class="img-menu" src="img/icons/psicologa.jpg" alt="Psicopedagógico"></a></center>
            </div>
            <div class="row">
                <h3><center>Psicopedagógico</center></h3>
            </div>   
        </div> 
        <?php endif?>
        <?php if(in_array('Biblioteca',$_SESSION['user']->perm)):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div class="row">
                 <center><a href="vistas/biblioteca/bprincipal.php">
                 <img class="img-menu" src="img/icons/libreria.jpg" alt="biblioteca"></a></center>
            </div>
            <div class="row">
                <h3><center>Biblioteca</center></h3>
            </div>   
        </div> 
        <?php endif?>
        <?php if(in_array('Prefectura',$_SESSION['user']->perm)):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div class="row">
                 <center><a href="vistas/prefectura/pprincipal.php">
                 <img class="img-menu" src="img/icons/iconmonstr-user.png" alt="prefectura"></a></center>
            </div>
            <div class="row">
                <h3><center>Prefectura</center></h3>
            </div>   
        </div> 
        <?php endif?>
        <?php if($_SESSION['user']->roles_idRol == 7):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div class="row">
                 <center><a href="vistas/alumnos/aprincipal.php">
                 <img class="img-menu" src="img/icons/profile.png" alt="padres"></a></center>
            </div>
            <div class="row">
                <h3><center>Padres de Familia</center></h3>
            </div>   
        </div> 
        <?php endif?>
        <?php endif?>
    </div>
    </div>
       <script src="js\nav-bar.js">        </script>
       <script src="js\peticiones.js">        </script>
    </body>
</html>


<script>
    $('#formulario').submit(function(event) {
        event.preventDefault();
        
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfXTVocAAAAACROczlljJmPqjALPJdP7n1tVjV6', {action: 'registro'}).then(function(token) {
                $('#formulario').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#formulario').prepend('<input type="hidden" name="action" value="registro">');
                $('#formulario').unbind('submit').submit();
            });
        });
  });
  </script>

<form action="../../controlador/usuarios/insertarUsuarios.php" id="formulario"method="post" autocomplete="off" class="form-control">
          <center><h1>Crear Usuarios</h1></center>
       
                <div class="row form-control">
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
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" ><button class="form-control btn btn-success" type="submit">Guardar Registro</button></div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" ><a class="form-control btn btn-danger" href="usuariosPrincipal.php"> <center>Cancelar</center> </a></div>
               
            </div>
        </form>