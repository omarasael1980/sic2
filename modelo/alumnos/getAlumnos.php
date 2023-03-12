<?php

require '../config/database.php';

$con = new Database();
$pdo = $con->conectar();

$campo = $_POST["alumno"];

$sql = "SELECT * FROM estudiantes JOIN grupos on grupos_idgrupos =idgrupos   WHERE nombre LIKE ? OR apaterno LIKE ? OR amaterno LIKE ? OR grupo LIKE ? ORDER BY apaterno ASC LIMIT 0, 25";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%',$campo . '%',$campo . '%']);

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$html .= "<li name=".$row["idestudiantes"]." onclick=\"mostrar('" . $row["nombre"] . "/".$row["apaterno"]."/".$row["amaterno"]."/".$row["grupo"]."  /  " . $row["idestudiantes"] ."' )\">" . $row["nombre"] . " - " . $row["apaterno"] ."  /  " . $row["amaterno"] ."  /  " . $row["grupo"]."</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>
