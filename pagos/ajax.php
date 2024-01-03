<?php

require '../modelo/conexion.php';

//buscar miembro
if ($_POST['action'] == 'infomiembro') {
    if (!empty($_POST['tcliente'])) {
        $data = 0;
        $telefono = $_POST['tcliente'];
        $resultado = "SELECT persona.nombre as personanombre, miembro.fechaincio, miembro.fechapago, miembro.idmiembro, membresia.nombre as nombremembresia, membresia.precio FROM miembro 
        INNER JOIN persona ON miembro.persona_idpersona = persona.idpersona 
        INNER JOIN membresia ON miembro.membresia_idmembresia = membresia.idmembresia 
        WHERE telefono LIKE $telefono ";
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





//agregar pago
if ($_POST['action'] == 'addpago') {
    if ( empty($_POST['cantidad'])) {
        echo 'error';
    } else {
       $codmiembro = $_POST['codmiembro'];
        $cantidad = $_POST['cantidad'];
        $total = $_POST['total'];
        $fecha = $_POST['fecha'];
        $resultado = "CALL 	add_pago($cantidad,$codmiembro,$total,DATE('$fecha'))";
        $resultadofinal = $conexion->query($resultado);
        $row_cnt = $resultadofinal->num_rows;
        if ($row_cnt > 0) {
            
        } else {
            echo 'error';
        }


    }
    exit;

}


?>