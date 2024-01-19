<?php
require '../modelo/conexion.php';

//buscar proveedor
if ($_POST['action'] == 'inforproveedor') {
    if (!empty($_POST['tpersona'])) {
       // echo 'error';
        $data = 0;
        $telefono = $_POST['tpersona'];
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



?>