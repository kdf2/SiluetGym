<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);

$sql = "SELECT idcategoriaproduct, nombre FROM categoriaproduct WHERE idcategoriaproduct=$id LIMIT 1";
$resultado = $conexion->query($sql);
$rowsget = $resultado->num_rows;
$pelicula = [];
if ($rowsget > 0) {
    $pelicula = $resultado->fetch_array();
}

echo json_encode($pelicula, JSON_UNESCAPED_UNICODE);
