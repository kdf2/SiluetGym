<?php
require '../modelo/conexion.php';
$nombre=$conexion->realscape_string($_POST['nombre']);
$precio=$conexion->realscape_string($_POST['precio']);
$sql="INSERT INTO membresia (nombre, precio) 
VALUES('$nombre', $precio)";
if($conexion->query($sql)){
    $id=$conexion->insert_id;
}
header('Location:membresias.php')
?>