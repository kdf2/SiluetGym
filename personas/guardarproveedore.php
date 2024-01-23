<?php
require '../modelo/conexion.php';

$boolean = $conexion->real_escape_string($_POST['boolean']);



if ($boolean == 0) {
    $nombre = $conexion->real_escape_string($_POST['nombreb']);
    $genero = $conexion->real_escape_string($_POST['generob']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $direccion = $conexion->real_escape_string($_POST['direccionb']);
    $correo = $conexion->real_escape_string($_POST['correob']);
    $empresa = $conexion->real_escape_string($_POST['nombree']);
    echo $sql = "INSERT INTO persona (nombre, genero, telefono, direccion, correo) VALUES ('$nombre','$genero',$telefono,'$direccion','$correo')";
    if ($conexion->query($sql)) {
        $id2 = $conexion->insert_id;
    }

    $sql2 = "INSERT INTO proveedor (nombredelaempresa, persona_idpersona) VALUES ('$empresa',$id2)";
    if ($conexion->query($sql2)) {
    } else {
        echo "Error al insertar en la tabla2: " . $conexion->error;
    }
    header('Location:proveedores.php');

} else {
    $id = $conexion->real_escape_string($_POST['idpersona']);
    $empresa = $conexion->real_escape_string($_POST['nombree']);
    echo $sql2 = "INSERT INTO proveedor (nombredelaempresa, persona_idpersona) VALUES ('$empresa',$id)";

    if ($conexion->query($sql2)) {
    } else {
        echo "Error al insertar en la tabla: " . $conexion->error;
    }
    header('Location:proveedores.php');

}



?>