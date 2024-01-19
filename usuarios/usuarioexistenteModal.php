<?php
require '../modelo/conexion.php';
$sqlcategoria = "SELECT idcargo, nombre FROM cargo";
$categoria = $conexion->query($sqlcategoria);
?>


<div class="modal fade" id="existente" tabindex="-1" role="dialog" aria-labelledby="existenteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="existenteLabel">Agregar empleado</h5>
            </div>
            <div class="modal-body">
                <form action="Guardar2.php" method="post">
                    <input type="hidden" id="idpersona" name="idpersona">

                    <div class="mb-3">
                        <label for="telefonopersona" class="form-label">Teléfono:</label>
                        <input type="number" name="telefonopersona" step="any" id="telefonopersona" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombrep" class="form-label">Nombre:</label>
                        <input type="text" name="nombrep" id="nombrep" class="form-control" disabled required>
                    </div>

                    <div class="mb-3">
                        <label for="correop" class="form-label">Correo:</label>
                        <input type="text" name="correop" id="correop" class="form-control" disabled required>
                    </div>

                    <div class="mb-3">
                        <label for="direccionp" class="form-label">Dirección:</label>
                        <input type="text" name="direccionp" id="direccionp" class="form-control" disabled required>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Cargo:</label>
                        <select name="categoria" id="categoria" class="form-select">
                            <option value="">selecion..</option>
                            <?php while ($row_categoria = $categoria->fetch_assoc()) { ?>
                                <option value="<?php echo $row_categoria["idcargo"] ?>">
                                    <?= $row_categoria["nombre"] ?>
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

$categoria->data_seek(0);
?>