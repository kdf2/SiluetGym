<?php
session_start();
require '../modelo/conexion.php';
// Procesar el formulario para la primera tabla
    // ... Lógica para insertar en la primera tabla ...
    $id = $conexion->real_escape_string($_POST['idpersona']);
    $cargotabla=$conexion->real_escape_string($_POST['categoria']);
    $_SESSION['datos_tabla1_ingresados'] = true;

   echo $sqlempleado = "INSERT INTO empleado (persona_idpersona, cargo_idcargo) 
    VALUES ($id,$cargotabla)";
        $_SESSION['datos_tabla1_ingresados'] = true;
    if ($conexion->query($sqlempleado)) {
        $_SESSION['$idempleado'] = $conexion->insert_id;
    }

header('Location:usuarios.php');

?>