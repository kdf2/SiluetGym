<?php
require '../modelo/conexion.php';
$campo=$_POST["telefono"];
$sql = "SELECT telefono, nombre FROM persona WHERE telefono LIKE ? OR nombre LIKE ? ORDER BY telefono ASC LIMIT 0, 10";

$query = $conexion->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$html .= "<li onclick=\"mostrar('" . $row["telefono"] . "')\">" . $row["nombre"] . " - " . $row["asentamiento"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);