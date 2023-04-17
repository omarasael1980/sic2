<pre>
    <?php
    print_r($_POST);?>
</pre>

<?php
require '../../modelo/config/comunes.php';
$monto = $_POST['monto'];
$monto= str_replace(array("$", ","), "", $monto);

print_r($monto);

 $resp =actualizaMontoSeguroEscolar($monto);
 if($resp){
    header('Location:../../vistas/usuarios/usuariosPrincipal.php?id=3');
}else{
    header('Location:../../vistas/usuarios/usuariosPrincipal.php?error="NoInsertado"');
}

?>