<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);

$sql = "SELECT idcategoria, nombre, descripcion FROM categoria WHERE idcategoria=$id LIMIT 1";
$resultado = $conexion->query($sql);
$rowsget = $resultado->num_rows;
$categoria = [];
if ($rowsget > 0) {
    $categoria = $resultado->fetch_array();
}

echo json_encode($categoria, JSON_UNESCAPED_UNICODE);
