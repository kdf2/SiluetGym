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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../componentes/Css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../jquery-3.7.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #add_producto_venta {
        display: none;
    }

    #btn-facturar-venta {
        display: none;
    }

    #btn_anular_venta {
        display: none;
    }  
    #btncliente {
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
                    <h1 class="d-flex justify-content-center">Nueva venta</h1>
                    <div class="col align-self-start datos_cliente">
                        <div class="form-group">
                            <h4 class="text-center">Datos del Cliente</h4>
                        </div>

                        <div class="card">
                            <div class="action_cliente">
                                <a href="#" class="btn btn-primary btn_new "  id="btncliente" data-bs-toggle="modal"
                                    data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Agregar
                                    cliente</a>

                                    <button type="submit" id="btncliente"
                                                class="btn btn-danger btn_ok text-center btn_anular_venta2"><i class="fas fa-ban"></i>
                                                &nbsp;Anular venta</button>
                                    
                            </div>

                            <div class="card-body">
                                <form action="generarventa.php" target="_blank" method="POST"  name="form_new_cliente_venta" target="_blank" >
                                    <input type="hidden" name="action" value="addCliente">
                                    <input type="hidden" name="idCliente" id="idCliente" value="" require>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label> Numero de teléfono</label>
                                                <input autofocus class="form-control" type="number"
                                                    name="telefono_cliente" id="telefono_cliente"
                                                    placeholder="Ingrese numero del cliente" required>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="nombre_cliente" id="nombre_cliente"
                                                    class="form-control" disabled required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Dirreción</label>
                                                <input type="text" name="direccion_cliente" id="direccion_cliente"
                                                    class="form-control" disabled required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-2">
                                        <button type="submit" id="btn_anular_venta"
                                                class="btn btn-danger btn_ok text-center"><i class="fas fa-ban"></i>
                                                &nbsp;Anular venta</button>
                                        </div>

                                        <div class=" col-md-2">
                                        <button  type="subtmit" class="btn btn-success btn_new  text-center" id="btn-facturar-venta"  onclick="enviarID()"><i
                                                    class="far fa-edit"></i>&nbsp;Realizar venta</button>
                                            
                                        </div>
                                        <div class=" col-md-2">
                                       
                                        
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="datos_venta">
                        <div class="form-group">
                            <h4 class="text-center">Venta realizada por :
                                <?php
                                echo $fila2[$atributo2];
                                ?>
                            </h4>




                        </div>
                    </div>

                    <table class="tbl_venta ">
                        <thead class="table-dark">
                            <tr class="table-primary">
                                <th width="100px">Cdigo</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Existencia</th>
                                <th width="100px" class="text-center">Cantidad</th>
                                <th class="text-right">Precio</th>
                                <th class="text-right">Precio total</th>
                                <th>accion</th>
                            </tr>


                            <tr>
                                <td><input type="number" name="text_codigo_producto" id="text_codigo_producto"></td>
                                <td id="text_nombre" class="text-center">-</td>
                                <td id="text_marca" class="text-center">-</td>
                                <td id="text_existencia" class="text-center">-</td>
                                <td><input type="number" name="txt_cantidad_producto" id="txt_cantidad_producto"
                                        value="0" min="1" disabled></td>
                                <td id="text_precio" class="text-right">0.00</td>
                                <td id="text_precio_total" class="text-right">0.00</td>
                                <td> <a href="#" id="add_producto_venta" class="text-success "><i
                                            class="fas fa-plus"></i> Agregar</a></td>
                            </tr>

                            <tr class="table-primary">
                                <th>codigo</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-right">Precio total</th>
                                <th class="text-center">Accion</th>
                            </tr>
                        </thead>

                        <tbody id="detalle_venta" class="table-dark">
                            <!--contenido ajax-->
                        </tbody>

                        <tfoot id="detalle_totales">

                        </tfoot>
                    </table>

                </div>
            </main>
        </div>
    </div>

    <?php include 'nuevoModal.php' ?>
    <script>
        
        let nuevoModal = document.getElementById('nuevoModal')
                nuevoModal.addEventListener('shown.bs.modal', event => {
                    let inputcantidad = nuevoModal.querySelector('.modal-body #nombre').focus()
                })
    </script>
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