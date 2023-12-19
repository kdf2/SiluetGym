<?php
require '../modelo/conexion.php';
session_start();
$nombre=$conexion->real_escape_string($_POST['nombre']);
$marca=$conexion->real_escape_string($_POST['marca']);
$categoria=$conexion->real_escape_string($_POST['categoria']);
$proveedor = $conexion->real_escape_string($_POST['proveedor']);
$cantidad = $conexion->real_escape_string($_POST['cantidad']);
$preciop = $conexion->real_escape_string($_POST['preciop']);
$precio = $conexion->real_escape_string($_POST['precio']);
$fecha = $conexion->real_escape_string($_POST['fecha']);

//guardar en la tabla persona

 $sql = "INSERT INTO producto (nombre, cantidad, precio, categoriaproduct_idcategoriaproduct, marca) VALUES ('$nombre', $cantidad, $precio,  $categoria,'$marca')";
if ($conexion->query($sql)) {
    $idproducto = $conexion->insert_id;
}


 $sql ="INSERT INTO  compra (fecha, total,proveedor_idproveedor	) VALUES (DATE('$fecha'), $preciop, $proveedor )";

if ($conexion->query($sql)) {
    $idcompra = $conexion->insert_id;
}

 $sql = "INSERT INTO compra_has_producto ( compra_idcompra, producto_idproducto,cantidad, subtotal ) VALUES ($idcompra, $idproducto, $cantidad, $preciop )";
if ($conexion->query($sql)) {
    $idcompra = $conexion->insert_id;
}

header('Location:stock.php');

?>