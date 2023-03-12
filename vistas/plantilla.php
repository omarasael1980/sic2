<?php require 'complementos/header.php';?>
<?php require 'complementos/nav.php';?>
<!-- body  -->

    <div class="row">
        
       
    </div>


<?php require 'complementos/footer.php';?>




<div class="row" ><!--inicio del row de fecha y via de comunicacion-->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <!--inicio fecha de registro-->
                  <!--input fecha-->
                <div class="form-group" id="grupo__fecha">
                <div class="form-group-input form-control ">
                        <label for="fecha" class="form-label"> <b> Fecha de registro:</b>
                            <input class=" text-rigth" name="fecha"  id="fecha"value="<?=$today?>" min="2022-09-11" max="<?=$today?>" type="date">
                                <i class=""><img class="form-validation-state img-input" id="img-fecha"src="../../img/icons/cross.png" alt="incorrecto"></i>
                        </label>   
                                <div class="form-message " id="mensaje_error__fecha">
                                    <p class="">Selecciona una fecha en el rango del inicio de clases a la fecha actual</p>
                                </div>
                               
                    </div>
                   
                </div>
                
                </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <!--inicio de tipo de comunicacion-->
                <div class="form-group " id="grupo__motivo">
                        <div class=" form-group-input form-control">
                            <label for="motivo" class="form-label form-control2"> <b> Medio de comunicación:</b>
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <select title="Motivo" class="form-control2" name="motivo" id="motivo"> 
                                            <option class=""value="0" >Selecciona un medio de comunicación</option>
                                                 <?php foreach($motivos as $e):?>
                                             <option value="<?=$e->idmotivo_prefectura?>"><?=$e->motivo?></option>
                                                <?php endforeach?>
                                        </select>    
                                </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <a title =" Agregar Motivo" data-bs-toggle="modal" data-bs-target="#registroMotivo" data-bs-whatever="@mdo" class="btn btn-primary align-items-center " ><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="form-message" id="mensaje_error__motivo">
                                            <p >Elige un medio de comunicación</p>
                                            <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                            </label>
                        </div>
                        </div>
                        
            </div>
      
        </div> <!--final del row de fecha y via de comunicacion-->


         <!--input fechaInicial-->
         <div class="row"> <!-- inicio de row para las dos fechas -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!-- fecha inicial -->
                        <div class="form-group "  id="grupo__fechaInicial">
                                <div class="form-group-input  form-control">
                                      <label for="fechaInicial" class="form-label"> <b> Fecha Inicial de registro:</b>
                                     <input class="text-rigth" name="fechaInicial"  id="fechaInicial"value="<?=$today?>" min="2022-09-11" max="<?=$today?>" type="date">  
                                     <i class=""><img class="form-validation-state img-input" id="img-fechaInicial"src="../../img/icons/cross.png" alt="incorrecto"></i>
                                  </label>   
                        <div class="form-message " id="mensaje_error__fechaInicial">
                            <p class="">Selecciona una fecha en el rango del inicio de clases a la fecha actual</p>
                        </div>
                    </div>
             </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!-- fecha final -->
                           <!--input fechaFinal-->
                    <div class="form-group" id="grupo__fechaFinal">
                    <div class="form-group-input  form-control">
                            <label for="fechaFinal" class="form-label"> <b> fecha Final de registro:</b>
                                <input class=" text-rigth" name="fechaFinal"  id="fechaFinal"value="<?=$today?>" min="2022-09-11" max="<?=$today?>" type="date">
                                    <i class=""><img class="form-validation-state img-input" id="img-fechaFinal"src="../../img/icons/cross.png" alt="incorrecto"></i>
                            </label>   
                                    <div class="form-message " id="mensaje_error__fechaFinal">
                                        <p class="">Selecciona una fecha en el rango del inicio de clases a la fecha actual</p>
                                    </div>
                        </div>
                    </div>
                        <!-- final fecha final -->
                    </div>
       
       
        </div>  <!-- fin de row para las dos fechas -->