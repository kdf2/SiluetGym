<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['idpersona']);
$nombreempresa= $conexion->real_escape_string($_POST['nombree']);
$sql2 = "INSERT INTO proveedor (nombredelaempresa, persona_idpersona) VALUES ('$nombreempresa',$id)";
if ($conexion->query($sql2)) {
}
else {
    echo "Error al insertar en la tabla2: " . $conexion->error;
}
header('Location:proveedores.php');


?>