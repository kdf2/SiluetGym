<?php

require_once('../librerias/tcpdf/tcpdf.php');
//Llamando a la Libreria TCPDF
require '../modelo/conexion.php'; //Llamando a la conexión para BD
session_start();

date_default_timezone_set('America/Guatemala');

$nombre = $_SESSION["nombrepersona"];

ob_end_clean(); //limpiar la memoria


class MYPDF extends TCPDF
{

    public function Header()
    {
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
$pdf->SetTitle('Informe de mensualidades');

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
$pdf->SetFont('helvetica', 'B', 10); //Tipo de fuente y tamaño de letra

$pdf->SetXY(150, 25);
$pdf->Write(0, 'Fecha: ' . date('d-m-Y'));
$pdf->SetXY(150, 30);
$pdf->Write(0, 'Hora: ' . date('h:i A'));


$pdf->SetFont('helvetica', 'B', 25); //Tipo de fuente y tamaño de letra
$pdf->SetXY(15, 20); //Margen en X y en Y
$pdf->SetTextColor(153, 204, 0);
$pdf->Write(0, 'Siluet Gym ');

$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetXY(5, 30); //Margen en X y en Y
$pdf->SetTextColor(153, 204, 0);
$pdf->Write(0, $nombre);



$pdf->Ln(35); //Salto de Linea
$pdf->Cell(40, 26, '', 0, 0, 'C');
/*$pdf->SetDrawColor(50, 0, 0, 0);
$pdf->SetFillColor(100, 0, 0, 0); */
$pdf->SetTextColor(34, 68, 136);
//$pdf->SetTextColor(255,204,0); //Amarillo
//$pdf->SetTextColor(34,68,136); //Azul
//$pdf->SetTextColor(153,204,0); //Verde
//$pdf->SetTextColor(204,0,0); //Marron
//$pdf->SetTextColor(245,245,205); //Gris claro
//$pdf->SetTextColor(100, 0, 0); //Color Carne
$pdf->SetFont('helvetica', 'B', 15);
$pdf->Cell(85, 6, 'comprobante de mensualidad', 0, 0, 'C');



$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(5, 75);
//Almando la cabecera de la Tabla
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('helvetica', 'B', 12); //La B es para letras en Negritas
$pdf->Cell(60, 6, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'F. vencimiento', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'C/meses', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'Membresia', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Total', 1, 1, 'C', 1);
/*El 1 despues de  Fecha Ingreso indica que hasta alli 
llega la linea */

$pdf->SetFont('helvetica', '', 10);

//SQL para consultas Empleados
$sql = "SELECT  persona.nombre as personanombre, miembro.fechapago, membresia.nombre as nombremembresia, membresia.precio, pago.total, pago.mesesapagar FROM pago
INNER JOIN miembro ON pago.miembro_idmiembro = miembro.idmiembro 
INNER JOIN persona ON miembro.persona_idpersona = persona.idpersona 
INNER JOIN membresia ON miembro.membresia_idmembresia = membresia.idmembresia
ORDER BY idpago DESC LIMIT 1";
$result = $conexion->query($sql);
$pdf->SetXY(5, 81);
if ($result) {
    // Obtener el resultado como un array asociativo
    
    $row = $result->fetch_assoc();
    $concatenar=$row['nombremembresia'].'-'.$row['precio'];
    $pdf->Cell(60, 6, ($row['personanombre']), 1, 0, 'C');
    $pdf->Cell(35, 6, (date('Y-m-d', strtotime($row['fechapago']))), 1, 0, 'C');
    $pdf->Cell(35, 6, ($row['mesesapagar']), 1, 0, 'C');
    $pdf->Cell(35, 6, $concatenar, 1, 0, 'C');
    $pdf->Cell(25, 6,($row['total']) , 1, 1, 'C');
    $pdf->SetXY(5, 87);
    $pdf->SetFont('helvetica','B',12);
    $pdf->SetTextColor(204,0,0);
    $pdf->Cell(165,6,('TOTAL'),1,0,'C');
    $pdf->Cell(25,6,'Q'.($row['total']),1,0,'C');
    // Mostrar o utilizar los datos del último registr
}


/*$innerjoingasto = "SELECT usuario.idusuario,
categoria.idcategoria, categoria.nombre as nombre_cateogoria,
gasto.idgasto, gasto.cantidad,	gasto.fecha, gasto.usuario_idusuario, gasto.categoria_idcategoria, gasto.Nombrepersona
FROM gasto
INNER JOIN usuario ON gasto.usuario_idusuario= usuario.idusuario
INNER JOIN categoria ON gasto.categoria_idcategoria=categoria.idcategoria  WHERE  `fecha` BETWEEN '$fechaInit' AND '$fechaFin' ORDER BY fecha ASC";
$query = mysqli_query($conexion, $innerjoingasto);
$suma=0;
while ($row_gasto = mysqli_fetch_array($query)) {
    $suma+=$row_gasto['cantidad'];
        $pdf->Cell(60,6,($row_gasto['Nombrepersona']),1,0,'C');
        $pdf->Cell(25,6,(date('Y-m-d', strtotime($row_gasto['fecha']))),1,0,'C'); 
        $pdf->Cell(48,6,($row_gasto['nombre_cateogoria']),1,0,'C');
        $pdf->Cell(35,6,$row_gasto['cantidad'],1,1,'C');
    }
    */

//$pdf->AddPage(); //Agregar nueva Pagina
$pdf->Output('Resumen_venta_' . date('d_m_y') . '.pdf', 'I');
// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga