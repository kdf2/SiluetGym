<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);
$sql="DELETE FROM gasto  WHERE idgasto=$id";
if($conexion->query($sql)){
}
header('Location:gasto.php');
?>