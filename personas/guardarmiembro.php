<?php
require '../modelo/conexion.php';
$nombre = $conexion->real_escape_string($_POST['nombre']);
$edad = $conexion->real_escape_string($_POST['edad']);
$peso = $conexion->real_escape_string($_POST['peso']);
$altura = $conexion->real_escape_string($_POST['altura']);
$genero = $conexion->real_escape_string($_POST['genero']);
$telefono = $conexion->real_escape_string($_POST['telefono']);
$direccion = $conexion->real_escape_string($_POST['direccion']);
$correo = $conexion->real_escape_string($_POST['correo']);
$fecha = $conexion->real_escape_string($_POST['fecha']);
$membresia = $conexion->real_escape_string($_POST['membresia']);
$estado=1;

//guardar en la tabla persona
$sql = "INSERT INTO persona (nombre, genero, telefono, direccion, correo) VALUES ('$nombre','$genero',$telefono,'$direccion','$correo')";
if ($conexion->query($sql)) {
    $idpersona = $conexion->insert_id;
}


$sql = "INSERT INTO miembro (edad, peso, altura, persona_idpersona, membresia_idmembresia, fechaincio, fechapago, estado) VALUES ($edad, $peso ,$altura, $idpersona, $membresia, DATE('$fecha'),DATE('$fecha'),$estado )";
if ($conexion->query($sql)) {
    $idmiembro = $conexion->insert_id;
}
header('Location:miembros.php');
?>