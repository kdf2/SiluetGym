<?php
require '../modelo/conexion.php';
$id= $conexion->real_escape_string($_POST['id']);

$sql = "SELECT * FROM compra_has_producto WHERE producto_idproducto = $id";
$result = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener la columna deseada
    $row = $result->fetch_assoc();
    $idcompra = $row["compra_idcompra"];
}
 $nombre=$conexion->real_escape_string($_POST['nombre']);
 $marca=$conexion->real_escape_string($_POST['marca']);
 $categoria=$conexion->real_escape_string($_POST['categoria']);
 $proveedor = $conexion->real_escape_string($_POST['proveedor']);
 $cantidad = $conexion->real_escape_string($_POST['cantidad']);
 $preciop = $conexion->real_escape_string($_POST['preciop']);
 $precio = $conexion->real_escape_string($_POST['precio']);
 $fecha = $conexion->real_escape_string($_POST['fecha']);
 $subtotal= $cantidad*$preciop;
 
 echo $sql2 = "UPDATE producto, compra SET producto.nombre='$nombre', producto.cantidad=$cantidad, producto.precio= $precio, producto.categoriaproduct_idcategoriaproduct=$categoria, producto.marca= '$marca',
compra.fecha=DATE('$fecha'), compra.total=$preciop, compra.proveedor_idproveedor= $proveedor WHERE idproducto= $id AND idcompra =  $idcompra";
if ($conexion->query($sql2)) { }

$sql="UPDATE compra_has_producto SET  compra_has_producto.subtotal= $subtotal WHERE producto_idproducto=$id";
?> <?php if ($conexion->query($sql)) {  }

header('Location:stock.php');

?>