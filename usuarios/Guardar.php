<?php
session_start();
require '../modelo/conexion.php';
// Procesar el formulario para la primera tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_tabla1'])) {
    // ... Lógica para insertar en la primera tabla ...
    $boolean = $conexion->real_escape_string($_POST['boolean']);
    if($boolean==0){
        $nombres = $conexion->real_escape_string($_POST['nombreb']);
        $generos = $conexion->real_escape_string($_POST['generob']);
        $telefonos = $conexion->real_escape_string($_POST['telefono']);
        $direccions = $conexion->real_escape_string($_POST['direccionb']);
        $emails = $conexion->real_escape_string($_POST['emailb']);
        $sqlpersona = "INSERT INTO persona (nombre, genero, telefono, direccion, correo) 
        VALUES ('$nombres','$generos',$telefonos,'$direccions','$emails')";
        // Marcar que los datos de la primera tabla han sido ingresados
    
        if ($conexion->query($sqlpersona)) {
            $idpersona = $conexion->insert_id;
        }
    
        $cargotabla=$conexion->real_escape_string($_POST['cargo']);
        $sqlempleado = "INSERT INTO empleado (persona_idpersona, cargo_idcargo) 
        VALUES ($idpersona,$cargotabla)";
        if ($conexion->query($sqlempleado)) {
            $_SESSION['datos_tabla1_ingresados'] = true;
            $_SESSION['$idempleado'] = $conexion->insert_id;
        }
    }

    else{
        $cargotabla=$conexion->real_escape_string($_POST['cargo']);
        $idpersona=$conexion->real_escape_string($_POST['idpersona']);
        $sqlempleado = "INSERT INTO empleado (persona_idpersona, cargo_idcargo) 
        VALUES ($idpersona,$cargotabla)";
        if ($conexion->query($sqlempleado)) {
            $_SESSION['datos_tabla1_ingresados'] = true;
            $_SESSION['$idempleado'] = $conexion->insert_id;
        }
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