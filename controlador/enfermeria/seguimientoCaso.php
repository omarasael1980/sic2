
<pre>
<?php print_r($_POST);?>
</pre>
<?php
require '../../modelo/enfermeria/comunesEnfermeria.php';
$fechaCompleta = $_POST['fecha'];
$fecha = substr($fechaCompleta, 0,10);
$hora = substr($fechaCompleta, 11);
$date = $fecha." ".$hora.":00";
$motivo = $_POST['motivo'];
$descripcion = $_POST['desc'];
$id = $_POST['id'];
$idal=$_POST['al'];
$resp = insertaSeguimientoMedico($motivo, $descripcion, $date, $id  );
if($resp){
    header('Location:../../vistas/enfermeria/expedienteAlumno.php?id='.$idal);
}else{exit("Hubo un error al guardar la atención médica");}


?>