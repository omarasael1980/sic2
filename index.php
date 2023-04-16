<?php
include_once 'modelo/usuarios/usuarios.php';
abreSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SICS</title>
    <link rel="icon" href="img/empresarial/logoSantee.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/myStyles.css">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
  
    <script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
 
	<!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LfXTVocAAAAACROczlljJmPqjALPJdP7n1tVjV6"></script>
  

 
</head>

<body>
 


  
<div class="sticky-top">
        <div class="nav-logo row">
          
                <div class="div-logo col-lg-3 col-md-4 col-sm-12 col-xs-12">
               
                    <a href="./"><img src="img/empresarial/logoSantee.png" class="logo-navbar" alt="Colegio Santee"> </a>
            
            </div>
            <div class="menu col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <nav>
                    
              
               
                
                <?php if(isset($_SESSION['user'])):?>
                        <a class="nav-button" onclick="accion()">Menú</a>
              
                            <?php if(in_array('Enfermeria',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="vistas/enfermeria/eprincipal.php"> <center>Enfermeria</center></a>
                        <?php endif?>
                        <?php if(in_array('Biblioteca',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" style=" vertical-align: middle;" href="vistas/biblioteca/bprincipal.php"><center>Biblioteca</center> </a>
                        <?php endif?>
                        <?php if(in_array('Directorio',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="#"> <center>Directorio</center></a>
                        <?php endif?>
                        <?php if(in_array('Psicopedagogico',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="vistas/psicopedagogico/pprincipal.php"><center>Psicopedagógico</center> </a>
                        <?php endif?>
                        <?php if(in_array('Prefectura',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="#"> <center>Prefectura</center></a>
                        <?php endif?>
                        <?php if(in_array('Ajustes',$_SESSION['user']->perm)):?>
                        <a class="nav-bar desaparece" href="/vistas/usuarios/usuariosPrincipal.php"><center>Configuración</center> </a>             
                        <?php endif?>
                        <a class="nav-button" href="../../controlador/usuarios/logout.php"> LogOut</a>
                </div>
                               
                        <?php endif?>
                        </nav>
                        </div>
          
            </div>
            </div>
            
        </div>
       
<!--AQui inicia todo el contenido de index-->
<!--AQui inicia todo el formulario de login-->
<?php if(!isset($_SESSION['user'])):?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-0"></div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
          <br><br><br>
            <form action="controlador/control/login.php" class="form-control formulario" id="formulario" method='post'autocomplete="off">
                <div class="form-group " >
                    <div class="row">
                         <center><a href=""><img class=" img-menu"
                         src="img/icons/profile.png" alt="usuario">  </a> </center>
                    </div> 
                    
                 <div class="row"> 
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><h1 class="">Ingresar </h1></center></div>
               
                         </div>
                   
                </div>
                <div class="form-group " id="grupo__usuario">
                     
                        <div class="form-group-input  ">
                        <label for="usuario" class="form-label form-control2"> <b> Usuario:</b>
                             <input class="form-control img-container " type="text" name="usuario" placeholder="Usuario">
                             <i class=""><img class="form-validation-state img-input" id="img-usuario"src="img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                        </label>
                   <div class="form-message" id="mensaje_error__usuario">
                    <p>Escribe tu usuario, debe contener entre 4-12 caracteres</p>
                   </div>
                </div>
                    <br>
                <div class="form-group " id="grupo__password">
                     
                     <div class=" form-group-input">
                     <label for="password" class="form-label form-control2"> <b> Contraseña:</b>
                          <input class="form-control img-container " type="password" name="password" placeholder="Contraseña">
                          <i class=""><img class="form-validation-state img-input" src="img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     <div class="form-message form-message" id="mensaje_error__password">
                    <p>Debe tener al menos una mayúscula, minuscula y un número, longitud mínima de 8 caracteres</p>
                   </div>
                     </label>
                     <br>
                     <br>
                     <div class="form-message  me_formulario" id="mensaje_error__formulario">
                    <p><center> <b><h3>Debes llenar todos los campos</h3></b></center> </p>
                   </div>
                   <?php if(isset($_GET['tipo'])):?>
                        
                        <div class="form-message  me_formulario-active" id="mensaje_error__formulario">
                    <p><center> <b><h3><?=$_GET['msg']?></h3></b></center> </p>
                   </div>
                        <?php endif?>
             </div>
            
                
                <br>
                <button type="submit" class="btn btn-primary form-control" id="entrar">Entrar</button>
               
               
            </form>
            
        </div>
       
    </div>
</div>
<!--AQui inicia todo el contenido menu principal-->
<!--Si esta logueado el usuario se muestra el menu principal Sino se manda a login-->


    <?php endif?>
    <?php if(isset($_SESSION['user'])):?>
    <div class="row">
        <h1 class="text-center">Bienvenid@ <?=$_SESSION['user']->nombre?></h1>
        <br>
        <br>
        <br>
        <br>
        <H3 class="text-center">Menú de opciones</H3>
        <br>
        <br>

        <?php if(in_array('Ajustes',$_SESSION['user']->perm)):?>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 "></div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 ajustes ">
                 <a href="vistas/usuarios/usuariosPrincipal.php">
                 <img class="img-menu-settings" src="img/icons/settings2.png" alt="Configuracion"> 
                 <p class="text-center">Configuración</p></a>
        
        </div> 
        <?php endif?>
        <?php if(in_array('Enfermeria',$_SESSION['user']->perm)):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 ajustes">
            <a href="vistas/enfermeria/eprincipal.php">
            <img class="img-menu-settings" src="img/icons/first-aid-kit.png" alt="Enfermeria"><p class="text-center">Enfermeria</p></a>         
        </div> 
        <?php endif?>
        <?php if(in_array('Psicopedagogico',$_SESSION['user']->perm)):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 ajustes">
              <a href="vistas/psicopedagogico/pprincipal.php">
                 <img class="img-menu-settings" src="img/icons/psicologa.jpg" alt="Psicopedagógico"> <p class="text-center">Psicopedagógico</p></a>
        </div> 
        <?php endif?>
        <?php if(in_array('Biblioteca',$_SESSION['user']->perm)):?>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 ajustes">
              <a href="vistas/biblioteca/bprincipal.php">
                 <img class="img-menu-settings" src="img/icons/libreria.jpg" alt="biblioteca">  <p class="text-center">Biblioteca</p></a>
        </div> 
        <?php endif?>
       
        <?php endif?>
    </div>

       <script src="js/nav-bar.js">        </script>
     
       <script src="js/validaciones.js">        </script>
     
    </body>
</html>