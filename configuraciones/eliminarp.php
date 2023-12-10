<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);
$sql="DELETE FROM categoriaproduct  WHERE idcategoriaproduct=$id";
if($conexion->query($sql)){
}
header('Location:categorias.php');


?>