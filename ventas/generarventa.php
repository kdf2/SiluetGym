<?php
require_once('../librerias/tcpdf/tcpdf.php');
require '../modelo/conexion.php';
session_start();


$id=$_POST["id"];

 //idpersonacompradora
$a=0;
//almacenar  el total de la venta para realizar la factura
 $sqltotal = "SELECT SUM(subt) as suma FROM fantasma";
 $total=$conexion->query($sqltotal);
$totalfila = mysqli_fetch_assoc($total);
$total=$totalfila["suma"];
$idventa=0;
//nombre del persona que vende el producto
$nombre=$_SESSION["nombrepersona"];

//saber cuantos productos va a comprar y hacer el descuento en la tabla de productos
$sql = "SELECT COUNT(*) as total_filas FROM fantasma";
$result = $conexion->query($sql);
if ($result) {
    // Obtener el resultado como un array asociativo
    $row = $result->fetch_assoc();
    
    //Mostrar el número de filas
    $total_de_compras= $row["total_filas"];
    $consultaSeleccion = "SELECT * FROM fantasma";
    $resultadoSeleccion = $conexion->query($consultaSeleccion);
    //recorer para ir restando los productos
    if ($resultadoSeleccion) {
        // Recorrer cada fila de la tabla
        
        while ($fila = $resultadoSeleccion->fetch_assoc()) {
            $datocompra=0;
            $datoactual=0;
            $idproducto=0;
            //codigo del producto
            $idproducto=$fila['codproducto'];
            // cantidad que se compro del producto
            $datocompra=$fila['cantidad'];
            //ir a buscar el dato 
            $consulta = "SELECT cantidad FROM producto WHERE idproducto =$idproducto ";
            $result = $conexion->query($consulta);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $datoactual=$row["cantidad"];
                }
                $cantidadactualizada=$datoactual-$datocompra;
                $sql = "UPDATE producto SET cantidad=$cantidadactualizada WHERE idproducto = $idproducto";
                $result = $conexion->query($sql);
               
            }



        }
    }
}


//insertar los datos a la tabla venta
$sqlventa="INSERT INTO venta (persona_idpersona,total,nombrepersona) VALUES ($id,$total,'$nombre')";
if ($conexion->query($sqlventa)) {
    $idventa = $conexion->insert_id;
}

//copiar los detalles de la venta a la tabla verdadera

$sqlSelect = "SELECT * FROM fantasma";
$resultSelect = $conexion->query($sqlSelect);
if ($resultSelect->num_rows > 0) {
    while ($row = $resultSelect->fetch_assoc()) {
        $cant = $row["cantidad"]; // Obtener el valor del campo 1
        $codprod = $row["codproducto"]; // Obtener el valor del campo 2
        $subt = $row["subt"];
        // Consulta para insertar los datos en la tabla destino
        $sqlInsert = "INSERT INTO detalle_de_venta (venta_idventa, producto_idproducto,cantidad,subt) VALUES ($idventa, $codprod,$cant,$subt )";
        $resultInsert = $conexion->query($sqlInsert);
    }

}



//creacion del pdf
date_default_timezone_set('America/Guatemala');


ob_end_clean(); //limpiar la memoria


class MYPDF extends TCPDF{
      
    	public function Header() {
            $bMargin = $this->getBreakMargin();
            $auto_page_break = $this->AutoPageBreak;
            $this->SetAutoPageBreak(false, 0);
            $img_file = "../componentes/Imagenes/logo.png";
            $this->Image($img_file, 60, -10, 80, 80, '', '', '', false, 30, '', false, false, 0);
            $this->SetAutoPageBreak($auto_page_break, $bMargin);
            $this->setPageMark();
	    }
}


//Iniciando un nuevo pdf
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
 
//Establecer margenes del PDF
$pdf->SetMargins(20, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático
 
//Informacion del PDF
$pdf->SetCreator('kevin daniel fuentes fuentes');
$pdf->SetAuthor('Siluet Gym');
$pdf->SetTitle('Informe de venta');
 
/** Eje de Coordenadas
 *          Y
 *          -
 *          - 
 *          -
 *  X ------------- X
 *          -
 *          -
 *          -
 *          Y
 * 
 * $pdf->SetXY(X, Y);
 */

//Agregando la primera página
//Agregando la primera página
$pdf->AddPage();
$pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra

$pdf->SetXY(150, 25);
$pdf->Write(0, 'Fecha: '. date('d-m-Y'));
$pdf->SetXY(150, 30);
$pdf->Write(0, 'Hora: '. date('h:i A'));


$pdf->SetFont('helvetica','B',25); //Tipo de fuente y tamaño de letra
$pdf->SetXY(15, 20); //Margen en X y en Y
$pdf->SetTextColor(153,204,0); //Verde
$pdf->Write(0, 'Siluet Gym ');

$pdf->SetFont('helvetica','B',12);
$pdf->SetXY(5, 30); //Margen en X y en Y
$pdf->SetTextColor(153,204,0);
$pdf->Write(0, $nombre);




$pdf->Ln(35); //Salto de Linea
$pdf->Cell(40,26,'',0,0,'C');
/*$pdf->SetDrawColor(50, 0, 0, 0);
$pdf->SetFillColor(100, 0, 0, 0); */
$pdf->SetTextColor(34,68,136);
//$pdf->SetTextColor(255,204,0); //Amarillo
//$pdf->SetTextColor(34,68,136); //Azul
//$pdf->SetTextColor(153,204,0); //Verde
//$pdf->SetTextColor(204,0,0); //Marron
//$pdf->SetTextColor(245,245,205); //Gris claro
//$pdf->SetTextColor(100, 0, 0); //Color Carne
$pdf->SetFont('helvetica','B', 15); 
$pdf->Cell(85,6,'DATOS DEL CLIENTE',0,0,'C');



$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0); 

