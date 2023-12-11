<?php
session_start();
require '../modelo/conexion.php';
$nombreu = $conexion->real_escape_string($_POST['usuario']);
$contraseniau = $conexion->real_escape_string($_POST['contrasenia']);
$idempleado = $_SESSION['$idempleado'];
$IDOL= $conexion->real_escape_string($_POST['rol']);
$sqlusuario = "INSERT INTO usuario (usuario, contraseña, empleado_idempleado, Rol_idRol) 
VALUES ('$nombreu','$contraseniau',$idempleado ,$IDOL)";
// Marcar que los datos de la primera tabla han sido ingresados
if ($conexion->query($sqlusuario)) {
    $idusuario = $conexion->insert_id;
    $_SESSION['datos_tabla2_ingresados'] = true;
}
header('Location:usuarios.php');
?>