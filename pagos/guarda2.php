<?php
require '../modelo/conexion.php';

$nombre= $conexion->real_escape_string($_POST['nombre']);
$precio= $conexion->real_escape_string($_POST['precio']);
$sql="INSERT INTO membresia (nombre,precio) VALUES ('$nombre',$precio)";
if($conexion->query($sql)){
    $id=$conexion->insert_id;
}
header('Location:membresias.php');


?>