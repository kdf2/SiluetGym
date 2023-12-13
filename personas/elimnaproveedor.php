<?php
require '../modelo/conexion.php';
$id = $conexion->real_escape_string($_POST['id']);
echo $id;

$query = "SELECT * FROM proveedor WHERE idproveedor = $id";
$idproveedorusuario = $conexion->query($query);
$filausuario = $idproveedorusuario->fetch_assoc();

$idpersona=$filausuario['persona_idpersona'];

$sql = "DELETE FROM proveedor WHERE idproveedor=$id";
if ($conexion->query($sql)) {
}


$sql = "DELETE FROM persona WHERE idpersona = $idpersona";
if ($conexion->query($sql)) {
}

header('Location: proveedores.php');

?>