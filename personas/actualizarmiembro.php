<?php
require '../modelo/conexion.php';
$idpr = $conexion->real_escape_string($_POST['id']);
$sqlidpersona = "SELECT persona_idpersona FROM miembro WHERE idmiembro = $idpr";
$resultadopersona = $conexion->query($sqlidpersona);
if (!empty($resultadopersona->num_rows) && $resultadopersona->num_rows > 0) {

    // Obtener los datos de la fila
    $fila = $resultadopersona->fetch_assoc();

    // Acceder a los valores por nombre de columna
     $idpesona = $fila["persona_idpersona"];
}

$nombre = $conexion->real_escape_string($_POST['nombre']);
$edad = $conexion->real_escape_string($_POST['edad']);
$peso = $conexion->real_escape_string($_POST['peso']);
$altura = $conexion->real_escape_string($_POST['altura']);
$telefono = $conexion->real_escape_string($_POST['telefono']);
$direccion = $conexion->real_escape_string($_POST['direccion']);
$correo = $conexion->real_escape_string($_POST['correo']);
$fecha = $conexion->real_escape_string($_POST['fecha']);
$membresia = $conexion->real_escape_string($_POST['membresia']);
$estado=1;

echo $sql = "UPDATE miembro, persona SET miembro.edad=$edad, miembro.peso=$peso, miembro.altura=$altura, miembro.membresia_idmembresia=$membresia, miembro.fechaincio=DATE('$fecha'), miembro.fechapago=DATE('$fecha'),miembro.estado=$estado,
persona.nombre='$nombre', persona.telefono=$telefono, persona.direccion='$direccion',persona.correo='$correo' WHERE idmiembro= $idpr AND idpersona = $idpesona";


if ($conexion->query($sql)) {
}

header('Location:miembros.php');

?>