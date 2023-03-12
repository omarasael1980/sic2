<!-- Modal -->
<!-- seguimiento -->
<div class="modal fade" id="seguimiento<?=$p->idatencion_psico?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="seguimientoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="seguimientoLabel"> Seguimiento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../../controlador/psicopedagogico/agregarSeguimiento.php" class="formulario" id="formulario"  method="post">
            <center>Antecedentes:</center>
            <div class="row">
                <div class="col-lg-12"><input type="text" class="text" id="folio" name="folio" value="<?=$p->idatencion_psico?>" hidden></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">Alumno: <input type="text" value="<?=$alumno?>"disabled></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">Grupo: <input type="text" value="<?=$grupo?>"disabled></div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">Motivo:<input type="text" class="text" id="folio" name="motivo" value="<?=$p->motivo?>" disabled></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">Fecha:<input type="text" value="<?=$p->fecha?>"disabled></div>
                
            </div>
            <div class="row">
                <div class="col-lg-12">Descripción: <input type="text" class="text" id="folio" name="folio" value="<?=$p->descripcion?>" disabled></div>
                
                
            </div>

            <hr>
            <center>Nueva entrada:</center>
            <!--input fecha-->
            <div class="form-group" id="grupo__fecha">
               <div class="form-group-input  ">
                     <label for="fecha" class="form-label"> <b> Fecha:</b>
                        <input class="form-control text-rigth" name="fecha"  id="fecha"value="<?=$today?>" min="2022-09-11" max="<?=$today?>" type="date">
                            <i class=""><img class="form-validation-state img-input" id="img-fecha"src="../../img/icons/cross.png" alt="incorrecto"></i>
                    </label>   
                            <div class="form-message " id="mensaje_error__fecha">
                                <p class="">Selecciona una fecha en el rango del inicio de clases a la fecha actual</p>
                            </div>
                 </div>
            </div>
                         <!--input fecha-->
                          <!--input motivo-->
                          <br>
                        <div class="form-group " id="grupo__motivo">
                            <div class=" form-group-input">
                                <label for="motivo" class="form-label form-control2"> <b> Motivo:</b>
                                <div class="row">
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <select title="Motivo" class="form-control" name="motivo" id="motivo"> 
                                                <option class=""value="0" >Elige un motivo</option>
                                                     <?php foreach($motivos as $e):?>
                                                 <option value="<?=$e->motivoPsico?>"><?=$e->motivoPsico?></option>
                                                    <?php endforeach?>
                                            </select>    
                                    </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <a title =" Agregar Motivo" data-bs-toggle="modal" data-bs-target="#registroMotivo" data-bs-whatever="@mdo" class="btn btn-primary align-items-center " ><i class="fa-solid fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="form-message" id="mensaje_error__motivo">
                                                <p >Debes elegir alguna opción de motivo</p>
                                                <i class=""><img class="form-validation-state img-input" src="../../img/icons/cross.png" alt="incorrecto"> </i>
                            </div>
                                </label>
                            </div>
                            </div>
                            <br>

            <!-- input descripcion -->
            <div class="form-group " id="grupo__descripcion"> 
                 <div class="form-group-input  ">
                    <label for="descripcion" class="form-label form-control2"> <b> Descripción:</b>
                        <textarea name="descripcion" onkeyup="validaxdescripcion(this.value)" id="descripcion" required class="form-control"></textarea>
                            <i class=""><img class="form-validation-state img-input" id="img-usuario"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                    </label>
                    <div class="form-message" id="mensaje_error__descripcion">
                        <p>Debe tener una descripción clara del evento inicial.</p>
                    </div>
            </div>
                    <!-- termina input descripcion -->
                        <br>
                        <button type="submit"  name = "bEnviar" onclick="validarForm(event)" id="bEnviar"class="btn btn-success">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
       
      </div>
    </div>
  </div>
</div>
<!-- Modal -->




<div class="row">
    <!-- Seguimiento inicia -->
    <center>Seguimiento:</center>
   <?php $seguimientos =buscaSeguimientos($p->idatencion_psico);?>
   
   <?php if($seguimientos != null):?>
   <?php foreach($seguimientos as $seg):?>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">Título:</div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><?=$seg->titulo?>:</div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">Fecha:</div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><?=$seg->fecha?></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Descripción:</div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><?=$seg->descipcion?>:</div>
      <div class="col"></div>
    </div>
    <?php endforeach?>
<?php endif?>
     <!-- FIN Seguimiento inicia -->
  </div>