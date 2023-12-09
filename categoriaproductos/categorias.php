<?php
require '../modelo/conexion.php';
session_start();
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

$sqlprudctos = "SELECT * FROM categoriaproduct";
$resultadoprudctos = $conexion->query($sqlprudctos);

$sqlgastos = "SELECT * FROM categoria";
$resultadogastos = $conexion->query($sqlgastos);
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
                                <li><a class="dropdown-item" href="#">Ralizar mensualidad</a></li>
                                <li><a class="dropdown-item" href="membresias/membresias.php">Membresias</a></li>
                                <li><a class="dropdown-item" href="#">Informe</a></li>
                            </ul>
                        </div>


                        <div class="sb-sidenav-menu-heading">Gestión de ventas</div>
                        <div class="dropdown">
                            <a class=" nav-link collapsed" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fa-solid fa-hand-holding-dollar"></i> &nbsp;Ventas
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Realizar venta</a></li>
                                <li><a class="dropdown-item" href="#">Stock</a></li>
                                <li><a class="dropdown-item" href="#">Informe</a></li>
                            </ul>
                        </div>



                        <div class="sb-sidenav-menu-heading">Gestión de gastos</div>
                        <div class="dropdown">
                            <a class=" nav-link collapsed" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fa-solid fa-money-bill-trend-up"></i> &nbsp;Gastos
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Realizar gasto</a></li>
                                <li><a class="dropdown-item" href="#">Informe</a></li>
                                <li><a class="dropdown-item" href="#">Reporte</a></li>
                            </ul>
                        </div>


                        <div class="sb-sidenav-menu-heading">Gestión de personas</div>
                        <div class="dropdown">
                            <a class=" nav-link collapsed" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fa-solid fa-users"></i> &nbsp; Personas
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Miembros</a></li>
                                <li><a class="dropdown-item" href="#">Proveedores</a></li>
                                <li><a class="dropdown-item" href="#">Empleados</a></li>
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
                                    <li><a class="dropdown-item" href="categorias.php">extras</a></li>
                                </ul>
                            </div>

                        <?php } ?>
            </nav>
        </div>





        <!--empieza el dashboard -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="d-flex justify-content-center">Extras</h1>
                    <div class="row ">
                        <div class="col">
                            <h1 class="mt-4">Categoria Productos</h1>
                            <div class="col-sm-4">
                                <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Agregar
                                    categoria de producto</a>
                            </div>
                            <table class="table table-sm table-striped table-hover mt-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#id</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php while ($row = $resultadoprudctos->fetch_assoc()) { ?>
                                        <tr>
                                            <td>
                                                <?= $row['idcategoriaproduct']; ?>
                                            </td>
                                            <td>
                                                <?= $row['nombre']; ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editaModal"
                                                    data-bs-id="<?= $row['idcategoriaproduct']; ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i> Editar</a>

                                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#eliminaModal"
                                                    data-bs-id="<?= $row['idcategoriaproduct']; ?>"><i
                                                        class="fa-solid fa-trash"></i></i> Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <h1 class="mt-4">Tipos de gastos</h1>
                            <div class="col-sm-4">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#nuevoModalgastos"><i class="fa-solid fa-circle-plus"></i> Agregar
                                    tipo de
                                    gasto</a>
                            </div>
                            <table class="table table-sm table-striped table-hover mt-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#id</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row2 = $resultadogastos->fetch_assoc()) { ?>
                                        <tr>
                                            <td>
                                                <?= $row2['idcategoria']; ?>
                                            </td>
                                            <td>
                                                <?= $row2['nombre']; ?>
                                            </td>
                                            <td>
                                                <?= $row2['descripcion']; ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editaModal"
                                                    data-bs-id="<?= $row2['idcategoria']; ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i> Editar</a>

                                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#eliminaModal"
                                                    data-bs-id="<?= $row2['idcategoria']; ?>"><i
                                                        class="fa-solid fa-trash"></i></i> Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h1 class="mt-4">Cargos existentes</h1>
                            <div class="col-sm-4">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#nuevoModalgastos"><i class="fa-solid fa-circle-plus"></i> Agregar
                                    un cargo</a>
                            </div>
                            <table class="table table-sm table-striped table-hover mt-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#id</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row2 = $resultadogastos->fetch_assoc()) { ?>
                                        <tr>
                                            <td>
                                                <?= $row2['idcategoria']; ?>
                                            </td>
                                            <td>
                                                <?= $row2['nombre']; ?>
                                            </td>
                                            <td>
                                                <?= $row2['descripcion']; ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editaModal"
                                                    data-bs-id="<?= $row2['idcategoria']; ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i> Editar</a>

                                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#eliminaModal"
                                                    data-bs-id="<?= $row2['idcategoria']; ?>"><i
                                                        class="fa-solid fa-trash"></i></i> Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>



                        <div class="col">
                            <h1 class="mt-4">Usuarios</h1>
                            <div class="col-sm-4">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#nuevoModalgastos"><i class="fa-solid fa-circle-plus"></i> Agregar usuario</a>
                            </div>
                            <table class="table table-sm table-striped table-hover mt-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#id</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row2 = $resultadogastos->fetch_assoc()) { ?>
                                        <tr>
                                            <td>
                                                <?= $row2['idcategoria']; ?>
                                            </td>
                                            <td>
                                                <?= $row2['nombre']; ?>
                                            </td>
                                            <td>
                                                <?= $row2['descripcion']; ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editaModal"
                                                    data-bs-id="<?= $row2['idcategoria']; ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i> Editar</a>

                                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#eliminaModal"
                                                    data-bs-id="<?= $row2['idcategoria']; ?>"><i
                                                        class="fa-solid fa-trash"></i></i> Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include 'nuevoModal.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="../componentes/Js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../componentes/Js/demo/chart-area-demo.js"></script>
    <script src="../componentes/Js/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../componentes/Js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>