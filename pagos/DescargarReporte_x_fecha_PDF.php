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
$pdf->Cell(200,6,'LISTA DE MENSUALIDADES',0,0,'C');


$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0); 


//Almando la cabecera de la Tabla
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('helvetica','B',12); //La B es para letras en Negritas
$pdf->Cell(65,6,'Nombre',1,0,'C',1);
$pdf->Cell(40,6,'Membresia',1,0,'C',1);
$pdf->Cell(35,6,'Fecha de pago',1,0,'C',1);
$pdf->Cell(25,6,'C. meses',1,0,'C',1);
$pdf->Cell(45,6,'Fecha vencimiento',1,0,'C',1);
$pdf->Cell(40,6,'total',1,1,'C',1);

/*El 1 despues de  Fecha Ingreso indica que hasta alli 
llega la linea */



$pdf->SetFont('helvetica','',10);
//SQL para consultas Empleados
$fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
$fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));

$innerjoinventas ="SELECT  persona.nombre as personanombre, miembro.fechapago, membresia.nombre as nombremembresia, membresia.precio, pago.total, pago.mesesapagar, pago.fechadepago as fpago, pago.fechavencimiento FROM pago
INNER JOIN miembro ON pago.miembro_idmiembro = miembro.idmiembro 
INNER JOIN persona ON miembro.persona_idpersona = persona.idpersona 
INNER JOIN membresia ON miembro.membresia_idmembresia = membresia.idmembresia  WHERE  pago.fechadepago BETWEEN '$fechaInit' AND '$fechaFin'  ORDER BY fpago ASC";
$query = mysqli_query($conexion, $innerjoinventas);
$suma=0;
while ($row_gasto = mysqli_fetch_array($query)) { 
    $concatenar=$row_gasto['nombremembresia'].' - Q'.$row_gasto['precio'];
    $suma+=$row_gasto['total'];
        $pdf->Cell(65,6,($row_gasto['personanombre']),1,0,'C');
        $pdf->Cell(40,6,$concatenar,1,0,'C');
        $pdf->Cell(35,6,(date('Y-m-d', strtotime($row_gasto['fpago']))),1,0,'C'); 
        $pdf->Cell(25,6,($row_gasto['mesesapagar']),1,0,'C');
        $pdf->Cell(45,6,(date('Y-m-d', strtotime($row_gasto['fechavencimiento']))),1,0,'C'); 
        $pdf->Cell(40,6,($row_gasto['total']),1,1,'C');
         
    }
   
    $pdf->SetFont('helvetica','B',12);
    $pdf->SetTextColor(204,0,0);
    $pdf->Cell(210,6,('TOTAL'),1,0,'C');
    $pdf->Cell(40,6,'Q'.$suma,1,0,'C');
//$pdf->AddPage(); //Agregar nueva Pagina

$pdf->Output('Resumen_venta_'.date('d_m_y').'.pdf', 'I'); 
// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga