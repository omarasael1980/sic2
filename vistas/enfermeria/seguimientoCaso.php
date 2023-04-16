<?php
    require '../../modelo/usuarios/usuarios.php';
    require '../complementos/header_2.php';
    require '../complementos/nav_2.php';
    require_once '../../modelo/enfermeria/comunesEnfermeria.php';
 
 $id = $_GET['id'];
 $casos =buscaAtencionMedicaporId($id);
 $espacios = "        ";
 $hoy = getdate();
$today = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday']."T".$hoy['hours'].':'.$hoy['minutes'];
?>
<?php


if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
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
                 <center><a href="eprincipal.php">
                 <img class="img-menu" src="../../img/icons/enfermeria.webp" alt="enfermeria"></a></center>
        </div>
        <div class="row">
                
                    <h4 class="text-center">Enfermería</h4>
                
        </div>
        <div class="row">
                <h1 class="text-center">Menú</h1>
                <div class="list-group">
                  
                         <!--Menu desplegable-->
                         <a href="eprincipal.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                            <!-- <br>   <a href="e_nuevoCaso.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                      
                        <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a>
                         <br> -->
                       <br> <a class="list-group-item text-center list-group-item-action" href="expedienteAlumno.php?id=<?=$_GET['c'];?>"><p><img class="logos-enfermeria"
                                        src="../../img/icons/history.png" alt=""><?=$espacios?> Expedientes </p></a>
                                        <br>
                        <a class="btn btn-primary list-group-item text-center list-group-item-action" href=""><p><i class="fa-solid fa-arrow-right"></i><?=$espacios?> Seguimiento de caso </p></a>
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->

          <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
        <H1 class="text-center">Actualización de caso</H1>
       
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
               <h5 class="text-control">Nombre:  <?=$espacios.$casos[0]->nombre.' '.$casos[0]->apaterno.' '.$casos[0]->amaterno?></h5> 
        </div>
      
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
               <h5 class="text-center">Grupo:<?=$espacios.$casos[0]->grupo?></h5>
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
               <h6>Categoría: <?=$espacios.$casos[0]->categoriaMedica?></h6>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
               <h6>Motivo:<?=$espacios.$casos[0]->motivo?></h6> 
        </div>
       
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
               <h6>Fecha:<?=$espacios.$casos[0]->fecha?></h6>
        </div>
        
    </div>
    <div class="row">
    <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
               <h6>Descripción:<?=$espacios.$casos[0]->descripcion?></h6>
        </div>
    </div>
    <hr>
    <h4 class="text-center">Agregar Notas del caso</h4>
  
    <div class="row">
    <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 " >
        <form id="formulario"action="../../controlador/enfermeria/seguimientoCaso.php" method="post" class="form-control2" >
            <input type="text" name="id" hidden value="<?=$casos[0]->idenfermeria?>">
            <input type="text" name="al" hidden value = "<?=$_GET['c']?>">
               <!--cajas para validacion de campos-->
               <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__motivo">
                    <div class="form-group-input  ">
                     <label for="motivo" class="form-label col-12"> <b> Título:</b>
                     <input class="form-control" id="motivo" name="motivo"type="text" placeholder="Título" autocomplete="off" >
                          <i class=""><img class="form-validation-state img-input" id="img-motivo"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                  <div class="row">
                <div class="form-message" id="mensaje_error__motivo">
                 <p>Escribe el título, debe contener entre 4-30 caracteres, solo se admiten letras.</p>
                </div>
                </div>   
             </div>
                 <br>
                       <!--cajas para validacion de campos-->
                              
       
            
       <div class="row">
           
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                    <input class="form-control" name="fecha" type="datetime"
                      id="fecha"  name="fecha" value="<?=$today?>" min="2022-09-11" max="<?=$today?>"   autocomplete="off" >
                </div>
       </div>
            <!--cajas para validacion de campos-->
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__desc">
                    <div class="form-group-input  ">
                     <label for="desc" class="form-label form-control2"> <b> Descripción:</b>
                     <textarea class="form-control " name="desc" id="desc" type="text" placeholder="Descripción" autocomplete="off" ></textarea>
                          <i class=""><img class="form-validation-state img-input" id="img-desc"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                     
                <div class="form-message" id="mensaje_error__desc">
                 <p>Escribe la descripción de la actualización, debe contener entre 4-300 caracteres.</p>
                </div>
             </div>
                 <br>
                         <!--cajas para validacion de campos-->
    
        <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><button type="submit" class="nav-button-cargar "><p>Guardar</p></button></div>
        <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="expedienteAlumno.php?id=<?=$_GET['c']?>" class=
        "nav-button-cargar"><p class="text-center">Cancelar</p></a></div>
        </div>
        </form>
    </div>
    </div>
            <!--contenedor central -->
          
       
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

 
<script src="../../js/validaCanalizacionMedica.js"></script>

<?php require '../complementos/footer_2.php';?>