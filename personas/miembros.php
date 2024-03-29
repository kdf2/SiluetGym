<?php

require '../modelo/conexion.php';
session_start();
date_default_timezone_set('America/Guatemala');
if (empty($_SESSION["id"])) {
    header("location:../login.php");
}
$idemple = $_SESSION["idempleado"];
$atributo = "persona_idpersona";
$sql = "SELECT $atributo FROM empleado WHERE idempleado='$idemple'";
// Ejecutar consulta
$resultado = mysqli_query($conexion, $sql);
// Obtener fila de resultados
$fila = mysqli_fetch_assoc($resultado);
// Mostrar el valor del atributo
$idperson = $fila[$atributo];
$atributo2 = "nombre";
$sql2 = "SELECT $atributo2 FROM persona WHERE idpersona='$idperson'";
// Ejecutar consulta
$resultado2 = mysqli_query($conexion, $sql2);
// Obtener fila de resultados
$fila2 = mysqli_fetch_assoc($resultado2);
// Mostrar el valor del atributo
$idrol = $_SESSION["idrol"];
$atributorol = "nombre";
$sqlrol = "SELECT $atributorol FROM rol WHERE idRol='$idrol'";
$resultadorol = mysqli_query($conexion, $sqlrol);
$filarol = mysqli_fetch_assoc($resultadorol);



$sql = "SELECT idmiembro ,fechapago, estado FROM miembro";
$resultado = $conexion->query($sql);
// Verificar si la consulta tuvo éxito
if ($resultado->num_rows > 0) {
    $fechaActual = date("Y-m-d");
    // Iterar a través de las filas de la tabla
    while ($fila = $resultado->fetch_assoc()) {
        $idmiembro = $fila['idmiembro'];
        // Acceder a los valores de cada columna en la fila
        $valorColumna1 = $fila['fechapago'];
        $valorColumna2 = $fila['estado'];
        // Puedes hacer lo que necesites con los valores, por ejemplo, imprimirlos

        if ($fechaActual > $valorColumna1) {
            $sql = "UPDATE miembro SET estado = 0 WHERE idmiembro = $idmiembro  ";
            $final = $conexion->query($sql);
            // echo "la fecha ya expiro. <br>";
            //   echo "Columna1: ".$valorColumna1->format('Y-m-d H:i:s')." estado debe ser -0-: $valorColumna2 <br>";
        } else {
            $sql = "UPDATE miembro SET estado = 1 WHERE idmiembro =$idmiembro ";
            $final = $conexion->query($sql);
            // echo "La fecha de pago aun sigue vigente. <br>";
            // echo "Columna1: ".$valorColumna1->format('Y-m-d H:i:s')." estado debe ser -1- $valorColumna2 <br>";
        }

    }
}



$innerjoinmiembros = "SELECT persona.idpersona, persona.nombre, persona.telefono, persona.direccion, persona.correo,
                             miembro.idmiembro, miembro.edad, miembro.peso, miembro.altura, miembro.persona_idpersona, miembro.membresia_idmembresia, miembro.fechaincio, miembro.fechapago, miembro.estado,
                            membresia.nombre AS nombre_membresia, membresia.precio
                    FROM miembro
                    INNER JOIN persona ON miembro.persona_idpersona= persona.idpersona
                    INNER JOIN membresia ON miembro.membresia_idmembresia=membresia.idmembresia";

