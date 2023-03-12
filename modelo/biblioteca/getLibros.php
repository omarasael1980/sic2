<?php

require '../config/database.php';

$con = new Database();
$pdo = $con->conectar();

$campo = $_POST["libro"];

$sql = "SELECT idlibros, titulo FROM sisantee_sics.libros   WHERE titulo LIKE ? ORDER BY titulo ASC LIMIT 0, 25";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%']);

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$html .= "<li value=".$row["idlibros"]." name=".$row["idlibros"]." onclick=\"mostrar('" . $row["titulo"]."' )\">" . $row["titulo"] ."</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>