//Almando la cabecera de la Tabla
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('helvetica','B',12); //La B es para letras en Negritas
$pdf->Cell(80,6,'Nombre',1,0,'C',1);
$pdf->Cell(30,6,'Telefono',1,0,'C',1);
$pdf->Cell(60,6,'Direccion',1,1,'C',1); 
/*El 1 despues de  Fecha Ingreso indica que hasta alli 
llega la linea */

$pdf->SetFont('helvetica','',10);


//SQL para consultas datos del cliente

$consulta = "SELECT * FROM venta ORDER BY idventa DESC LIMIT 1";
$resultado = $conexion->query($consulta);
if ($resultado) {
    // Obtener el último registro como un array asociativo
    $ultimoRegistro = $resultado->fetch_assoc();
    if ($ultimoRegistro) {
        $personaid=$ultimoRegistro['persona_idpersona'];
    }
}
    
$sql = "SELECT * FROM persona WHERE idpersona =$personaid";
$result = $conexion->query($sql);


if ($result) {
    // Obtener el último registro como un array asociativo
    $datos = $result->fetch_assoc();
    if ($datos) {
        
        $pdf->Cell(80,6,($datos['nombre']),1,0,'C',1);
        $pdf->Cell(30,6,$datos['telefono'],1,0,'C',1);
        $pdf->Cell(60,6,$datos['direccion'],1,1,'C',1);
    }
}

//Mostrar o utilizar los datos obtenidos

        // ... Puedes mostrar o utilizar otros campos según tu tabla


$pdf->Ln(10); //Salto de Linea
$pdf->Cell(40,26,'',0,0,'C');
/*$pdf->SetDrawColor(50, 0, 0, 0);
$pdf->SetFillColor(100, 0, 0, 0); */
$pdf->SetTextColor(34,68,136);
//$pdf->SetTextColor(255,204,0); //Amarillo
//$pdf->SetTextColor(34,68,136); //Azul
//$pdf->SetTextColor(153,204,0); //Verde
//$pdf->SetTextColor(204,0,0); //Marron
//$pdf->SetTextColor(245,245,205); //Gris claro
//$pdf->SetTextColor(100, 0, 0); //Color Carne
$pdf->SetFont('helvetica','B', 15); 
$pdf->Cell(85,6,'DATOS DE LA COMPRA',0,0,'C');

$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0); 

//Almando la cabecera de la Tabla
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('helvetica','B',12); //La B es para letras en Negritas
$pdf->Cell(30,6,'Cantidad',1,0,'C',1);
$pdf->Cell(90,6,'Nombre',1,0,'C',1);
$pdf->Cell(50,6,'Subtotal',1,1,'C',1); 
/*El 1 despues de  Fecha Ingreso indica que hasta alli 
llega la linea */

$pdf->SetFont('helvetica','',10);




$consulta = "SELECT * FROM detalle_de_venta ORDER BY venta_idventa DESC LIMIT 1";
$resultado = $conexion->query($consulta);
if ($resultado) {
    // Obtener el último registro como un array asociativo
    $ultimoRegistro = $resultado->fetch_assoc();
    if ($ultimoRegistro) {
        $iddetalleventa=$ultimoRegistro['venta_idventa'];
    }
}


$innerjoingasto = "SELECT producto.idproducto, producto.nombre,
detalle_de_venta.cantidad, detalle_de_venta.subt, detalle_de_venta.producto_idproducto,detalle_de_venta.venta_idventa
FROM detalle_de_venta
INNER JOIN producto ON detalle_de_venta.producto_idproducto = producto.idproducto WHERE detalle_de_venta.venta_idventa=$iddetalleventa" ;
$query = mysqli_query($conexion, $innerjoingasto);
$suma=0;
while ($row_gasto = mysqli_fetch_array($query)) {
    $suma+=$row_gasto['subt'];
        $pdf->Cell(30,6,$row_gasto['cantidad'],1,0,'C');
        $pdf->Cell(90,6,$row_gasto['nombre'],1,0,'C'); 
        $pdf->Cell(50,6,$row_gasto['subt'],1,1,'C');
    }
    $resultado = "DELETE FROM fantasma";
$resultadofinal = $conexion->query($resultado);
if($resultadofinal){
}
    $pdf->SetFont('helvetica','B',12);
    $pdf->SetTextColor(204,0,0);
    $pdf->Cell(120,6,('TOTAL'),1,0,'C');
    $pdf->Cell(50,6,'Q'.$suma,1,0,'C');

    //$pdf->AddPage(); //Agregar nueva Pagina

$pdf->Output('Resumen_venta_'.date('d_m_y').'.pdf', 'I'); 
// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga

