<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);



$sql = "SELECT idusuario, usuario, contraseña, Rol_idRol FROM usuario WHERE idusuario=$id LIMIT 1";
$resultado = $conexion->query($sql);
$rowsget = $resultado->num_rows;
$usuario = [];
if ($rowsget > 0) {
    $usuario = $resultado->fetch_array();
}

echo json_encode($usuario, JSON_UNESCAPED_UNICODE);
