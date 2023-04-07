<?php
include_once '../../modelo/usuarios/usuarios.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
abreSesion();
$expediente="";
if(isset($_SESSION['user'])){
    $id = $_SESSION['user']->idestudiantes;
    $expediente = buscaExpedienteMedico($id);
}


$espacios = "      ";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SICS</title>
    <link rel="icon" href="../../img/empresarial/logoSantee.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/myStyles.css">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
  
    <script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
 
	<!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LfXTVocAAAAACROczlljJmPqjALPJdP7n1tVjV6"></script>
    <script src="https://kit.fontawesome.com/eff852937b.js" crossorigin="anonymous"></script>

 
</head>

<body>
 


  
<div class="sticky-top">
        <div class="nav-logo row">
          
                <div class="div-logo col-lg-3 col-md-3 col-sm-12 col-xs-12">
               
                    <a href="./"><img src="../../img/empresarial/logoSantee.png" class="logo-navbar" alt="Colegio Santee"> </a>
            
                </div>
                <div class="menu col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <nav>
                    
              
               
                
                <?php if(isset($_SESSION['user'])):?>
                      
              
                        <a class="nav-button" href="../../controlador/usuarios/logout2.php"> LogOut</a>
                </div>
                               
                        <?php endif?>
                        </nav>
                        </div>
        </div>
</div>
            
   
       
<!--AQui inicia todo el contenido de index-->
<!--AQui inicia todo el formulario de login-->
<?php if(!isset($_SESSION['user'])):?>
<div class="container2">
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-0"></div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
          <br><br><br>
            <form action="../../controlador/control/loginAlumnos.php" class="form-control formulario" id="formulario" method='post'autocomplete="off">
                <div class="form-group " >
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3"></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <button class="logo-login "> <i class="fa-solid fa-graduation-cap"></i></button>
                        </div>
                      
                   
                    </div> 
                    
                 <div class="row"> 
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><h1 class="">Ingresar </h1></center></div>
               
                         </div>
                   
                </div>
                <div class="form-group " id="grupo__usuario">
                     
                        <div class="form-group-input  ">
                        <label for="usuario" class="form-label form-control2"> <b> Usuario:</b>
                             <input class="form-control img-container " type="text" name="usuario" placeholder="Usuario">
                             <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                        </label>
                   <div class="form-message" id="mensaje_error__usuario">
                    <h6 class="text-center"><b> Escribe tu usuario, debe contener entre 4-12 caracteres </b></h6>
                   </div>
                </div>
                    <br>
                <div class="form-group " id="grupo__password">
                     
                     <div class=" form-group-input">
                     <label for="password" class="form-label form-control2"> <b> Token:</b>
                          <input class="form-control img-container " type="password" name="password" placeholder="Token">
                          <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     <div class="form-message form-message" id="mensaje_error__password">
                    <h6 class="text-center"><b> Ingresa el token proporcionado por la institución</b></h6>
                   </div>
                     </label>
                     <br>
                     <br>
                     <div class="form-message  me_formulario" id="mensaje_error__formulario">
                     <b><h3 class="text-center">Si continuan los problemas, por favor comunicate con la dirección de secundaria Santee</h3></b>
                   </div>
                   <?php if(isset($_GET['tipo'])):?>
                        
                        <div class="form-message  me_formulario-active" id="mensaje_error__formulario">
                     <b><h3 class="text-cemter"><?=$_GET['msg']?></h3></b>
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
        <h1 class="text-center">Bienvenidos tutores de: </h1>
        <?php $u =$_SESSION['user']; ?>
        <h3 class="text-center"><?=$u->nombre." ".$u->apaterno." ".$u->amaterno?></h3>
        <h3 class="text-center">Grupo:<?=$u->grupo?></h3>
          <!-- cuerpo pagina -->
          <div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
       <div class="row">
                 <center><a href="eprincipal.php">
                 <img class="img-menu" src="../../img/icons/alumnos.jpeg" style="background:blue;" alt="enfermeria"></a></center>
        </div>
        <div class="row">
                
                    <h4 class="text-center">Alumnos</h4>
                
        </div>
        <div class="row">
                <h1 class="text-center">Menú</h1>
                <div class="list-group">
                  
                <a class="btn btn-primary list-group-item text-center list-group-item-action" href="ingresoAlumnos.php"><p>
                    <i class="fa-solid fa-house"></i><?=$espacios?> HOME </p></a>
              <br>  <a class="list-group-item text-center list-group-item-action" href="expedienteMedico.php?id=<?=$id?>"><p>
                <i class="fa-solid fa-book-medical"></i><?=$espacios?> Actualiza expediente médico </p></a>
                     
                      
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
<?php if ($expediente !=""):?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0 "></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                        <div class="row antecedentes">
                            <!-- se muestran el expediente si existe -->
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 m-0 p-0">
                            <p><b>Alergias: <?=$espacios.$expediente[0]->alergias?></b> </p>
                            <p class=""><b>Enfermedades Crónicas: <?=$espacios.$expediente[0]->enfermedadesCronicas?></b> </p>
                            <p class=""><b>Medicación permanente: <?=$espacios.$expediente[0]->medicacion?></b> </p>
                            <p class=""><b>Alerta activa: <?php if($espacios.$expediente[0]->estado==1){echo "si";}else{echo "no";}?></b> </p>
                </div>
                        </div>
                        <?php else:?>
                            <h3 class ="text-center"><b> Tienes pendiente actualizar el expediente médico</b> </h3>
                        <?php endif?>
                 </div>
            <!--contenedor central -->
          
                </div>
            </div>
     </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->
                 <!--Mostrar estadisticas --> 
             


                     
    <!--contenedor derecha -->

        </div>
    </div>
</div>

          <!-- termina cuerpo de pagina -->
       
        <?php endif?>
    </div>

       <script src="../../js/nav-bar.js">        </script>
     
       <script src="../../js/validacionesAlumnos.js">        </script>
     
    </body>
</html>