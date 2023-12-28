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

//mostrar cargos
$sqlcargos = "SELECT idcargo, nombre,descripcion FROM cargo";
$cargos = $conexion->query($sqlcargos);

$sqlrol = "SELECT idRol, nombre FROM rol";
$roles = $conexion->query($sqlrol);

//mostrar usuario con persona inner join
$innerjoinusuarios = "SELECT usu.idusuario, usu.usuario, usu.contraseña,
                            person.nombre,
                            r.nombre AS nombre_rol
                    FROM usuario usu 
                    INNER JOIN empleado emple ON usu.empleado_idempleado= emple.idempleado
                    INNER JOIN persona person ON emple.persona_idpersona=person.idpersona
                    INNER JOIN rol r ON usu.Rol_idRol=r.idRol";

$usuariosiner = $conexion->query($innerjoinusuarios);


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
                                    <li><a class="dropdown-item" href="usuarios.php">Usuarios</a></li>
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
                    <h1 class="d-flex justify-content-center">Usuarios</h1>
                    <form action="Guardar.php" method="post" id="formulariopersona" onsubmit="return validar()">
                        <div class="row">
                            <div class="col">
                                <label for="nombre">Nombre:</label>
                                <input autofocus type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ingresa tu nombre">
                            </div>
                            <div class="col">
                                <label for="genero">Genero:</label>
                                <input type="text" class="form-control" id="genero" name="genero"
                                    placeholder="Ingresa el genero">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="telefono">Telefono:</label>
                                <input type="number" class="form-control" id="telefono" name="telefono"
                                    placeholder="Ingresa No. telefono">
                            </div>
                            <div class="col">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    placeholder="Ingresa direccion">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="email">correo:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Ingresa correo electrónico">
                            </div>
                            <div class="col">
                                <label for="cargo">Cargo:</label>
                                <select name="cargo" id="cargo" class="form-select">
                                    <option value="">selecion..</option>
                                    <?php while ($row_Cargos = $cargos->fetch_assoc()) { ?>
                                        <option value="<?php echo $row_Cargos["idcargo"] ?>">
                                            <?= $row_Cargos["nombre"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" name="submit_tabla1"><i
                                class="fa-solid fa-floppy-disk"></i>&nbsp;Agregar nuevo
                            usuario</button>

                    </form>

                    <!--modal-->
                    <div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog"
                        aria-labelledby="nuevoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="nuevoModalLabel">Agregar Usuario</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="guardarusuario.php" method="post">
                                        <div class="mb-3">
                                            <label for="usuario" class="form-label">Usuario:</label>
                                            <input autofocus type="text" name="usuario" id="usuario"
                                                class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="contrasenia" class="form-label">Contraseña:</label>
                                            <input type="text" name="contrasenia" id="contrasenia" class="form-control"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="rol">Rol:</label>
                                            <select name="rol" id="rol" class="form-select">
                                                <option value="">selecion..</option>
                                                <?php while ($row_roles = $roles->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row_roles["idRol"] ?>">
                                                        <?= $row_roles["nombre"] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="">
                                            <button type="submit" class="btn btn-primary" name="submit_tabla2"><i
                                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--tabla-->
                    <table class="table table-sm table-striped table-hover mt-4">
                        <thead class="table-dark">
                            <tr>
                                <th>#id</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_usuarios = $usuariosiner->fetch_assoc()) { ?>

                                <tr>
                                    <td>
                                        <?= $row_usuarios['idusuario']; ?>
                                    </td>


                                    <td>
                                        <?= $row_usuarios['nombre']; ?>
                                    </td>

                                    <td>
                                        <?= $row_usuarios['usuario']; ?>
                                    </td>

                                    <td>
                                        <?= $row_usuarios['contraseña']; ?>
                                    </td>

                                    <td>
                                        <?= $row_usuarios['nombre_rol']; ?>
                                    </td>

                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editarModal" data-bs-id="<?= $row_usuarios['idusuario']; ?>"><i
                                                class="fa-solid fa-pen-to-square"></i> Editar</a>

                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#eliminaModal"
                                            data-bs-id="<?= $row_usuarios['idusuario']; ?>"><i
                                                class="fa-solid fa-trash"></i></i> Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>

                </div>
            </main>
        </div>
    </div>
    <?php include 'editarModalusuario.php'; ?>
    <?php include 'eliminarModal.php'; ?>


    <script>
        function validar() {
            //obteniendo el valor que se puso en el campo text del formulario
            var miCampoTexto = document.getElementById("nombre").value;
            //la condición
            if (miCampoTexto.length == 0 || /^\s+$/.test(miCampoTexto)) {
                $('#eliminaModal2').modal('show'); // abrir
                return false;
            }
        }

        //actualiza usuario
        let nuevoModal = document.getElementById('nuevoModal')
        nuevoModal.addEventListener('shown.bs.modal', event => {
            let inputNombre = nuevoModal.querySelector('.modal-body #usuario').focus()
        })

        let editarModal = document.getElementById('editarModal')
        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let inputID = editarModal.querySelector('.modal-body #id')
            let inputusuario = editarModal.querySelector('.modal-body #usuario')
            let inputcontra = editarModal.querySelector('.modal-body #contrasenia')
            let inputrol = editarModal.querySelector('.modal-body #rol')
            let url = "getusuario.php"
            let formData = new FormData()
            formData.append('id', id)
            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {
                    inputID.value = data.idusuario
                    inputusuario.value = data.usuario
                    inputcontra.value = data.contraseña
                    inputrol.value = data.Rol_idRol
                }).catch(err => console.log(err))

        })
        //elimina usuario
        let eliminaModal = document.getElementById('eliminaModal')
        eliminaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id
        })
    </script>
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
        $(document).ready(function () {
            <?php
            // Verifica si los datos de la primera tabla han sido ingresados y abre el modal de la segunda tabla
            if (isset($_SESSION['datos_tabla1_ingresados'])) {
                unset($_SESSION['datos_tabla1_ingresados']); // Elimina la variable de sesión después de usarla
                ?>
                $('#nuevoModal').modal('show');
                <?php
            }
            ?>

        });
    </script>
</body>

</html>