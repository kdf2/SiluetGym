<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);
$usuario= $conexion->real_escape_string($_POST['usuario']);
$contra= $conexion->real_escape_string($_POST['contrasenia']);
$rol=$conexion->real_escape_string($_POST['rol']);
$sql="UPDATE usuario SET usuario='$usuario', contraseña='$contra',Rol_idRol='$rol' WHERE idusuario=$id";
if($conexion->query($sql)){
}
header('Location:usuarios.php');


?>