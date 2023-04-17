<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';

require '../../modelo/config/comunes.php';

$espacios = "        ";
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
    header("Location:../../");
}
$id =0;
if(isset($_GET['id'])){
  $id = $_GET['id'];
}
      switch($id){
      case 0:
        $id0 ='btn btn-primary';
        break;
      case 1:
        $id1 ='btn btn-primary';
        break;
      case 2:
          $id2 = 'btn btn-primary';
          break;
      case 3:
        $id3 = "btn btn-primary";
        break;
      case 4:
          $id4 = 'btn btn-primary';
          break;

      }
$hoy = date("Y-m-d");
$min =  date("Y-m-d", strtotime($hoy."- 1 year"));

$espacios="      ";
$ajustes = buscSettings();
$fechaInicioClases = $ajustes[0]->inicioClases;
$fic = str_replace("-","/",$fechaInicioClases);
function ampm ($hora){
  $hora = strtotime($hora);
  $mediodia = strtotime("12:00:00");
  if($hora > $mediodia ){echo ' pm';}else{echo ' am';}
}

?>


<!-- body  -->
<div class="container-fluid">
    
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
                            <a class="list-group-item text-center list-group-item-action" data-bs-toggle="collapse" 
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
                              <br><a class="nav-button-cargar2" href="../biblioteca/binventario.php?idprocedencia='Ajustes">Asignar custodia de libro</a>
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
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
          <?php foreach($ajustes as $a):?>   
          <?php if($id==0):?>
            <h1>Ajustes Generales</h1>
            <hr>
                <!-- ajustes generales -->
                <form action="../../controlador/ajustes/guardaAjustes.php" method="post">
                <div class="misAjustes">

                  <p><b>Inicio de clases:</b></p><p> Establece la fecha de inicio de ciclo escolar que se toma como base para los cálculos estadísticos del sistema.</p>
                  <input name="fechaInicioClases"class="text-center" type="date" min= "<?=$min?>" max="<?=$hoy?>"value="<?=$fechaInicioClases?>">
                  <p><b>Hora inicial de atención presencial de padres de familia para el sistema de citas:</b></p><p> La hora establecida permitirá controlar la hora más temprana en que se pueden citar a los padres de familia.</p>
                    <input type="time" name="iniciHorario"class="text-center" id="" value="<?=$a->inicioHorario?>"><?php ampm($a->inicioHorario)?>
                  <p><b>Hora final de atención presencial de padres de familia para el sistema de citas:</b></p><p>La hora establecida permitirá controlar la última hora en la que se pueden citar a los padres de familia.</p>
                  <input type="time" name="finHorario"class="text-center" id="" value="<?=$a->finHorario?>"><?php ampm($a->finHorario)?>
                  <p><b>Días de edición permitidos en los calendarios del sistema antes del día actual:</b></p>
                  <p>Este valor determina el control de permiso para hacer registros en días anteriores a la fecha actual, se debe ingresar un valor númerico entero positivo</p>
                  <input type="number" name="diasAntes" id="" value="<?=$a->diasAntes?>">
                  <p><b>Días de edición permitidos en los calendarios del sistema después del día actual:</b></p>
                  <p>Este valor determina el control de permiso para hacer registros en días anteriores a la fecha actual, se debe ingresar un valor númerico entero positivo</p>
                  <input type="number" name="diasDespues" id="" value="<?=$a->diasDespues?>">
                 
                </div>
                <button type="submit"  class="nav-button-icono form-control"><i class="iconofa fa-regular fa-floppy-disk"></i>Guardar cambios</button>
                </form>
               
                 <?php elseif($id ==1):?> 
                  <!-- Si id =1 entonces se muestran los ajustes de usuarios -->
                  <h1>Ajustes de usuarios</h1>

                  <div class="row">
                    <p><b>Agregar Usuario </b></p>
                   <p> Para realizar una alta de nuevos usuarios:</p>
                   <div class="nav-button-chico col-lg-2 col-md-2 col-sm-4 col-xs-6">
                   <i class="fa-solid fa-plus"></i><a href="crearUsuarios.php">
                  <p> Agregar Usuarios</p></a>
                  </div>  
                   
                  </div>
                  
<!--                   
                  <div class="row">
        <div class="ajustes col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="crearUsuarios.php">
          <img  class="img-menu-settings" src="../../img/icons/plus.png" alt="crearUsuarios">
         <p>Agregar Usuarios</p></a>
        </div>     
        
         <div class="ajustes col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="editaUsuarios.php">
           <img  class="img-menu-settings" src="../../img/icons/edit.png" alt="editaUsuario">
         <p class="text-center">Ver/Modificar Usuarios</p> </a>
        </div> 
         
         <div class="ajustes col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="permisosUsuario.php">
           <img  class="img-menu-settings" src="../../img/icons/profile.png" alt="permisosUsuario">
         <p class="text-center">Modificar Permisos</p> </a>
        </div>
    </div> -->
                <?php endif?>
                  <?php endforeach ?>    
                  
            <!--contenedor central -->
          
       
            </div>
<!-- FIN CENTRO -->
<!--contenedor central -->
     

        
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-control2">
    <!--contenedor derecha -->
    
   
                 <!--Mostrar estadisticas --> 
             <!-- solo si se ha elegido algo diferente a 0 -->
       


                     
    <!--contenedor derecha -->

        </div>
    </div>
</div>

 

<?php require '../complementos/footer_2.php';?>