$miembrosinner = $conexion->query($innerjoinmiembros);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panel de control</title>
    <link rel="shortcut icon" href="../componentes/Imagenes/iconSG.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../componentes/Css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../dashboard.php">SiluetGym <i class="fa-solid fa-dumbbell"
                style="color: #ffffff;"></i></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <label class="text-white">
                <?php
                echo $fila2[$atributo2] . "-" . $filarol[$atributorol];
                ?>
            </label>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../controladores/controlador_cerrarsession.php">Cerrar sesión</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Panel de control</div>
                        <a class=" nav-link" href="../dashboard.php" role="button" id="dropdownMenuLink"
                            aria-controls="collapseLayouts">
                            <i class="fa-solid fa-chart-line"></i> &nbsp; Panel de control
                        </a>


                        <div class="sb-sidenav-menu-heading">Gestión de pagos</div>
                        <div class="dropdown">
                            <a class=" nav-link collapsed" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fa-solid fa-sack-dollar"></i> &nbsp;Pagos
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="../pagos/pagos.php">Ralizar mensualidad</a></li>
                                <li><a class="dropdown-item" href="../pagos/membresias.php">Membresias</a></li>
                                <?php
                                if ($filarol[$atributorol] == "Administrativo") { ?>
                                    <li><a class="dropdown-item" href="../pagos/informe.php">Informe</a></li>
                                <?php } ?>
                            </ul>
                        </div>


                        <div class="sb-sidenav-menu-heading">Gestión de ventas</div>
                        <div class="dropdown">
                            <a class=" nav-link collapsed" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fa-solid fa-hand-holding-dollar"></i> &nbsp;Inventario
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="../ventas/venta.php">Realizar venta</a></li>
                                <li><a class="dropdown-item" href="../ventas/stock.php">Realizar compra</a></li>
                                <?php
                                if ($filarol[$atributorol] == "Administrativo") { ?>
                                    <li><a class="dropdown-item" href="../ventas/informe.php">Informe ventas</a></li>
                                <?php } ?>
                            </ul>
                        </div>




                        <div class="sb-sidenav-menu-heading">Gestión de gastos</div>
                        <div class="dropdown">
                            <a class=" nav-link collapsed" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fa-solid fa-money-bill-trend-up"></i> &nbsp;Gastos
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="../gastos/gasto.php">Realizar gasto</a></li>
                                <?php if ($filarol[$atributorol] == "Administrativo") { ?>
                                    <li><a class="dropdown-item" href="../gastos/informe.php">Informe</a></li>
                                <?php } ?>

                            </ul>
                        </div>


                        <div class="sb-sidenav-menu-heading">Gestión de personas</div>
                        <div class="dropdown">
                            <a class=" nav-link collapsed" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fa-solid fa-users"></i> &nbsp; Personas
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="miembros.php">Miembros</a></li>
                                <li><a class="dropdown-item" href="proveedores.php">Proveedores</a></li>
                                <li><a class="dropdown-item" href="empleados.php">Empleados</a></li>
                            </ul>
                        </div>

                        <?php
                        if ($filarol[$atributorol] == "Administrativo") { ?>
                            <div class="sb-sidenav-menu-heading">Extra</div>
                            <div class="dropdown">
                                <a class=" nav-link collapsed" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fa-solid fa-gear"></i>&nbsp; Configuraciones
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="../usuarios/usuarios.php">Usuarios</a></li>
                                    <li><a class="dropdown-item" href="../configuraciones/categorias.php">Extras</a></li>
                                </ul>
                            </div>

                        <?php } ?>
            </nav>
        </div>





        <!--empieza el dashboard -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 row justify-content-center">
                    <h1 class="d-flex justify-content-center">Miembros</h1>
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i
                                    class="fa-solid fa-circle-plus"></i> Agregar
                                nuevo miembro</a>
                        </div>

                   <!--
                        <div class="p-2">
                            <a href="#" class="btn  btn-success" data-bs-toggle="modal" data-bs-target="#existente"><i
                                    class="fa-solid fa-circle-plus"></i> Agregar
                                persona existente</a>
                        </div> -->
                    </div>
                    <br>
                    <br>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Peso</th>
                                <th>Altura</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Correo</th>
                                <th>Membresía</th>
                                <th>Fecha inicio</th>
                                <th>F.ultimio pago</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_miembro = $miembrosinner->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?= $row_miembro['nombre']; ?>
                                    </td>


                                    <td>
                                        <?= $row_miembro['edad']; ?>
                                    </td>

                                    <td>
                                        <?= $row_miembro['peso']; ?>
                                    </td>

                                    <td>
                                        <?= $row_miembro['altura']; ?>
                                    </td>

                                    <td>
                                        <?= $row_miembro['telefono']; ?>
                                    </td>

                                    <td>
                                        <?= $row_miembro['direccion']; ?>
                                    </td>

                                    <td>
                                        <?= $row_miembro['correo']; ?>
                                    </td>

                                    <td>
                                        <?= $row_miembro['nombre_membresia'] . "-" . $row_miembro['precio']; ?>
                                    </td>

                                    <td>
                                        <?= $row_miembro['fechaincio']; ?>
                                    </td>

                                    <td>
                                        <?= $row_miembro['fechapago']; ?>
                                    </td>

                                    <td>
                                        <?php if ($row_miembro['estado'] == 1) { ?>
                                            <div class="bg-success text-center text-light">
                                                <a>ACTIVO</a>
                                            </div>

                                        <?php } else { ?>
                                            <div class="bg-danger text-center text-light">
                                                INACTIVO
                                            </div>
                                        <?php }
                                        ?>
                                    </td>

                                    <td>


                                        <div class="row ">
                                            <button class="idbutton btn btn-primary" onclick="miFuncion()"
                                                data-bs-id="<?= $row_miembro['idmiembro']; ?>"> <i
                                                    class="fa-solid fa-money-bill-1-wave"></i> Pagar</button>
                                        </div>

                                        <div class="row">
                                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#actualizarModal"
                                                data-bs-id="<?= $row_miembro['idmiembro']; ?>"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row">
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#eliminaModal"
                                                data-bs-id="<?= $row_miembro['idmiembro']; ?>">
                                                <i class="fa-solid fa-trash"></i> Eliminar</a>
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="../componentes/Js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="../componentes/Js/datatables-simple-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

    <script>

        var table = new DataTable('#example', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    <?php include 'miembroModal.php' ?>
    <?php include 'modalexistente.php' ?>
    <script>



        var botones = document.querySelectorAll(".idbutton"); // Selecciona todos los botones dentro de la tabla

        botones.forEach(function (boton) {
            boton.onclick = function () {
                // Lógica del evento onclick
                var id = this.getAttribute('data-bs-id');
                console.log(id);
                window.location.href = '../pagos/pagos.php?id=' + id;
            };
        });

        //buscar miembro
        $('#telefono').keyup(function (e) {
            e.preventDefault();

            var tpersona = $(this).val();
            var action = 'inforproveedor';

            $.ajax({
                url: 'ajax2.php',
                type: "POST",
                data: { action: action, tpersona: tpersona },
                success: function (response) {
                    console.log(response);
                    if (response == 0) {
                        $('#idpersona').val('0');
                        $('#boolean').val('0');
                        $('#nombreb').val('');
                        $('#direccionb').val('');
                        $('#correob').val('');
                        $('#generob').val('');
                        $('#nombreb').removeAttr('disabled');
                        $('#direccionb').removeAttr('disabled');
                        $('#correob').removeAttr('disabled');
                        $('#generob').removeAttr('disabled');
                    }
                    else {
                        var data = JSON.parse(response);
                        $('#boolean').val('1');
                        $('#idpersona').val(data.idpersona);
                        $('#nombreb').val(data.nombre);
                        $('#direccionb').val(data.direccion);
                        $('#correob').val(data.correo);
                        $('#generob').val(data.genero);
                        $('#nombreb').attr('disabled', 'disabled');
                        $('#direccionb').attr('disabled', 'disabled');
                        $('#correob').attr('disabled', 'disabled');
                        $('#generob').attr('disabled', 'disabled');
                    }


                },
                error: function (error) {

                }

            });
        });



        let nuevoModal = document.getElementById('nuevoModal')
        nuevoModal.addEventListener('shown.bs.modal', event => {
            let inputNombre = nuevoModal.querySelector('.modal-body #telefono').focus()
        })

        let editarModal = document.getElementById('actualizarModal')
        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let inputID = editarModal.querySelector('.modal-body #id')
            let inputNombre = editarModal.querySelector('.modal-body #nombre')
            let inputedad = editarModal.querySelector('.modal-body #edad')
            let inputpeso = editarModal.querySelector('.modal-body #peso')
            let inputaltura = editarModal.querySelector('.modal-body #altura')
            let inputtelefono = editarModal.querySelector('.modal-body #telefono')
            let inputdireccion = editarModal.querySelector('.modal-body #direccion')
            let inputcorreo = editarModal.querySelector('.modal-body #correo')
            let inputfecha = editarModal.querySelector('.modal-body #fecha')
            let inputmembresia = editarModal.querySelector('.modal-body #membresia')
            let url = "getmiembro.php"
            let formData = new FormData()
            formData.append('id', id)
            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {
                    inputID.value = data.idmiembro
                    inputNombre.value = data.nombre
                    inputedad.value = data.edad
                    inputpeso.value = data.peso
                    inputaltura.value = data.altura
                    inputtelefono.value = data.telefono
                    inputdireccion.value = data.direccion
                    inputcorreo.value = data.correo
                    inputfecha.value = data.fechaincio
                    inputmembresia.value = data.membresia_idmembresia
                }).catch(err => console.log(err))

        })

        let eliminaModal = document.getElementById('eliminaModal')
        eliminaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id
        })
    </script>




</body>

</html>