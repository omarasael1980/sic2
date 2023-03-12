<?php
    require '../../modelo/usuarios/usuarios.php';
    require '../complementos/header_2.php';
    require '../complementos/nav_2.php';
    require_once '../../modelo/enfermeria/comunesEnfermeria.php';
 
 $id = $_GET['id'];
 $casos =buscaAtencionMedicaporId($id);

 $hoy = getdate();
$today = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday']."T".$hoy['hours'].':'.$hoy['minutes'];
?>
<?php


if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
?>

<!-- body  -->

    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
          
        <center><H1>Actualización de caso</H1></center>
       
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
               <Label><h4>Nombre:</h4></Label> <input type="text" value="<?=$casos[0]->nombre?>">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
               <Label><h4>Apellido Paterno:</h4></Label> <input type="text" value="<?=$casos[0]->apaterno?>">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
               <Label><h4>Apellido Materno:</h4></Label> <input type="text" value="<?=$casos[0]->amaterno?>">
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
               <Label><h4>Grupo:</h4></Label> <input type="text" value="<?=$casos[0]->grupo?>">
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-1 col-md-0 col-sm-0 col-xs-0"></div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
               <Label><h4>Categoría:</h4></Label> <input type="text" value="<?=$casos[0]->categoriaMedica?>">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
               <Label><h4>Motivo:</h4></Label> <input type="text" value="<?=$casos[0]->motivo?>">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
               <Label><h4>Descripción:</h4></Label> <input type="text" value="<?=$casos[0]->descripcion?>">
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
               <Label><h4>Fecha:</h4></Label> <input type="text" value="<?=$casos[0]->fecha?>">
        </div>
        
    </div>
    <hr>
    <center><h1>Agregar Notas del caso</h1></center>
  
    <div class="row">
    <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 " >
        <form id="formulario"action="../../controlador/enfermeria/seguimientoCaso.php" method="post" class="form-control2" >
            <input type="text" name="id" hidden value="<?=$casos[0]->idenfermeria?>">
            <input type="text" name="al" hidden value = "<?=$_GET['c']?>">
               <!--cajas para validacion de campos-->
               <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="grupo__motivo">
                    <div class="form-group-input  ">
                     <label for="motivo" class="form-label"> <b> Título:</b>
                     <input class="form-control" id="motivo" name="motivo"type="text" placeholder="Título" autocomplete="off" >
                          <i class=""><img class="form-validation-state img-input" id="img-motivo"src="../../img/icons/cross.png" alt="incorrecto"> </i>
                          </label>
                    </div>
                     
                <div class="form-message" id="mensaje_error__motivo">
                 <p>Escribe el título, debe contener entre 4-30 caracteres, solo se admiten letras.</p>
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
                     <label for="desc" class="form-label"> <b> Descripción:</b>
                     <textarea class="form-control" name="desc" id="desc" type="text" placeholder="Descripción" autocomplete="off" ></textarea>
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
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"><button type="submit" class="btn btn-success form-control">Guardar Actualización</button></div>
        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"><a href="expedienteAlumno.php?id=<?=$_GET['c']?>" class=
        "form-control btn btn-danger"><center><h4>Cancelar</h4></center></a></div>
        </div>
        </form>
    </div>
    </div>
    <script src="../../js/validaCanalizacionMedica.js"></script>

<?php require '../complementos/footer_2.php';?>