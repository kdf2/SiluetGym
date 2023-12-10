<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);
$nombre= $conexion->real_escape_string($_POST['nombre']);
$descripcion= $conexion->real_escape_string($_POST['descripcion']);
$sql="UPDATE categoria SET nombre='$nombre', descripcion='$descripcion' WHERE idcategoria=$id";
if($conexion->query($sql)){
}
header('Location:categorias.php');


?>