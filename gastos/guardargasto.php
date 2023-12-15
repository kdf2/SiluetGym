<?php
require '../modelo/conexion.php';
session_start();
$cantidad = $conexion->real_escape_string($_POST['cantidad']);
$fecha = $conexion->real_escape_string($_POST['fecha']);
$categoria= $conexion->real_escape_string($_POST['categoria']);
$idusuario=$_SESSION["id"];
$idnombrepersona=$_SESSION["nombrepersona"];
//guardar en la tabla persona

$sql = "INSERT INTO gasto (cantidad, fecha, usuario_idusuario, categoria_idcategoria, Nombrepersona) VALUES ($cantidad, DATE('$fecha'), $idusuario, $categoria,'$idnombrepersona')";
if ($conexion->query($sql)) {
    $idpersona = $conexion->insert_id;
}

header('Location:gasto.php');

?>