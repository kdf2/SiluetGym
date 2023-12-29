<?php
require_once('../librerias/tcpdf/tcpdf.php');
 //Llamando a la Libreria TCPDF
require '../modelo/conexion.php';//Llamando a la conexión para BD
date_default_timezone_set('America/Guatemala');


ob_end_clean(); //limpiar la memoria


class MYPDF extends TCPDF{
      
    	public function Header() {
            $bMargin = $this->getBreakMargin();
            $auto_page_break = $this->AutoPageBreak;
            $this->SetAutoPageBreak(false, 0);
            $img_file = "../componentes/Imagenes/logo.png";
            $this->Image($img_file, 120, -10, 80, 80, '', '', '', false, 30, '', false, false, 0);
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
$pdf->SetTitle('Informe de ventas');
 
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
$pdf->AddPage('L', 'A4');
$pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
$pdf->SetXY(200, 22);
$pdf->Write(0, 'Fecha: '. date('d-m-Y'));
$pdf->SetXY(200, 28);
$pdf->Write(0, 'Hora: '. date('h:i A'));


$pdf->SetFont('helvetica','B',25); //Tipo de fuente y tamaño de letra
$pdf->SetXY(80, 20); //Margen en X y en Y
$pdf->SetTextColor(153,204,0);
$pdf->Write(0, 'Siluet Gym ');





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
$pdf->Cell(200,6,'LISTA DE VENTAS',0,0,'C');


$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0); 


//Almando la cabecera de la Tabla
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('helvetica','B',12); //La B es para letras en Negritas
$pdf->Cell(15,6,'No. v',1,0,'C',1);
$pdf->Cell(20,6,'Fecha',1,0,'C',1);
$pdf->Cell(44,6,'Personal',1,0,'C',1);
$pdf->Cell(44,6,'Cliente',1,0,'C',1);
$pdf->Cell(55,6,'Producto',1,0,'C',1);
$pdf->Cell(40,6,'Marca',1,0,'C',1);
$pdf->Cell(20,6,'Cantidad',1,0,'C',1);
$pdf->Cell(25,6,'Total',1,1,'C',1); 
/*El 1 despues de  Fecha Ingreso indica que hasta alli 
llega la linea */



$pdf->SetFont('helvetica','',7);
//SQL para consultas Empleados
$fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
$fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));

$innerjoinventas = "SELECT detalle_de_venta.venta_idventa, detalle_de_venta.producto_idproducto, detalle_de_venta.cantidad, detalle_de_venta.subt, 
venta.Fecha, venta.nombrepersona, venta.idventa, venta.persona_idpersona, persona.idpersona, persona.nombre as pnombre,
producto.idproducto, producto.nombre, producto.marca
FROM detalle_de_venta 
INNER JOIN venta ON detalle_de_venta.venta_idventa= venta.idventa 
INNER JOIN persona ON venta.persona_idpersona=persona.idpersona
INNER JOIN producto ON detalle_de_venta.producto_idproducto=producto.idproducto WHERE  `Fecha` BETWEEN '$fechaInit' AND '$fechaFin' ORDER BY venta_idventa ASC";
$query = mysqli_query($conexion, $innerjoinventas);
$suma=0;
while ($row_gasto = mysqli_fetch_array($query)) { 
    $suma+=$row_gasto['subt'];
        $pdf->Cell(15,6,($row_gasto['venta_idventa']),1,0,'C');
        $pdf->Cell(20,6,(date('Y-m-d', strtotime($row_gasto['Fecha']))),1,0,'C'); 
        $pdf->Cell(44,6,($row_gasto['nombrepersona']),1,0,'C');
        $pdf->Cell(44,6,($row_gasto['pnombre']),1,0,'C');
        $pdf->Cell(55,6,($row_gasto['nombre']),1,0,'C');
        $pdf->Cell(40,6,($row_gasto['marca']),1,0,'C');
        $pdf->Cell(20,6,($row_gasto['cantidad']),1,0,'C');
        $pdf->Cell(25,6,$row_gasto['subt'],1,1,'C');
         
    }
   
    $pdf->SetFont('helvetica','B',12);
    $pdf->SetTextColor(204,0,0);
    $pdf->Cell(238,6,('TOTAL'),1,0,'C');
    $pdf->Cell(25,6,'Q'.$suma,1,0,'C');
//$pdf->AddPage(); //Agregar nueva Pagina

$pdf->Output('Resumen_venta_'.date('d_m_y').'.pdf', 'I'); 
// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga