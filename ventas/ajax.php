<?php
require '../modelo/conexion.php';
//buscar cliente
if ($_POST['action'] == 'searCliente') {
    if (!empty($_POST['cliente'])) {
        $data = 0;
        $telefono = $_POST['cliente'];
        $resultado = "SELECT * FROM persona WHERE telefono LIKE $telefono ";
        $resultadofinal = $conexion->query($resultado);
        $row_cnt = $resultadofinal->num_rows;
        if ($row_cnt > 0) {
            $data = mysqli_fetch_assoc($resultadofinal);
        } else {
            $data = 0;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit;
}

if ($_POST['action'] == 'infoproducto') {
    if (!empty($_POST['producto'])) {
        $data = 0;
        $idproducto = $_POST['producto'];
        $resultado = "SELECT * FROM producto WHERE idproducto LIKE $idproducto ";
        $resultadofinal = $conexion->query($resultado);
        $row_cnt = $resultadofinal->num_rows;
        if ($row_cnt > 0) {
            $data = mysqli_fetch_assoc($resultadofinal);
        } else {
            $data = 0;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit;
}


//agregar producto fantasma
if ($_POST['action'] == 'addProductodetalle') {
    if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
        echo 'error';
    } else {
        $codproducto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $subtotal = $_POST['subtotal'];
        $resultado = "CALL 	add_detalle_temp ($codproducto,$cantidad,$subtotal)";
        $resultadofinal = $conexion->query($resultado);
        $row_cnt = $resultadofinal->num_rows;
        $detalleTabla = '';
        $sub_total = 0;
        $total = 0;
        $arrayData = array();
        $data = 0;
        if ($row_cnt > 0) {
            while ($data = mysqli_fetch_assoc($resultadofinal)) {
                $sub_Total = round($data['subt'], 2);
                $total = round($sub_Total + $total, 2);
                $detalleTabla .= '
            <tr>
            <td>' . $data['codproducto'] . '</td>
            <td>' . $data['nombre'] . '</td>
            <td>' . $data['marca'] . '</td>
            <td class="text-center">' . $data['cantidad'] . '</td>
            <td class="text-right">' . $data['subt'] . '</td>
           
            <td class="">
                <a href="#" class="link_delete"
                    onclick="event.preventDefault(); del_producto_detalle(' . $data['correlativo'] . ');"> <i
                        class="far fa-trash-alt"></i>Eliminar</a>
            </td>
        </tr>
            ';
            }
            $total = round($total);
            $detalle_totales = '
        <tr class="bg-danger">
                            <td colspan="4" class="text-right text-white">TOTAL Q.</td>
                            <td class="text-right text-white">' . $total . '</td>
                        </tr>';


            $arrayData['detalle'] = $detalleTabla;
            $arrayData['totales'] = $detalle_totales;
            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        } else {
            echo 'error';
        }



    }
    exit;

}





if ($_POST['action'] == 'delProductoDetalle') {

    if (empty($_POST('idfan'))) {
        echo 'error';
    } else {
        $id_detalle = $_POST('idfan');

        $resultado = "CALL 	del_detalle_temp ($id_detalle)";
        $resultadofinal2 = $conexion->query($resultado);
        $row_cnt = $resultadofinal2->num_rows;
        $detalleTabla = '';
        $sub_total = 0;
        $total = 0;
        $arrayData = array();
        $data = 0;
        if ($row_cnt > 0) {
            while ($data = mysqli_fetch_assoc($resultadofinal2)) {
                $sub_Total = round($data['subt'], 2);
                $total = round($sub_Total + $total, 2);
                $detalleTabla .= '
            <tr>
            <td>' . $data['codproducto'] . '</td>
            <td>' . $data['nombre'] . '</td>
            <td>' . $data['marca'] . '</td>
            <td class="text-center">' . $data['cantidad'] . '</td>
            <td class="text-right">' . $data['subt'] . '</td>
           
            <td class="">
                <a href="#" class="link_delete"
                    onclick="event.preventDefault(); del_producto_detalle(' . $data['correlativo'] . ');"> <i
                        class="far fa-trash-alt"></i>Eliminar</a>
            </td>
        </tr>
            ';
            }
            $total = round($total);
            $detalle_totales = '
        <tr class="bg-danger">
                            <td colspan="4" class="text-right text-white">TOTAL Q.</td>
                            <td class="text-right text-white">' . $total . '</td>
                        </tr>';


            $arrayData['detalle'] = $detalleTabla;
            $arrayData['totales'] = $detalle_totales;
            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        } else {
            echo 'error';
        }
    }


    exit;
}
?>