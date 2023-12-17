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
$suma=0;

$innerjoingasto = "SELECT usuario.idusuario,
categoria.idcategoria, categoria.nombre as nombre_cateogoria,
gasto.idgasto, gasto.cantidad,	gasto.fecha, gasto.usuario_idusuario, gasto.categoria_idcategoria, gasto.Nombrepersona
FROM gasto
INNER JOIN usuario ON gasto.usuario_idusuario= usuario.idusuario
INNER JOIN categoria ON gasto.categoria_idcategoria=categoria.idcategoria  WHERE  `fecha` BETWEEN '$fechaInit' AND '$fechaFin' ORDER BY fecha ASC";
$query = mysqli_query($conexion, $innerjoingasto);
//print_r($sqlTrabajadores);
$total = mysqli_num_rows($query);
echo '<strong>Total: </strong> (' . $total . ')';
?>

<table id="tableEmpleados" class="table table-striped table-bordered" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>nombre</th>
            <th>fecha</th>
            <th>categoria</th>
            <th>cantidad</th>
        </tr>
    </thead>
    <?php
    $i = 1;
    while ($row_gasto = mysqli_fetch_array($query)) { ?>
    <?php
         $suma+=$row_gasto['cantidad']
    ?>
        <tr>
            <td>
                <?= $row_gasto['Nombrepersona']; ?>
            </td>


            <td>
                <?= $row_gasto['fecha']; ?>
            </td>

            <td>
                <?= $row_gasto['nombre_cateogoria']; ?>
            </td>

            <td>
                <?= $row_gasto['cantidad']; ?>
            </td>
        </tr>
    <?php } ?>


</table>
<?php
echo '<strong>el total que se gasto en el rango dado es de: </strong> (' ."Q".$suma . ')';
?>