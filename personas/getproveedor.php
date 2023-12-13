<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);

$sql=" SELECT  persona.nombre, persona.genero, persona.telefono, persona.direccion, persona.correo,
                proveedor.nombredelaempresa, proveedor.idproveedor
                FROM proveedor
                INNER JOIN persona ON proveedor.persona_idpersona=persona.idpersona
                WHERE idproveedor=$id LIMIT 1";
$resultado = $conexion->query($sql);


$rowsget = $resultado->num_rows;
$proveedor= [];
if ($rowsget > 0) {
    $proveedor = $resultado->fetch_array();
}


echo json_encode($proveedor, JSON_UNESCAPED_UNICODE);