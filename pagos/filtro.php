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

$innerjoinventas = "SELECT  persona.nombre as personanombre, miembro.fechapago, membresia.nombre as nombremembresia, membresia.precio, pago.total, pago.mesesapagar, pago.fechadepago as fpago, pago.fechavencimiento FROM pago
INNER JOIN miembro ON pago.miembro_idmiembro = miembro.idmiembro 
INNER JOIN persona ON miembro.persona_idpersona = persona.idpersona 
INNER JOIN membresia ON miembro.membresia_idmembresia = membresia.idmembresia  WHERE  pago.fechadepago BETWEEN '$fechaInit' AND '$fechaFin'  ORDER BY fpago ASC";

$query = mysqli_query($conexion, $innerjoinventas);
//print_r($sqlTrabajadores);
$total = mysqli_num_rows($query);
echo '<strong>Total: </strong> (' . $total . ')';
?>

<table id="tableEmpleados" class="table table-striped table-bordered" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Membresia</th>
            <th>Fecha de pago</th>
            <th>C. meses</th>
            <th>Fecha de vencimiento</th>
            <th>total</th>
        </tr>
    </thead>
    <?php
    $i = 1;
    while ($row_venta = mysqli_fetch_array($query)) { ?>
        <?php
        $suma += $row_venta['total']
            ?>
        <tr>
            <td>
                <?= $row_venta['personanombre']; ?>
            </td>

            <td>
                <?= $row_venta['nombremembresia'] . ' - Q' . $row_venta['precio']; ?>
            </td>

            <td>
                <?= $row_venta['fpago']; ?>
            </td>

            <td>
                <?= $row_venta['mesesapagar']; ?>
            </td>

            <td>
                <?= $row_venta['fechavencimiento']; ?>
            </td>

            <td>
                <?= $row_venta['total']; ?>
            </td>

        </tr>
    <?php } ?>


</table>
<?php
echo '<h1 style="color:red">El total de membresias en el rango dado es de:  (' . "Q" . $suma . ')</h1>';
?>