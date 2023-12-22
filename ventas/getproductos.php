<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);

$sql=" SELECT  producto.idproducto, producto.nombre, producto.cantidad, producto.precio, producto.categoriaproduct_idcategoriaproduct, producto.marca,
                compra.idcompra, compra.fecha, compra.total, compra.proveedor_idproveedor,
                compra_has_producto.subtotal, compra_has_producto.compra_idcompra, compra_has_producto.producto_idproducto 
                FROM compra_has_producto
                INNER JOIN producto ON compra_has_producto.producto_idproducto=producto.idproducto
                INNER JOIN compra ON compra_has_producto.compra_idcompra=compra.idcompra
                WHERE producto_idproducto=$id LIMIT 1";
$resultado = $conexion->query($sql);


$rowsget = $resultado->num_rows;
$proveedor= [];
if ($rowsget > 0) {
    $proveedor = $resultado->fetch_array();
}


echo json_encode($proveedor, JSON_UNESCAPED_UNICODE);