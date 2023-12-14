<?php
require '../modelo/conexion.php';
$id = $conexion->real_escape_string($_POST['id']);



 $query = "SELECT * FROM miembro WHERE idmiembro = $id";

$idproveedorusuario = $conexion->query($query);
$filausuario = $idproveedorusuario->fetch_assoc();

$idpersona=$filausuario['persona_idpersona'];

$sql = "DELETE FROM miembro WHERE idmiembro=$id";
if ($conexion->query($sql)) {
}


$sql = "DELETE FROM persona WHERE idpersona = $idpersona";
if ($conexion->query($sql)) {
}

header('Location: miembros.php');

?>