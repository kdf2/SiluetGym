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
$_SESSION["nombrepersona"] = $fila2[$atributo2];

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
    <link rel="stylesheet" href="../componentes/Css/loader.css">


</head>


<style>
   
</style>

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
                                <i class="fa-solid fa-hand-holding-dollar"></i> &nbsp;Ventas
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="../ventas/venta.php">Realizar venta</a></li>
                                <li><a class="dropdown-item" href="../ventas/stock.php">Stock</a></li>
                                <?php
                        if ($filarol[$atributorol] == "Administrativo") { ?>
                                <li><a class="dropdown-item" href="../ventas/informe.php">Informe</a></li>
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
                                <li><a class="dropdown-item" href="../personas/miembros.php">Miembros</a></li>
                                <li><a class="dropdown-item" href="../personas/proveedores.php">Proveedores</a></li>
                                <li><a class="dropdown-item" href="../personas/empleados.php">Empleados</a></li>
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
                    <h1 class="d-flex justify-content-center">Informe sobre mensualidades por fechas</h1>
                    <br>
                    <br>
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <form action="DescargarReporte_x_fecha_PDF.php" target="_blank" method="post"
                                    accept-charset="utf-8">
                                    <div class="row">
                                        <div class="col">

                                            <input type="date" name="fecha_ingreso" class="form-control"
                                                placeholder="Fecha de Inicio" required>
                                            <label for="">Fecha inicial</label>
                                        </div>
                                        <div class="col">

                                            <input type="date" name="fechaFin" class="form-control"
                                                placeholder="Fecha Final" required>
                                            <label for="">Fecha final</label>
                                        </div>
                                        <div class="col">
                                            <span class="btn btn-dark mb-2" id="filtro">Filtrar</span>
                                            <button id="pdf" type="submit" class="btn btn-danger mb-2 pdf">Descargar Reporte</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-12 text-center mt-5">
                                <span id="loaderFiltro"> </span>
                            </div>


                            <div class="table-responsive resultadoFiltro">
                                <table id="tableEmpleados" class="table table-striped table-bordered"
                                    style="width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Membresia</th>
                                            <th>Fecha de pago</th>
                                            <th>C. meses</th>
                                            <th>Fecha de vencimiento</th>
                                            <th>total</th>

                                        </tr>
                                    </thead>
                                    <?php
                                    $innerjoinventas = "SELECT  persona.nombre as personanombre, miembro.fechapago, membresia.nombre as nombremembresia, membresia.precio, pago.total, pago.mesesapagar, pago.fechadepago as fpago, pago.fechavencimiento FROM pago
                                    INNER JOIN miembro ON pago.miembro_idmiembro = miembro.idmiembro 
                                    INNER JOIN persona ON miembro.persona_idpersona = persona.idpersona 
                                    INNER JOIN membresia ON miembro.membresia_idmembresia = membresia.idmembresia ORDER BY fpago ASC";
                                    $ventasinner = mysqli_query($conexion, $innerjoinventas);
                                    $i = 1;
                                    while ($row_venta = $ventasinner->fetch_assoc()) { ?>
                                        <tr>
                                            <td>
                                                <?= $row_venta['personanombre']; ?>
                                            </td>

                                            <td>
                                                <?= $row_venta['nombremembresia'].' - Q'.$row_venta['precio']; ?>
                                            </td>

                                            <td>
                                                <?= $row_venta['fpago']; ?>
                                            </td>

                                            <td>
                                                <?= $row_venta['mesesapagar']; ?>
                                            </td>

                                            <td>
                                                <?= $row_venta['fechavencimiento']; ?>
                                            </td>

                                            <td>
                                                <?= $row_venta['total']; ?>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>


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
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="assets/js/material.min.js"></script>


    <script>
        var table = new DataTable('#tableEmpleados', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>

    <script>
        $(function () {
            setTimeout(function () {
                $('body').addClass('loaded');
            }, 1000);


            //FILTRANDO REGISTROS
            $("#filtro").on("click", function (e) {
                e.preventDefault();

                loaderF(true);

                var f_ingreso = $('input[name=fecha_ingreso]').val();
                var f_fin = $('input[name=fechaFin]').val();
                console.log(f_ingreso + '' + f_fin);

                if (f_ingreso != "" && f_fin != "") {
                    $.post("filtro.php", { f_ingreso, f_fin }, function (data) {
                        $("#tableEmpleados").hide();
                        $(".resultadoFiltro").html(data);
                        loaderF(false);
                    });
                } else {
                    $("#loaderFiltro").html('<p style="color:red;  font-weight:bold;">Debe seleccionar ambas fechas</p>');
                }
            });


            function loaderF(statusLoader) {
                console.log(statusLoader);
                if (statusLoader) {
                    $("#loaderFiltro").show();
                    $("#loaderFiltro").html('<img class="img-fluid" src="../componentes/Imagenes/cargando.svg" style="left:50%; right: 50%; width:50px;">');
                } else {
                    $("#loaderFiltro").hide();
                }
            }
        });
    </script>

</body>

</html>