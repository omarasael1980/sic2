

<?php

define("RECAPTCHA_V3_SECRET_KEY", '6LfXTVocAAAAAG2TKxq3hBDt2nLLwVB7QfZTnqVe');
$token = $_POST['token'];
$action = $_POST['action'];
 

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
$arrResponse = json_decode($response, true);
 
// verificar la respuesta que sea mayor a 0.5
//if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {

	
    require '../../modelo/config/pdo.php';
require '../../modelo/usuarios/usuarios.php';

$resp = logearse($_POST['usuario'], $_POST['password'],$pdo);

abreSesion();
$error = $_SESSION['msg'];

$tipo=$error['tipo'];
$msg = $error['msg'];
header("Location: ../../?tipo=".$tipo."&&msg=".$msg);
//} else {
    
//	echo "Lo siento, por seguridad no procesaremos tu solicitud!";
//}

?> 