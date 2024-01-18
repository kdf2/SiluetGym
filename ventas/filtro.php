<?php
sleep(1);
require '../modelo/conexion.php';

/**
 * Nota: Es recomendable guardar la fecha en formato año - mes y dia (2022-08-25)
 * No es tan importante que el tipo de fecha sea date, puede ser varchar
 * La funcion strtotime:sirve para cambiar el forma a una fecha,
 * esta espera que se proporcione una cadena que contenga un formato de fecha en Inglés US,
 * es decir año-mes-dia e intentará convertir ese formato a una fecha Unix dia - mes - año.
 */

$fechaInit = date("Y-m-d", strtotime($_POST['f_ingreso']));
$fechaFin = date("Y-m-d", strtotime($_POST['f_fin']));
$suma = 0;

$innerjoinventas = "SELECT detalle_de_venta.venta_idventa, detalle_de_venta.producto_idproducto, detalle_de_venta.cantidad, detalle_de_venta.subt, 
venta.Fecha, venta.nombrepersona, venta.idventa, venta.persona_idpersona, persona.idpersona, persona.nombre as pnombre,
producto.idproducto, producto.nombre, producto.marca
FROM detalle_de_venta 
INNER JOIN venta ON detalle_de_venta.venta_idventa= venta.idventa 
INNER JOIN persona ON venta.persona_idpersona=persona.idpersona
INNER JOIN producto ON detalle_de_venta.producto_idproducto=producto.idproducto WHERE  `Fecha` BETWEEN '$fechaInit' AND '$fechaFin' ORDER BY venta_idventa ASC";

$query = mysqli_query($conexion, $innerjoinventas);
//print_r($sqlTrabajadores);
$total = mysqli_num_rows($query);
echo '<strong>Total: </strong> (' . $total . ')';
?>

<table id="tableEmpleados" class="table table-striped table-bordered" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>No. venta</th>
            <th>Fecha</th>
            <th>Personal</th>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
    </thead>
    <?php
    $i = 1;
    while ($row_venta = mysqli_fetch_array($query)) { ?>
        <?php
        $suma += $row_venta['subt']
            ?>
        <tr>
            <td>
                <?= $row_venta['venta_idventa']; ?>
            </td>

            <td>
                <?= $row_venta['Fecha']; ?>
            </td>

            <td>
                <?= $row_venta['nombrepersona']; ?>
            </td>

            <td>
                <?= $row_venta['pnombre']; ?>
            </td>

            <td>
                <?= $row_venta['nombre']; ?>
            </td>

            <td>
                <?= $row_venta['marca']; ?>
            </td>

            <td>
                <?= $row_venta['cantidad']; ?>
            </td>

            <td>
                <?= $row_venta['subt']; ?>
            </td>
        </tr>
    <?php } ?>


</table>
<?php
echo '<h1 style="color:red">El total de las ventas en el rango dado es de:  (' . "Q" . $suma . ')</h1>';
?>