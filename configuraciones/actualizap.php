<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);
$nombre= $conexion->real_escape_string($_POST['nombre']);
echo $sql="UPDATE categoriaproduct SET nombre='$nombre' WHERE idcategoriaproduct=$id";

if($conexion->query($sql)){
}
header('Location:categorias.php');
?>