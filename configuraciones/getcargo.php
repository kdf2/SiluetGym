<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);

$sql = "SELECT idcargo, nombre, descripcion FROM cargo WHERE idcargo=$id LIMIT 1";
$resultado = $conexion->query($sql);
$rowsget = $resultado->num_rows;
$cargo = [];
if ($rowsget > 0) {
    $cargo = $resultado->fetch_array();
}

echo json_encode($cargo, JSON_UNESCAPED_UNICODE);
