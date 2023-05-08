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
                <div class="row">
                <h1 class="text-center">Subir archivos masivamente</h1>

                <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0 "></div> 
                <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 ">
                                    <!--contenedor central -->
                     
                        <form action="../../controlador/ajustes/subirMasivamente.php" method="post" enctype="multipart/form-data">
                                    <h6>Elige el archivo CSV</h6> 
                                    <input class="btn btn-primary" type="file" name="archivo" id="archivo">
                                    <br> <br>
                                    <button type="submit" name= "subir" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 nav-button-cargar">Cargar</button>
                        </form>
                    </div> 
                 </div>
            <!--contenedor central -->
          <?php
          if(isset($_REQUEST['subir'])){
            $nombre = $_FILES['archivo']['name'];
            $tipo = $_FILES['archivo']['type'];
            if($tipo != 'text/csv'){
                die("Archivo no valido");
                }
            $destino = "../../private/docs/csv/$nombre";
            $res = copy($_FILES['archivo']['tmp_name'],$destino);
            ?>
             <div class="alert alert-<?php echo $res? "primary":"danger"?> alert-dismissible fade show" role="alert" >
                <button type="button " class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" >&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <?php echo $res? "Archivo subido correctamente":"Problemas al cargar archivo"?>
             </div>
            <?php
                if(file_exists($destino)){
                    $archivo = fopen($destino,"r");
                    while(fgetcsv($archivo) !=false){
                        echo $columna[0]."-----".$columna[1]."-----".$columna[2]."-----".$columna[3]."-----".$columna[4]."-----".$columna[5]."-----".$columna[6]."<br>";
                    }
                }

          }
          ?>
       
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