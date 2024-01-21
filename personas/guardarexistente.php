<?php
require '../modelo/conexion.php';
$idpersona = $conexion->real_escape_string($_POST['idpersona']);
$edad = $conexion->real_escape_string($_POST['edad']);
$peso = $conexion->real_escape_string($_POST['peso']);
$altura = $conexion->real_escape_string($_POST['altura']);
$fecha = $conexion->real_escape_string($_POST['fecha']);
$membresia = $conexion->real_escape_string($_POST['membresia']);
$estado=1;

$sql = "INSERT INTO miembro (edad, peso, altura, persona_idpersona, membresia_idmembresia, fechaincio, fechapago, estado) VALUES ($edad, $peso ,$altura, $idpersona, $membresia, DATE('$fecha'),DATE('$fecha'),$estado )";
if ($conexion->query($sql)) {
    $idmiembro = $conexion->insert_id;
}
header('Location:miembros.php');
?>