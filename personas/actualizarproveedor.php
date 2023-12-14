<?php
require '../modelo/conexion.php';
$id = $conexion->real_escape_string($_POST['id']);
$sqlproveedor = "SELECT persona_idpersona FROM proveedor WHERE idproveedor = $id";



$resultado = $conexion->query($sqlproveedor);

if (!empty($resultado->num_rows) && $resultado->num_rows > 0) {
    
    // Obtener los datos de la fila
    $fila = $resultado->fetch_assoc();

    // Acceder a los valores por nombre de columna
    $idpesona = $fila["persona_idpersona"];
}


$nombreempresa = $conexion->real_escape_string($_POST['nombree']);
$nombre = $conexion->real_escape_string($_POST['nombre']);
$genero = $conexion->real_escape_string($_POST['genero']);
$telefono = $conexion->real_escape_string($_POST['telefono']);
$direccion = $conexion->real_escape_string($_POST['direccion']);
$correo = $conexion->real_escape_string($_POST['correo']);
echo $sql = "UPDATE proveedor, persona SET proveedor.nombredelaempresa='$nombreempresa',
persona.nombre='$nombre',persona.genero='$genero', persona.telefono=$telefono, persona.direccion='$direccion',persona.correo='$correo' WHERE idproveedor= $id AND idpersona = $idpesona";

if ($conexion->query($sql)) {
}

header('Location:proveedores.php');


?>