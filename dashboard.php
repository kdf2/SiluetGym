<?php
require 'modelo/conexion.php';
session_start();
date_default_timezone_set('America/Guatemala');
if (empty($_SESSION["id"])) {
    header("location:login.php");
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

$miembros = mysqli_query($conexion, "SELECT * FROM miembro");
$total['miembros'] = mysqli_num_rows($miembros);

$fecha_actual = date("Y-m-d");
$ventas = "SELECT * FROM venta WHERE Fecha = '$fecha_actual'";
$result = $conexion->query($ventas);
$cantidadeventasdia = 0;
$totaldeventasdia = 0;

if ($result->num_rows > 0) {
    // Recorrer los resultados
    while ($row = $result->fetch_assoc()) {
        $cantidadeventasdia += 1;

        $totaldeventasdia += $row["total"];
    }
}

$totalventadia['diaventa'] = $totaldeventasdia;
$cantidadventadia['diacantidadv'] = $cantidadeventasdia;



$ventas = "SELECT * FROM pago WHERE fechadepago = '$fecha_actual'";
$result = $conexion->query($ventas);
$cantidademensualidad = 0;
$totaldemensualidad = 0;

if ($result->num_rows > 0) {
    // Recorrer los resultados
    while ($row = $result->fetch_assoc()) {
        $cantidademensualidad += 1;

        $totaldemensualidad += $row["total"];
    }
}

$totalmensualidaddia['diam'] = $totaldemensualidad;
$cantidadmensualidadia['diacantidadm'] = $cantidademensualidad;




$ventas = "SELECT * FROM gasto WHERE fecha= '$fecha_actual'";
$result = $conexion->query($ventas);
$cantidadgasto = 0;
$totalgasto = 0;

if ($result->num_rows > 0) {
    // Recorrer los resultados
    while ($row = $result->fetch_assoc()) {
        $cantidadgasto += 1;

        $totalgasto += $row["cantidad"];
    }
}

$totalgastodia['diag'] = $totalgasto;
$cantidadgastodia['diacantidadg'] = $cantidadgasto;


//graficas
$sql = "SELECT nombre, cantidad FROM producto";
$result = $conexion->query($sql);

// Crear arrays para almacenar los datos
$labelsp = [];
$stockActual = [];


// Procesar los resultados de la consulta
while ($row = $result->fetch_assoc()) {
    $labelsp[] = $row['nombre'];
    $stockActual[] = $row['cantidad'];

}

$sql = "SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes, SUM(cantidad) AS total FROM gasto GROUP BY mes";
$result = $conexion->query($sql);

// Crear arrays para almacenar los datos
$labels = [];
$data = [];

// Procesar los resultados de la consulta
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['mes'];
    $data[] = $row['total'];
}


$sql = "SELECT DATE_FORMAT(Fecha, '%Y-%m') AS mes, SUM(total) AS total FROM venta GROUP BY mes";
$result = $conexion->query($sql);

// Crear arrays para almacenar los datos
$labelsv = [];
$datav = [];

// Procesar los resultados de la consulta
while ($row = $result->fetch_assoc()) {
    $labelsv[] = $row['mes'];
    $datav[] = $row['total'];
}



$sql = "SELECT DATE_FORMAT(fechadepago, '%Y-%m') AS mes, SUM(total) AS total FROM pago GROUP BY mes";
$result = $conexion->query($sql);

// Crear arrays para almacenar los datos
$labelsm = [];
$datam = [];

