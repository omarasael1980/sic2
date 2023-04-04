
<?php
include '../../modelo/usuarios/usuarios.php';
require '../complementos/header_2.php';
require '../complementos/nav_2.php';
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';


if(!isset($_SESSION['user']) || !in_array('Enfermeria',$_SESSION['user']->perm)){
    header("Location:../../");
}
?>



<!-- body  -->

    <script src="../../js/validaSubirEvidencia.js"> </script>
<?php require '../complementos/footer_2.php';?>
