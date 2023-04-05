<?php

include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';

$espacios = "        ";
if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
//cargar el caso
$folio =$_GET['id'];
$caso = getSeguroEscolarxFolio($folio);
$u = buscaUsuarioID($caso[0]->usuario_idUsuario);
$casoOriginal = buscaAtencionMedicaporId($caso[0]->enfermeria_idenfermeria);
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
                         <a href="eprincipal.php" class=" btn btn-primary list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-house"></i><?=$espacios?>Principal</p>  </a>
                         <br>   <a href="e_nuevoCaso.php" class=" btn  list-group-item text-center list-group-item-action " aria-current="true">
                         <p> <i class="fa-solid fa-circle-plus"></i> <?=$espacios?>Atención médica</p>  </a>
                         <br>
                       
                     
                        <br> <a href="estadisticas.php" class="list-group-item text-center list-group-item-action"><p><i class="fa-solid fa-chart-simple"></i> <?=$espacios?>Estadísticas</p></a>
                       
                       
          </div>
                
        </div>
        </div> 
          
<!-- termina barra lateral izquierda -->
    
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
          <!--contenedor central -->

<h1 class="text-center">Actualizacion de monto </h1>
<div class="row antecedentes">
    <div class="col-lg-4 col-md-4 col-sm-12"><b> Fecha:</b><?=$espacios.$caso[0]->date?></div>
    <div class="col-lg-4 col-md-4 col-sm-12"><b>Folio de atención médica:</b><?=$espacios.$caso[0]->enfermeria_idenfermeria?></div>
    <div class="col-lg-4 col-md-4 col-sm-12"><b>Folio de seguro escolar:</b><?=$espacios.$caso[0]->idseguro_escolar?></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Causa inicial:</b><?=$espacios.$caso[0]->causa?></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Descripción:</b><?=$espacios.$caso[0]->descripcion?></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Medidas tomadas previo a la atención en hospital:</b><?=$espacios.$caso[0]->medidas?></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Expidió la hoja de seguro escolar:</b><?=$espacios.$u[0]->nombre." ".$u[0]->apaterno." ".$u[0]->amaterno?></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Monto:</b><?php
    $numero = $caso[0]->monto;
    $valor_moneda = '$' . number_format($numero, 2, ',', '.');
    echo $valor_moneda; 
    $espacios."$".$espacios.$numero?></div>
</div>
            <!--contenedor central -->
          <br><br>
       <div class="row">
       <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <form action="../../controlador/enfermeria/actualizarMontoSE.php" method="post">
                <h4 class="text-center"><i class="fa-solid fa-money-bill-1-wave"></i><b>   Ingresa el nuevo Monto</b></h4>
                <input type="hidden" name="folio" value="<?=$folio?>">
                <input type="hidden" name="alumno" value="<?=$casoOriginal[0]->estudiantes_idestudiantes?>">
            <p><b>Monto:</b></p>
            <input  type="text" class="form-control" onmouseleave="return maskMoneda(this)" onkeypress="return filterFloat(event,this);" id="nuevoMonto"name="monto">
            <br><br>
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
                <button type="submit" class="col-lg-3 col-md-3 col-sm-6 col-xs-6 nav-button-cargar">Enviar</button>
                <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
                <a href="expedienteAlumno?id=<?=$casoOriginal[0]->estudiantes_idestudiantes?>" class="col-lg-3 col-md-3 col-sm-6 col-xs-6 nav-button-cargar">Cancelar</a>
                </div>
            </form>
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

 
<script>
//    var nuevoMontoInput = document.querySelector('#nuevoMonto');

// nuevoMontoInput.addEventListener('input', function() {
//     var regex = /^\$?[0-9]+(\.[0-9]{1,2})?$/; // Expresión regular para validar números y un punto decimal opcional con dos dígitos decimales.

//     var valid = regex.test(nuevoMontoInput.value);

//     if (!valid || parseFloat(nuevoMontoInput.value) > 35000 || parseFloat(nuevoMontoInput.value) < 0) {
//         nuevoMontoInput.setCustomValidity('Ingrese un número válido entre $0 y $35,000 MXN con hasta dos dígitos decimales.');
//     } else {
//         nuevoMontoInput.setCustomValidity('');
//     }
// });


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