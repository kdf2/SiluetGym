<?php
session_start();
require '../modelo/conexion.php';
// Procesar el formulario para la primera tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_tabla1'])) {
    // ... Lógica para insertar en la primera tabla ...
    $nombres = $conexion->real_escape_string($_POST['nombre']);
    $generos = $conexion->real_escape_string($_POST['genero']);
    $telefonos = $conexion->real_escape_string($_POST['telefono']);
    $direccions = $conexion->real_escape_string($_POST['direccion']);
    $emails = $conexion->real_escape_string($_POST['email']);
    $sqlpersona = "INSERT INTO persona (nombre, genero, telefono, direccion, correo) 
    VALUES ('$nombres','$generos',$telefonos,'$direccions','$emails')";
    // Marcar que los datos de la primera tabla han sido ingresados
    $_SESSION['datos_tabla1_ingresados'] = true;
    if ($conexion->query($sqlpersona)) {
        $idpersona = $conexion->insert_id;
    }

    $cargotabla=$conexion->real_escape_string($_POST['cargo']);
    $sqlempleado = "INSERT INTO empleado (persona_idpersona, cargo_idcargo) 
    VALUES ($idpersona,$cargotabla)";
    if ($conexion->query($sqlempleado)) {
        $_SESSION['$idempleado'] = $conexion->insert_id;
    }

}

// Procesar el formulario para la segunda tabla después de ingresar en la primera tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_tabla2'])) {
    // ... Lógica para insertar en la segunda tabla ...
    $nombreu = $conexion->real_escape_string($_POST['usuario']);
    $contraseniau = $conexion->real_escape_string($_POST['contrasenia']);
    $IDOL= $conexion->real_escape_string($_POST['rol']);

    $sqlusuario = "INSERT INTO usuario (usuario, contraseña, empleado_idempleado, Rol_idRol) 
    VALUES ('$nombreu','$contraseniau',$idempleado,$IDOL)";
    // Marcar que los datos de la primera tabla han sido ingresados
    if ($conexion->query($sqlusuario)) {
        $idusuario = $conexion->insert_id;
        $_SESSION['datos_tabla2_ingresados'] = true;
    }
    // Marcar que los datos de la segunda tabla han sido ingresados
    
 
}
header('Location:usuarios.php');
?>