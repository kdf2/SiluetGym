<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);
$nombre= $conexion->real_escape_string($_POST['nombre']);
$precio= $conexion->real_escape_string($_POST['precio']);
  $sql="UPDATE membresia SET nombre='$nombre', precio=$precio WHERE idmembresia=$id";
if($conexion->query($sql)){
}


header('Location:membresias.php');


?>