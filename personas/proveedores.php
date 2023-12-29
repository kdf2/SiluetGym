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

$innerjoineproveedor = "SELECT p.idpersona, p.nombre, p.telefono, p.direccion, p.correo,
                            pro.idproveedor,pro.nombredelaempresa
                    FROM proveedor pro
                    INNER JOIN persona p ON pro.persona_idpersona= p.idpersona";

$proveedoresinner = $conexion->query($innerjoineproveedor);


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
    <link rel="stylesheet" href="<../../assets/template/datatables.net-bs/css/responsive.dataTables.min.css">

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
                    <h1 class="d-flex justify-content-center">Proveedores</h1>
                    <?php
                    if ($filarol[$atributorol] == "Administrativo") { ?>
                        <div class="col align-self-start">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i
                                    class="fa-solid fa-circle-plus"></i> Agregar
                                proveedor</a>
                        </div>

                    <?php } ?>
                    <br>
                    <br>
                    <table id="example" class="table table-striped table-bordered display responsive nowrap"
                        style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>nombre de la empresa</th>
                                <th>nombre</th>
                                <th>telefono</th>
                                <th>direccion</th>
                                <th>correo</th>

                                <?php
                                if ($filarol[$atributorol] == "Administrativo") { ?>
                                    <th>Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_provedores = $proveedoresinner->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?= $row_provedores['nombredelaempresa']; ?>
                                    </td>


                                    <td>
                                        <?= $row_provedores['nombre']; ?>
                                    </td>

                                    <td>
                                        <?= $row_provedores['telefono']; ?>
                                    </td>

                                    <td>
                                        <?= $row_provedores['direccion']; ?>
                                    </td>

                                    <td>
                                        <?= $row_provedores['correo']; ?>
                                    </td>

                                    <?php
                                    if ($filarol[$atributorol] == "Administrativo") { ?>
                                        <td>

                                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#actualizarModal"
                                                data-bs-id="<?= $row_provedores['idproveedor']; ?>">
                                                Editar</a>

                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#eliminaModal"
                                                data-bs-id="<?= $row_provedores['idproveedor']; ?>" data-bs-toggle="modal"
                                                class="fa-solid fa-trash"></i></i> Eliminar</a>

                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="<../../assets/template/datatables.net/js/dataTables.responsive.min.js"></script>


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

    <script>
        var table = new DataTable('#example', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    </script>
    <?php include 'proveedoresModal.php' ?>
    <script>
        let nuevoModal = document.getElementById('nuevoModal')
        nuevoModal.addEventListener('shown.bs.modal', event => {
            let inputNombre = nuevoModal.querySelector('.modal-body #nombree').focus()
        })

        let editarModal = document.getElementById('actualizarModal')
        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let inputID = editarModal.querySelector('.modal-body #id')
            let inputNombreempresa = editarModal.querySelector('.modal-body #nombree')
            let inputNombre = editarModal.querySelector('.modal-body #nombre')
            let inputgenero = editarModal.querySelector('.modal-body #genero')
            let inputtelefono = editarModal.querySelector('.modal-body #telefono')
            let inputdireccion = editarModal.querySelector('.modal-body #direccion')
            let inputcorreo = editarModal.querySelector('.modal-body #correo')


            let url = "getproveedor.php"
            let formData = new FormData()
            formData.append('id', id)
            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {
                    inputID.value = data.idproveedor
                    inputNombreempresa.value = data.nombredelaempresa
                    inputNombre.value = data.nombre
                    inputgenero.value = data.genero
                    inputtelefono.value = data.telefono
                    inputdireccion.value = data.direccion
                    inputcorreo.value = data.correo
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