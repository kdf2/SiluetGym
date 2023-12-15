<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);

$sql = "SELECT idgasto, cantidad, fecha, categoria_idcategoria FROM gasto WHERE idgasto=$id LIMIT 1";
$resultado = $conexion->query($sql);


$rowsget = $resultado->num_rows;
$proveedor= [];
if ($rowsget > 0) {
    $proveedor = $resultado->fetch_array();
}


echo json_encode($proveedor, JSON_UNESCAPED_UNICODE);