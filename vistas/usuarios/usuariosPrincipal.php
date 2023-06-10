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
$id0="";$id1="";$id2="";$id3="";$id4="";
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
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->
          <?php foreach($ajustes as $a):?>   
          <?php if($id==0):?>
            <h1>Ajustes Generales</h1>
            <hr>
                <!-- ajustes generales -->
                <form action="../../controlador/ajustes/guardaAjustes.php" method="post">
                <div class="misAjustes">

                  <h5><b>Inicio de clases:</h5><p> Establece la fecha de inicio de ciclo escolar que se toma como base para los cálculos estadísticos del sistema.</b></p>
                  <input name="fechaInicioClases"class="text-center" type="date" min= "<?=$min?>" max="<?=$hoy?>"value="<?=$fechaInicioClases?>">
                  <h5><b>Hora inicial de atención presencial de padres de familia para el sistema de citas:</h5></p><p> La hora establecida permitirá controlar la hora más temprana en que se pueden citar a los padres de familia.</p>
                    <input type="time" name="iniciHorario"class="text-center" id="" value="<?=$a->inicioHorario?>"><?php ampm($a->inicioHorario)?>
                  <h5><b>Hora final de atención presencial de padres de familia para el sistema de citas:</h5></p><p>La hora establecida permitirá controlar la última hora en la que se pueden citar a los padres de familia.</p>
                  <input type="time" name="finHorario"class="text-center" id="" value="<?=$a->finHorario?>"><?php ampm($a->finHorario)?>
                  <h5><b>Días de edición permitidos en los calendarios del sistema antes del día actual:</h5></p>
                  <p>Este valor determina el control de permiso para hacer registros en días anteriores a la fecha actual, se debe ingresar un valor númerico entero positivo</p>
                  <input type="number" name="diasAntes" id="" value="<?=$a->diasAntes?>">
                  <h5><b>Días de edición permitidos en los calendarios del sistema después del día actual:</h5></p>
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
                  <?php elseif($id ==3):?>  
                    <form action="../../controlador/usuarios/ajustesEnfermeria.php" method="post">
                     <h6><b>Monto del Seguro:</b>En este campo puedes modificar el monto asegurado para el seguro escolar.
                      Debes borrar toda la cantidad e introducir una cantidad nueva, luego presiona el botón para guardar el cambio.</h6>
                     <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <input name="monto" id="monto" min="0"class="form-control"type="text"
                        onmouseleave="return maskMoneda(this)" 
                        onkeypress="return filterFloat(event,this);"  value="<?=$a->montoSeguro?>">
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <button class="nav-button-cargar"type="submit">Guardar Cambio</button>
                      </div>
                      
                       
                     </div>
                    </form>
                    <hr>
                    <div class="row">
                      <h6><b>Sistema de actualización de expedientes médicos:</b> El enlace te permite realizar las tareas necesarias 
                      para que los tutores puedan realizar las actualizaciones al expediente médico del alumno.</h6>
                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <a  href="../enfermeria/configSubirExpMasivo.php"class="nav-button-cargar">Iniciar proceso</a>
                      </div>
                      
                    </div>
                    <hr>
                    <div class="row">
                      <h6><b>Página de acceso para tutores:</b> El enlace permite realizar el login de los tutores una vez que se hayan mandado el usuario y el token.</h6>
                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <a  href="../alumnos/ingresoAlumnos.php"class="nav-button-cargar">Ir a inicio para estudiantes</a>
                      </div>
                      
                    </div>
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

 
<script>
  function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{       
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {     
              return true;              
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{    
                    
                    return true;
                }
          }else{
              return false;
          }
    }

}
function filter(__val__) {
  var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
  return preg.test(__val__);
}


function maskMoneda(input) {
  const monto = input.value.replace(/[^\d.]/g, ''); // eliminar cualquier caracter que no sea dígito o punto
  const parts = monto.split('.');
  let formattedValue = `$${parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',')}`;
  if (parts.length > 1) {
    formattedValue += `.${parts[1].substring(0, 2).padEnd(2, '0')}`;
  } else {
    formattedValue += '.00';
  }
  input.value = formattedValue;
}

    
</script>
<?php require '../complementos/footer_2.php';?>