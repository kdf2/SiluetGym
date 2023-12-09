<?php
require '../modelo/conexion.php';

$nombre= $conexion->real_escape_string($_POST['nombre']);
$sql="INSERT INTO categoriaproduct (nombre) VALUES ('$nombre')";
if($conexion->query($sql)){
    $id=$conexion->insert_id;
}
header('Location:categorias.php');


?>