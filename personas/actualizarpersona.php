<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);
$nombre= $conexion->real_escape_string($_POST['nombre']);
$telefono= $conexion->real_escape_string($_POST['telefono']);
$direccion= $conexion->real_escape_string($_POST['direccion']);
$correo= $conexion->real_escape_string($_POST['correo']);
$cargo=$conexion->real_escape_string($_POST['cargo']);
$updatecargo ="UPDATE empleado SET cargo_idcargo=$cargo WHERE persona_idpersona=$id";
$sql="UPDATE persona  SET nombre='$nombre', telefono=$telefono, direccion='$direccion', correo='$correo' WHERE idpersona=$id";
if($conexion->query($updatecargo)){

}
if($conexion->query($sql)){
}
header('Location:empleados.php');


?>