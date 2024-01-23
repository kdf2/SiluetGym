<?php
require '../modelo/conexion.php';

$boolean = $conexion->real_escape_string($_POST['boolean']);




if ($boolean == 0) {
    $nombre = $conexion->real_escape_string($_POST['nombreb']);
    $edad = $conexion->real_escape_string($_POST['edadb']);
    $peso = $conexion->real_escape_string($_POST['pesob']);
    $altura = $conexion->real_escape_string($_POST['alturab']);
    $genero = $conexion->real_escape_string($_POST['generob']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $direccion = $conexion->real_escape_string($_POST['direccionb']);
    $correo = $conexion->real_escape_string($_POST['correob']);
    $fecha = $conexion->real_escape_string($_POST['fechab']);
    $membresia = $conexion->real_escape_string($_POST['membresia']);
    $estado = 1;

    echo $sql = "INSERT INTO persona (nombre, genero, telefono, direccion, correo) VALUES ('$nombre','$genero',$telefono,'$direccion','$correo')";
    if ($conexion->query($sql)) {
        $idpersona = $conexion->insert_id;
    }


    $sql = "INSERT INTO miembro (edad, peso, altura, persona_idpersona, membresia_idmembresia, fechaincio, fechapago, estado) VALUES ($edad, $peso ,$altura, $idpersona, $membresia, DATE('$fecha'),DATE('$fecha'),$estado )";
    if ($conexion->query($sql)) {
        $idmiembro = $conexion->insert_id;
    }
    header('Location:miembros.php');
} else {
    $idpersona = $conexion->real_escape_string($_POST['idpersona']);
    $edad = $conexion->real_escape_string($_POST['edadb']);
    $peso = $conexion->real_escape_string($_POST['pesob']);
    $altura = $conexion->real_escape_string($_POST['alturab']);
    $fecha = $conexion->real_escape_string($_POST['fechab']);
    $membresia = $conexion->real_escape_string($_POST['membresia']);
    $estado = 1;
    $sql = "INSERT INTO miembro (edad, peso, altura, persona_idpersona, membresia_idmembresia, fechaincio, fechapago, estado) VALUES ($edad, $peso ,$altura, $idpersona, $membresia, DATE('$fecha'),DATE('$fecha'),$estado )";
    if ($conexion->query($sql)) {
        $idmiembro = $conexion->insert_id;
    }
    header('Location:miembros.php');
}

//guardar en la tabla persona
//AGREGAR EL ID Y SI ES MAYOR AGRERGAR SOLO CON EL ID Y SI NO REGISTRAR TODO LO NORMAL
//AGREGAR EL BOTON DE AGREGAR UNA COMPRA 

?>