// Procesar los resultados de la consulta
while ($row = $result->fetch_assoc()) {
    $labelsm[] = $row['mes'];
    $datam[] = $row['total'];
}

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
    <link rel="shortcut icon" href="componentes/Imagenes/iconSG.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="componentes/Css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../componentes/Css/loader.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard.php">SiluetGym <i class="fa-solid fa-dumbbell"
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
                    <li><a class="dropdown-item" href="controladores/controlador_cerrarsession.php">Cerrar sesión</a>
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
                        <a class=" nav-link" href="dashboard.php" role="button" id="dropdownMenuLink"
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
                                <li><a class="dropdown-item" href="pagos/pagos.php">Ralizar mensualidad</a></li>
                                <li><a class="dropdown-item" href="pagos/membresias.php">Membresias</a></li>
                                <?php
                                if ($filarol[$atributorol] == "Administrativo") { ?>
                                    <li><a class="dropdown-item" href="pagos/informe.php">Informe</a></li>
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
                                <li><a class="dropdown-item" href="ventas/venta.php">Realizar venta</a></li>
                                <li><a class="dropdown-item" href="ventas/stock.php">Stock</a></li>
                                <?php
                                if ($filarol[$atributorol] == "Administrativo") { ?>
                                    <li><a class="dropdown-item" href="ventas/informe.php">Informe</a></li>
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
                                <li><a class="dropdown-item" href="gastos/gasto.php">Realizar gasto</a></li>
                                <?php
                                if ($filarol[$atributorol] == "Administrativo") { ?>
                                    <li><a class="dropdown-item" href="gastos/informe.php">Informe</a></li>
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
                                <li><a class="dropdown-item" href="personas/miembros.php">Miembros</a></li>
                                <li><a class="dropdown-item" href="personas/proveedores.php">Proveedores</a></li>
                                <li><a class="dropdown-item" href="personas/empleados.php">Empleados</a></li>
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
                                    <li><a class="dropdown-item" href="usuarios/usuarios.php">Usuarios</a></li>
                                    <li><a class="dropdown-item" href="configuraciones/categorias.php">Extras</a></li>
                                </ul>
                            </div>

                        <?php } ?>
            </nav>
        </div>





        <!--empieza el dashboard -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 text-center">Panel de control</h1>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="fa-solid fa-people-line fa-3x"></i>
                                    </div>
                                    <a href="personas/miembros.php" class="card-category text-warning font-weight-bold">
                                        Miembros
                                    </a>
                                    <h3 class="card-title">
                                        <?php echo $total['miembros'] ?>
                                    </h3>
                                </div>
                                <div class="card-footer bg-warning text-white">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                        <i class="fa-solid fa-money-bill-trend-up fa-3x"></i>
                                    </div>
                                    <a href="ventas/informe.php" class="card-category text-secondary font-weight-bold">
                                        Ventas del dia
                                    </a>
                                    <h3 class="card-title">
                                        <?php echo $cantidadventadia['diacantidadv'] . ' = Q' . $totalventadia['diaventa'] ?>
                                    </h3>
                                </div>
                                <div class="card-footer bg-secondary text-white">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-danger card-header-icon">
                                    <div class="card-icon">
                                        <i class="fa-solid fa-comment-dollar fa-3x"></i>
                                    </div>
                                    <a href="pagos/informe.php" class="card-category text-primary font-weight-bold">
                                        Mensualidades del dia
                                    </a>
                                    <h3 class="card-title">
                                        <?php echo $cantidadmensualidadia['diacantidadm'] . ' = Q' . $totalmensualidaddia['diam'] ?>
                                    </h3>
                                </div>
                                <div class="card-footer bg-primary">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-info card-header-icon">
                                    <div class="card-icon">
                                        <i class="fa-solid fa-money-check-dollar fa-3x"></i>
                                    </div>

                                    <a href="gastos/informe.php" class="card-category text-danger font-weight-bold">
                                        Gastos del dia
                                    </a>
                                    <h3 class="card-title">
                                        <?php echo $cantidadgastodia['diacantidadg'] . ' = Q' . $totalgastodia['diag'] ?>
                                    </h3>
                                </div>
                                <div class="card-footer bg-danger text-white">
                                </div>
                            </div>
                        </div>

                        <div><br></div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header text-white bg-secondary">
                                    <h3 class="title-2 m-b-40 text-center">Productos con stock mínimo</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="stockChart"></canvas>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header text-white bg-primary">
                                    <h3 class="title-2 m-b-40 text-center">Mensualidades durante el año</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="mensualidad"></canvas>
                                </div>
                            </div>
                        </div>

                        <div><br></div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header text-white bg-danger">
                                    <h3 class="title-2 m-b-40 text-center">Gastos durante el año</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="gastos"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header text-white bg-secondary">
                                    <h3 class="title-2 m-b-40 text-center">Ventas durante el año</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="ventas"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div><br></div>
                    <div>
                        <div class="card">
                            <div class="card-header text-white bg-warning">
                                <h3 class="title-2 m-b-40 text-center">Personas con mensualidad pendiente</h3>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>nombre</th>
                                            <th>telefono</th>
                                            <th>membresia</th>
                                            <th>F.ultimio pago</th>
                                            <th>estado</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $innerjoinmiembros = "SELECT persona.idpersona, persona.nombre, persona.telefono, persona.direccion, persona.correo,
                                            miembro.idmiembro, miembro.edad, miembro.peso, miembro.altura, miembro.persona_idpersona, miembro.membresia_idmembresia, miembro.fechaincio, miembro.fechapago, miembro.estado,
                                            membresia.nombre AS nombre_membresia, membresia.precio
                                            FROM miembro
                                            INNER JOIN persona ON miembro.persona_idpersona= persona.idpersona
                                            INNER JOIN membresia ON miembro.membresia_idmembresia=membresia.idmembresia";

                                        $miembrosinner = $conexion->query($innerjoinmiembros);

                                        while ($row_miembro = $miembrosinner->fetch_assoc()) { ?>
                                            <?php
                                            if ($row_miembro['estado'] == 0) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $row_miembro['nombre']; ?>
                                                    </td>

                                                    <td>
                                                        <?= $row_miembro['telefono']; ?>
                                                    </td>

                                                    <td>
                                                        <?= $row_miembro['nombre_membresia'].' - Q'.$row_miembro['precio']; ?>
                                                    </td>

                                                    <td>
                                                        <?= $row_miembro['fechapago']; ?>
                                                    </td>

                                                    <td>
                                                        <div class="bg-danger text-center text-light">
                                                            INACTIVO
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="componentes/Js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="componentes/Js/demo/chart-area-demo.js"></script>
    <script src="componentes/Js/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="componentes/Js/datatables-simple-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chroma-js/2.1.0/chroma.min.js"></script>


    <script>
        var table = new DataTable('#example', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    <script>
        // Importa la biblioteca Chroma.js
        // Genera una paleta de colores basada en la cantidad de datos
        var colorPalette = chroma.scale(['#00FF00', '#0000FF']).colors(<?php echo json_encode($stockActual); ?>.length);


        // Configuración del gráfico
        var ctx = document.getElementById('stockChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($labelsp); ?>,
                datasets: [
                    {
                        label: 'Stock Actual',
                        data: <?php echo json_encode($stockActual); ?>,
                        backgroundColor: colorPalette,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });



        var ctx2 = document.getElementById('gastos').getContext('2d');
        var myChart = new Chart(ctx2, {
            type: 'bar', // Puedes ajustar el tipo de gráfico según tus necesidades
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [
                    {
                        label: 'Datos por Mes',
                        data: <?php echo json_encode($data); ?>,
                        fill: false, // Puedes cambiar a true si deseas un área rellena debajo de la línea
                        backgroundColor: colorPalette,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: <?php echo json_encode($labels); ?>
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });




        var ctx3 = document.getElementById('ventas').getContext('2d');
        var myChart = new Chart(ctx3, {
            type: 'pie', // Puedes ajustar el tipo de gráfico según tus necesidades
            data: {
                labels: <?php echo json_encode($labelsv); ?>,
                datasets: [
                    {
                        label: 'Datos por Mes',
                        data: <?php echo json_encode($datav); ?>,
                        fill: false, // Puedes cambiar a true si deseas un área rellena debajo de la línea
                        backgroundColor: colorPalette,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: <?php echo json_encode($labelsv); ?>
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });




        var ctx4 = document.getElementById('mensualidad').getContext('2d');
        var myChart = new Chart(ctx4, {
            type: 'bar', // Puedes ajustar el tipo de gráfico según tus necesidades
            data: {
                labels: <?php echo json_encode($labelsm); ?>,
                datasets: [
                    {
                        label: 'Datos por Mes',
                        data: <?php echo json_encode($datam); ?>,
                        fill: false, // Puedes cambiar a true si deseas un área rellena debajo de la línea
                        backgroundColor: colorPalette,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: <?php echo json_encode($labelsm); ?>
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </script>
</body>

</html>