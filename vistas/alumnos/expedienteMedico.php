<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';

$espacios = "        ";
if(!isset($_SESSION['user']) || !in_array('Alumno',$_SESSION['user']->perm)){
    header("Location:../../");
}
$id = $_GET['id'];
$alumno = buscaAlumno($id);
$expediente = buscaExpedienteMedico($id);
$alergias= buscaTodaslasAlergias();
$enfermedades = buscaTodasEnfermedades();
?>

<!-- body  -->
<div class="container-fluid">
    
<div class="row">
    <!--contenedor general -->
     <!--contenedor izquierda -->
     <br>
     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
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
                  
                  <a class="list-group-item text-center list-group-item-action" href="ingresoAlumnos.php"><p>
                      <i class="fa-solid fa-house"></i><?=$espacios?> HOME </p></a>
                <br>  <a class="btn btn-primary  list-group-item text-center list-group-item-action" href="expedienteMedico.php?id=<?=$id?>"><p>
                  <i class="fa-solid fa-book-medical"></i><?=$espacios?> Actualiza expediente médico </p></a>
                     
            </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      <?php if($expediente !=""):?>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
          <!--contenedor central -->
          <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0 "></div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
                <form action="../../controlador/alumno/modificarExpediente.php" method="post">
                    <h1 class="text-center"> <b>  Edita el expediente del alumno</b></h1>
                    <h3 class="text-center"><b><?=$alumno[0]->nombre." ".$alumno[0]->apaterno." ".$alumno[0]->amaterno?></b></h3>
                    <h4 class="text-center"><b><?=$alumno[0]->grupo?></b></h4>
                    <h6 class=""> <b> Si el alumno padece una alergia, márquela en las opciones mostradas. En caso de no encontrar la alergia en el listad, puede agregarla presionando el botón azul</b></h6>
                <input type="hidden" name="folio" id="folio" value="<?=$expediente[0]->idEM?>">
                <input type="hidden" name="idalumno" id="idalumno" value ="<?=$id?>">
                    <div class="row">
                        <!-- incia listado de alergias -->
                      
                        <?php foreach($alergias as $al):?>
                            <?php 
                                if (strpos(" ".$expediente[0]->alergias, $al->alergia) != false) {
                                   $checker = 1;
                                } else {
                                    $checker = 0;
                                }
                                ?>
                            <div class="checkboxEnf col-lg-3 col-md-3 col-sm-6 col-xs-6 m-0 p-0">
                                <div class="row m-0 p-0">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 m-0 p-0"> <p><b> <?=$al->alergia?> </b></p></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 m-0 p-0"><input type="checkbox" <?=$checker?> <?php if($checker == 1){echo 'checked';}?> 
                                    name="<?="al".$al->idAlergias?>" id="<?="al".$al->idAlergias?>" value="<?=$al->alergia?>"></div>
                                </div>
                           </div>
                        <?php endforeach?>
                       
                        <!-- termina listado de alergias -->
                    </div>    
                
                    <div class="row">
                                 <div class="col-4"></div>
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 m-0 p-0">   
                                      <a href="agregaAlergia.php" class="nav-button-cargar"><i class="fa-solid fa-plus"></i>Agregar Alergia</a>
                                </div>
                    </div>
                    <br>
              <!-- enfermedades cronicas -->
              <h6 class=""> <b>  Selecciona que enfermedades crónicas tiene el alumno, en caso necesario puede agregar más presionando el botón correspondiente:</b></h6>
              <div class="row">
                        <!-- incia listado de alergias -->
                        <?php foreach($enfermedades as $en):?>
                            <?php 
                                if (strpos(" ".$expediente[0]->enfermedadesCronicas, $en->enfermedades) != false) {
                                   $checker = 1;
                                } else {
                                    $checker = 0;
                                }
                                ?>
                            <div class="checkboxEnf col-lg-3 col-md-3 col-sm-6 col-xs-6 m-0 p-0">
                                <div class="row m-0 p-0">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 m-0 p-0"> <p><b> <?=$en->enfermedades?> </b></p></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 m-0 p-0"><input type="checkbox"  <?php if($checker == 1){echo 'checked';}?> 
                                    name=<?="enf".$en->idenfermedadesCronicas?> id="<?="enf".$en->idenfermedadesCronicas?>" value="<?=$en->enfermedades?>"></div>
                                </div>
                           </div>
                        <?php endforeach?>
                     
                        <!-- termina listado de alergias -->
                </div>   
                <div class="row">
                                <div class="col-4"></div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 m-0 p-0">         
                                      <a href="agregaEnfermedad.php" class="nav-button-cargar"><i class="fa-solid fa-plus"></i>Agregar Enfermedad</a>
                                </div>
                </div>
                <br>
              <!-- termina enfermedades cronicas -->
            
              <!--div con validacion de motivo-->
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="grupo__medicamento">
                <h6 class=""><b> Si el alumno consume uno o más medicamentos por algún padecimiento crónico por favor escribala en el campo inferior y agréguelo presionando el botón de más:</b></h6>
               <div class="col-8"> <input type="text" autocomplete = "off" id="medicamento" class="form-control"></div>
               <div class="col-2"><a onclick="agregar();" class="nav-button-chico"><i class="fa-solid fa-circle-plus"></i></a></div>
              </div>
              <div class="form-group col-lg-6 col-md-^ col-sm-6 col-xs-12" id="grupo__medicacion">
                    <div class="form-group-input   col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                     <label for="medicacion" class="form-label  col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b> Medicación:</b>
                    <textarea name="medicacion"  id="medicacion" autocomplete="off" rows="10" value = ""class="form-control"><?=$expediente[0]->medicacion?></textarea>
                          <i class=""><img class="form-validation-state img-input" id="img-medicacion"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                     
                <div class="form-message col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mensaje_error__medicacion">
                 <p class="text-center" ><b> Escribe si el estudiante esta bajo algún tratamiento, en caso contrario deja en blanco.</b></p>
                    <br>
                </div>
             </div>
             <!-- termina div -->
            
             <!-- inicia boton de alerta -->
             <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8"></div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-check form-switch">
                                    <input type="hidden" name="folio" id="folio" value="<?=$expediente[0]->idEM?>">
                                    <input class="form-check-input" type="checkbox" <?php
                                    if($expediente[0]->estado == 1){echo "checked";}
                                    ?> onChange="actualizaSeg(<?=$expediente[0]->idEM?>)" id="seguimientoEM<?=$expediente[0]->idEM?>"/>
                                    <label class="form-check-label" for="seguimientoPsico"><b><p>Encender Alerta </b></p></label>
                        </div>
            </div>
            <?php else:?>
                <!-- si no existe expediente se manda para  crear uno nuevo -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
          <!--contenedor central -->
          <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0 "></div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
                <form action="../../controlador/alumno/crearExpediente.php" method="post">
                    <h1 class="text-center"> <b>  Edita el expediente del alumno</b></h1>
                    <h3 class="text-center"><b><?=$alumno[0]->nombre." ".$alumno[0]->apaterno." ".$alumno[0]->amaterno?></b></h3>
                    <h4 class="text-center"><b><?=$alumno[0]->grupo?></b></h4>
                    <h6 class=""> <b> Si el alumno padece una alergia, márquela en las opciones mostradas. En caso de no encontrar la alergia en el listad, puede agregarla presionando el botón azul</b></h6>
                <input type="hidden" name="folio" id="folio" value="">
                <input type="hidden" name="idalumno" id="idalumno" value ="<?=$id?>">
                    <div class="row">
                        <!-- incia listado de alergias -->
                      
                        <?php foreach($alergias as $al):?>
                           
                            <div class="checkboxEnf col-lg-3 col-md-3 col-sm-6 col-xs-6 m-0 p-0">
                                <div class="row m-0 p-0">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 m-0 p-0"> <p><b> <?=$al->alergia?> </b></p></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 m-0 p-0">
                                    <input type="checkbox"  name="<?="al".$al->idAlergias?>" id="<?="al".$al->idAlergias?>" value="<?=$al->alergia?>"></div>
                                </div>
                           </div>
                        <?php endforeach?>
                       
                        <!-- termina listado de alergias -->
                    </div>    
                
                    <div class="row">
                                 <div class="col-4"></div>
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 m-0 p-0">   
                                      <a href="agregaAlergia.php" class="nav-button-cargar"><i class="fa-solid fa-plus"></i>Agregar Alergia</a>
                                </div>
                    </div>
                    <br>
              <!-- enfermedades cronicas -->
              <h6 class=""> <b>  Selecciona que enfermedades crónicas tiene el alumno, en caso necesario puede agregar más presionando el botón correspondiente:</b></h6>
              <div class="row">
                        <!-- incia listado de alergias -->
                        <?php foreach($enfermedades as $en):?>
                           
                            <div class="checkboxEnf col-lg-3 col-md-3 col-sm-6 col-xs-6 m-0 p-0">
                                <div class="row m-0 p-0">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 m-0 p-0"> <p><b> <?=$en->enfermedades?> </b></p></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 m-0 p-0">
                                    <input type="checkbox" name=<?="enf".$en->idenfermedadesCronicas?> id="<?="enf".$en->idenfermedadesCronicas?>" value="<?=$en->enfermedades?>"></div>
                                </div>
                           </div>
                        <?php endforeach?>
                     
                        <!-- termina listado de alergias -->
                </div>   
                <div class="row">
                                <div class="col-4"></div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 m-0 p-0">         
                                      <a href="agregaEnfermedad.php" class="nav-button-cargar"><i class="fa-solid fa-plus"></i>Agregar Enfermedad</a>
                                </div>
                </div>
                <br>
              <!-- termina enfermedades cronicas -->
            
              <!--div con validacion de motivo-->
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="grupo__medicamento">
                <h6 class=""><b> Si el alumno consume uno o más medicamentos por algún padecimiento crónico por favor escribala en el campo inferior y agréguelo presionando el botón de más:</b></h6>
               <div class="col-8"> <input type="text" autocomplete = "off" id="medicamento" class="form-control"></div>
               <div class="col-2"><a onclick="agregar();" class="nav-button-chico"><i class="fa-solid fa-circle-plus"></i></a></div>
              </div>
              <div class="form-group col-lg-6 col-md-^ col-sm-6 col-xs-12" id="grupo__medicacion">
                    <div class="form-group-input   col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                     <label for="medicacion" class="form-label  col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b> Medicación:</b>
                    <textarea name="medicacion"  id="medicacion" autocomplete="off" rows="10" value = ""class="form-control"></textarea>
                          <i class=""><img class="form-validation-state img-input" id="img-medicacion"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                     
                <div class="form-message col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mensaje_error__medicacion">
                 <p class="text-center" ><b> Escribe si el estudiante esta bajo algún tratamiento, en caso contrario deja en blanco.</b></p>
                    <br>
                </div>
             </div>
             <!-- termina div -->
            
             <!-- inicia boton de alerta -->
             <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8"></div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-check form-switch">
                                    
                                    <input class="form-check-input" type="checkbox" name="seguir" id="seguimientoEM"/>
                                    <label class="form-check-label" for="seguimientoPsico"><b><p>Encender Alerta </b></p></label>
                        </div>
            </div>
                <!-- termina creacion de expediente -->
            <?php endif?>
             <!-- termina alerta -->
             <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3"></div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"> <button class="nav-button-cargar" type="submit">Guardar</button></div>


             </div>
            
                </form>
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

 <script src="../../js/activarAlertaExpedienteMedico.js"></script>

<?php require '../complementos/footer_2.php';?>