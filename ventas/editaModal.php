<!-- Modal edita registro -->
<div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="actualizarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="actualizarModalLabel">Editar registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="actualizarproducto.php" method="post">
                    <input type="hidden" id="id" name="id">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input autofocus type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca:</label>
                        <input autofocus type="text" name="marca" id="marca" class="form-control" required>
                    </div>


                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria del producto:</label>
                        <select name="categoria" id="categoria" class="form-select">
                            <option value="">selecion..</option>
                            <?php while ($row_categoria = $categoria->fetch_assoc()) { ?>
                                <option value="<?php echo $row_categoria["idcategoriaproduct"] ?>">
                                    <?= $row_categoria["nombre"] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="proveedor" class="form-label">proveedor:</label>
                        <select name="proveedor" id="proveedor" class="form-select">
                            <option value="">selecion..</option>
                            <?php while ($row_categoria = $proveedor->fetch_assoc()) { ?>
                                <option value="<?php echo $row_categoria["idproveedor"] ?>">
                                    <?= $row_categoria["nombredelaempresa"] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" name="cantidad" step="any" id="cantidad" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="preciop" class="form-label">Precio compra:</label>
                        <input type="number" name="preciop" step="any" id="preciop" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio de venta:</label>
                        <input type="number" name="precio" step="any" id="precio" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha de compra:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary" ><i
                                class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>