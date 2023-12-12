<?php
require '../modelo/conexion.php';
$id = $conexion->real_escape_string($_POST['id']);
//obtener el valor de la fila mediante el id
$query = "SELECT * FROM usuario WHERE idusuario = $id";
$idempleadousuario = $conexion->query($query);
$filausuario = $idempleadousuario->fetch_assoc();
//guardar la llave empleado de usuario
$idempleado=$filausuario['empleado_idempleado'];
//elimnar registro usuario
$sql = "DELETE FROM usuario WHERE idusuario=$id";
if ($conexion->query($sql)) {
}
//obtener el valor de la fila mediante el id de empleado
$query = "SELECT * FROM empleado WHERE idempleado = $idempleado";
$idpersonaempleado = $conexion->query($query);
$filaempleado = $idpersonaempleado->fetch_assoc();
$idpersona=$filaempleado['persona_idpersona'];
$sql = "DELETE FROM empleado WHERE idempleado = $idempleado";
if ($conexion->query($sql)) {
}

$sql = "DELETE FROM persona WHERE idpersona = $idpersona";
if ($conexion->query($sql)) {
}

header('Location: usuarios.php');
?>