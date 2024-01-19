<?php
require '../modelo/conexion.php';
$sqlcargo = "SELECT idcargo, nombre FROM cargo";
$cargos = $conexion->query($sqlcargo);
?>
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModallLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="editarModalLabel">Editar Empleado</h5>
            </div>
            <div class="modal-body">
                <form action="actualizarpersona.php" method="post">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono:</label>
                        <input type="number" name="telefono" id="telefono" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">direccion:</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="text" name="correo" id="correo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="cargo">Cargo:</label>
                        <select name="cargo" id="cargo" class="form-select">
                            <option value="">selecion..</option>
                            <?php while ($row_Cargos = $cargos->fetch_assoc()) { ?>
                                <option value="<?php echo $row_Cargos["idcargo"] ?>">
                                    <?= $row_Cargos["nombre"] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary" name="submit_tabla2"><i
                                class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$cargos->data_seek(0);
?>