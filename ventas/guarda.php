<?php
require '../modelo/conexion.php';

$nombre= $conexion->real_escape_string($_POST['nombre']);
$genero= $conexion->real_escape_string($_POST['genero']);
$telefono= $conexion->real_escape_string($_POST['telefono']);
$direccion= $conexion->real_escape_string($_POST['direccion']);
$correo= $conexion->real_escape_string($_POST['correo']);
$sql="INSERT INTO persona (nombre,genero,telefono,direccion,correo) VALUES ('$nombre','$genero',$telefono,'$direccion','$correo')";
if($conexion->query($sql)){
    $id=$conexion->insert_id;
}
header('Location:venta.php');


?>