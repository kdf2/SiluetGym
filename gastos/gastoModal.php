<?php
require '../modelo/conexion.php';
$sqlcategoria = "SELECT idcategoria, nombre FROM categoria";
$categoria = $conexion->query($sqlcategoria);
?>

<div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="nuevoModalLabel">Agregar gasto</h5>
            </div>
            <div class="modal-body">
                <form action="guardargasto.php" method="post">
                    <input type="hidden" id="id" name="id">

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" name="cantidad" step="any" id="cantidad" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha inicio:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria de gasto:</label>
                        <select name="categoria" id="categoria" class="form-select">
                            <option value="">selecion..</option>
                            <?php while ($row_categoria = $categoria->fetch_assoc()) { ?>
                                <option value="<?php echo $row_categoria["idcategoria"] ?>">
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
<!-- modal actualizar -->
<div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="actualizarModalLabel">Editar gasto</h5>
            </div>
            <div class="modal-body">
                <form action="actualizargasto.php" method="post">
                    <input type="hidden" id="id" name="id">
                    
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" name="cantidad" step="any" id="cantidad" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha inicio:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria de gasto:</label>
                        <select name="categoria" id="categoria" class="form-select">
                            <option value="">selecion..</option>
                            <?php while ($row_categoria = $categoria->fetch_assoc()) { ?>
                                <option value="<?php echo $row_categoria["idcategoria"] ?>">
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

<!-- Modal elimina registro -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="eliminaModalLabel">Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro?
            </div>

            <div class="modal-footer">
                <form action="eliminargasto.php" method="post">

                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>

        </div>
    </div>