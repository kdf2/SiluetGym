<?php
require '../modelo/conexion.php';

$id = $conexion->real_escape_string($_POST['id']);

$sql=" SELECT  persona.nombre, persona.genero, persona.telefono, persona.direccion, persona.correo,
                 miembro.idmiembro, miembro.edad, miembro.peso, miembro.altura, miembro.persona_idpersona, miembro.membresia_idmembresia, miembro.fechaincio, miembro.estado
                FROM miembro
                INNER JOIN persona ON miembro.persona_idpersona=persona.idpersona
                WHERE idmiembro=$id LIMIT 1";
$resultado = $conexion->query($sql);


$rowsget = $resultado->num_rows;
$proveedor= [];
if ($rowsget > 0) {
    $proveedor = $resultado->fetch_array();
}


echo json_encode($proveedor, JSON_UNESCAPED_UNICODE);