<?php
require '../modelo/conexion.php';
 $id= $conexion->real_escape_string($_POST['id']);

$sql = "SELECT * FROM compra_has_producto WHERE producto_idproducto = $id";
$result = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener la columna deseada
    $row = $result->fetch_assoc();
    $columna_deseada = $row["compra_idcompra"];
}
 $columna_deseada;

$sql="DELETE FROM compra_has_producto  WHERE producto_idproducto=$id";
if($conexion->query($sql)){
}

$sql="DELETE FROM producto  WHERE idproducto=$id";
if($conexion->query($sql)){
}

$sql="DELETE FROM compra  WHERE idcompra=$columna_deseada";
if($conexion->query($sql)){
}

header('Location:stock.php');
?>