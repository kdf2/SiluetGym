<?php
require '../modelo/conexion.php';

$nombre= $conexion->real_escape_string($_POST['nombre']);
$descripcion= $conexion->real_escape_string($_POST['descripcion']);
$sql="INSERT INTO cargo (nombre,descripcion) VALUES ('$nombre','$descripcion')";
if($conexion->query($sql)){
    $id=$conexion->insert_id;
}
header('Location:categorias.php');


?>