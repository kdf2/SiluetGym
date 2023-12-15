<?php
require '../modelo/conexion.php';
$id = $conexion->real_escape_string($_POST['id']);
$cantidad = $conexion->real_escape_string($_POST['cantidad']);
$fecha = $conexion->real_escape_string($_POST['fecha']);
$categoria= $conexion->real_escape_string($_POST['categoria']);
$sql = "UPDATE gasto SET  cantidad=$cantidad, fecha=DATE('$fecha'), categoria_idcategoria=$categoria WHERE idgasto= $id";


if ($conexion->query($sql)) {
}

header('Location:gasto.php');

?>