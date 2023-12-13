<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);
$sql = "SELECT idpersona, nombre, telefono, direccion, correo FROM persona WHERE idpersona=$id LIMIT 1";
$resultado = $conexion->query($sql);
$rowsget = $resultado->num_rows;
$persona = [];
if ($rowsget > 0) {
    $persona = $resultado->fetch_array();
}


echo json_encode($persona, JSON_UNESCAPED_UNICODE);