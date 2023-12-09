<?php
require 'modelo/conexion.php'; 
session_start();
if(empty($_SESSION["id"])){
    header("location:login.php");
}

$idemple=$_SESSION["idempleado"];
$atributo = "persona_idpersona";
$sql = "SELECT $atributo FROM empleado WHERE idempleado='$idemple'";


$idrol=$_SESSION["idrol"];
$atributorol="nombre";
$sqlrol = "SELECT $atributorol FROM rol WHERE idRol='$idrol'";
$resultadorol= mysqli_query($conexion, $sqlrol);
$filarol = mysqli_fetch_assoc($resultadorol);
echo "El rol es: " . $filarol[$atributorol];
// Ejecutar consulta
$resultado = mysqli_query($conexion, $sql);
// Obtener fila de resultados
$fila = mysqli_fetch_assoc($resultado);

// Mostrar el valor del atributo
echo "El codigo es: " . $fila[$atributo];

$idperson=$fila[$atributo];
$atributo2 = "nombre";
$sql2 = "SELECT $atributo2 FROM persona WHERE idpersona='$idperson'";
// Ejecutar consulta
$resultado2 = mysqli_query($conexion, $sql2);

// Obtener fila de resultados
$fila2= mysqli_fetch_assoc($resultado2);

// Mostrar el valor del atributo
echo "El nombre es: " . $fila2[$atributo2];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="controladores/controlador_cerrarsession.php">salir</a>
</body>
</html>
