<?php
session_start();
if(!empty($_POST["btningresar"])){
    if (!empty($_POST["usuario"]) and !empty($_POST["contrasña"])) {
        $usario=$_POST["usuario"];
        $contra=$_POST["contrasña"];
        $sql=$conexion->query(" select * from usuario where usuario='$usario' and contraseña='$contra' ");
        if ($datos=$sql->fetch_object()) {
            
            $_SESSION["id"]=$datos->idusuario;
            $_SESSION["idempleado"]=$datos->empleado_idempleado;
            $_SESSION["idrol"]=$datos->Rol_idRol;
            header("location:dashboard.php");
        } else {
            echo"verifique el usuario y contraseña";
        }
        
    } else {
        echo"campos vacios";
    }
    
}
?>