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

// Recibe el ID de la URL
$idmiembroo = isset($_GET['id']) ? $_GET['id'] : '';





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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../componentes/Css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../jquery-3.7.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #btn-pdf {
        display: none;
    }

    #btn-facturar-mensualidad {
        display: none;
    }

    #btn_anular_mensualidad {
        display: none;
    }
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
                                <li><a class="dropdown-item" href="pagos.php">Ralizar mensualidad</a></li>
                                <li><a class="dropdown-item" href="membresias.php">Membresias</a></li>
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
                    <h1 class="d-flex justify-content-center">Gestión de pagos</h1>
                    <div class="datos_venta">
                        <div class="form-group">
                            <h4 class="text-center">Pago realizado por:
                                <?php
                                echo $fila2[$atributo2];
                                ?>
                            </h4>
                        </div>
                    </div>


                    <div class="card-body">
                        <form action="generarpdf.php" target="_blank" method="POST" name="form_new_cliente_venta"
                            target="_blank">
                            <input type="hidden" name="action" value="idcliente">
                            <input type="hidden" name="idmiembro" id="idmiembro" value="" require>
                            <input type="hidden" name="precio" id="precio" value="" require>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Numero de teléfono </label>
                                        <?php if ($idmiembroo > 0) {
                                            $sql = "SELECT persona.telefono FROM persona INNER JOIN miembro ON miembro.persona_idpersona =persona.idpersona WHERE idmiembro =$idmiembroo";
                                            $result = $conexion->query($sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                // Recorrer los resultados y mostrar los datos
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $celular = $row["telefono"];
                                                }
                                            }
                                            ?>
                                            <input autofocus class="form-control" type="number"  name="telefono_miembro"
                                                value="<?php echo $celular; ?>" id="telefono_miembro"
                                                placeholder="Ingrese numero del miembro" required>
                                        <?php } else { ?>
                                            <input autofocus class="form-control" type="number" name="telefono_miembro" 
                                                id="telefono_miembro" placeholder="Ingrese numero del miembro" required>
                                        <?php } ?>
                                    </div>
                                </div>








                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre_miembro" id="nombre_miembro"
                                            class="form-control" disabled required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Membresía</label>
                                        <input type="text" name="membresia_miembro" id="membresia_miembro"
                                            class="form-control" disabled required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha de inicio</label>
                                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                            disabled required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cantidad de meses a pagar</label>
                                        <input type="number" name="txt_cantidad_meses" id="txt_cantidad_meses" value="0"
                                            min="1" class="form-control" disabled>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Total</label>
                                        <input autofocus class="form-control" type="number" name="total_meses"
                                            id="total_meses" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha de vencimiento</label>
                                        <input type="date" name="fechavencimiento" id="fechavencimiento"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-2">
                                    <button type="submit" id="btn_anular_mensualidad"
                                        class="btn btn-danger btn_ok text-center" onclick="refrezcar()"><i
                                            class="fas fa-ban"></i>
                                        &nbsp;Anular pago</button>
                                </div>

                                <div class=" col-md-2">
                                    <button href="#" id="btn-facturar-mensualidad"
                                        class="btn btn-success btn_new  text-center "><i class="far fa-edit"></i>&nbsp;
                                        Realizar pago</button>

                                </div>

                                <div class=" col-md-2">
                                    <button type="subtmit" class="btn btn-info btn_new  text-center" id="btn-pdf"><i
                                            class="far fa-edit"></i>&nbsp;Generar comprobante de pago </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="funciones.js"></script>

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





</body>

</html>