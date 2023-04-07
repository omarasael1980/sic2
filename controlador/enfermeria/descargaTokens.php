<?php
require_once '../../modelo/config/comunes.php';
$registros = buscaTokens();

// Establecer las cabeceras de respuesta para indicar que se descargará un archivo CSV
 header('Content-Type: text/csv; charset=utf-8');
 header('Content-Disposition: attachment; filename=estudiantes.csv');


// // // Escribir los registros de la tabla directamente en la salida del navegador
 $output = fopen('php://output', 'w');

// // Escribir el encabezado de la tabla en la salida del navegador

$encabezado = ['nombre','Apellido Paterno','Apellido Materno','Usuario','token','grupo'];


fputcsv($output, $encabezado);

// //Escribir los registros de la tabla en la salida del navegador
for($i=0; $i<sizeof($registros); $i++){
    $arreglo =[ "'".$registros[$i]->nombre."'","'".$registros[$i]->apaterno."'","'".$registros[$i]->amaterno."'", "'".
    $registros[$i]->user."'", "'".$registros[$i]->token."'", "'".$registros[$i]->grupo."'"];
  
   fputcsv($output, $arreglo);

}


// Cerrar la salida del navegador
fclose($output);



?>




