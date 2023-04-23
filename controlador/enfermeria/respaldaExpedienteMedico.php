<?php
// Establecer conexión con la base de datos
$host = 'localhost';
$dbname = 'sisantee_sics';
$user='sisantee_hemo';
$pass="_pN@&O?xlp5Q";

$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $user, $pass);
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}
// Nombre del archivo de backup
$fecha_hora = date('Y-m-d_H-i-s');
$nombre_archivo = 'backup_' . $fecha_hora . '.sql';
$ruta_archivo = '../../private/sql/respaldos/' . $nombre_archivo;

// Comando de MySQL para realizar el backup
$comando = "mysqldump --opt --user=$user --password=$pass --host=$host $dbname expediente_medico > $ruta_archivo";

// Ejecutar el comando


if(system($comando)==true){
    header('Location:../../vistas/enfermeria/configSubirExpMasivo.php');
    $error=array("tipo"=>'success', "msg"=>'Expediente médico respaldado');
    $_SESSION['msg']=$error;

}else{
    header('Location:../../vistas/enfermeria/configSubirExpMasivo.php');
    $error=array("tipo"=>'error', "msg"=>'Error al reespaldar el expediente médico');
    $_SESSION['msg']=$error;
}

?>
