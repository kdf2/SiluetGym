<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="componentes/Imagenes/iconSG.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="componentes/Css/estiloslogin.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>
    <div class="container">
        <div class="login">
            <div class="content">
               <a href="index.html"><img   src="componentes/Imagenes/home.png" alt=""></a>
            </div>
            <div class="loginform">
                <h1>Bienvenido</h1>
                <form method="post">
                    <div class="tbox">
                        <i class="fa fa-user"></i><input autofocus type="text" placeholder="Usuario" name="usuario">
                    </div>

                    <div class="tbox">
                        <i class="fa fa-lock" id="eye" onclick="mostrar()"></i><input id="Input"class="pass" type="password" placeholder="Contraseña"  name="contrasña">
                    </div>
                    <input class="btn" type="submit" name="btningresar" value="Iniciar sesión">
                <?php
                include 'modelo/conexion.php';
                include 'controladores/controlador_login.php';
                ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    function mostrar(){
        var tipo =document.getElementById("Input");
        if(tipo.type=='password'){
            tipo.type='text';
        }
        else{
            tipo.type='password';
        }
    }
</script>