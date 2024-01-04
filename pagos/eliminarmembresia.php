<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);
$sql="DELETE FROM membresia  WHERE idmembresia=$id";
if($conexion->query($sql)){
}
header('Location:membresias.php');
?>