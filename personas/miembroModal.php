<?php
require '../modelo/conexion.php';
$sqlmembresia = "SELECT idmembresia, nombre, precio FROM membresia";
$membresia = $conexion->query($sqlmembresia);
?>

<div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="nuevoModalLabel">Agregar miembro</h5>
            </div>
            <div class="modal-body">
                <form action="guardarmiembro.php" method="post">
                    <input type="hidden" id="idpersona" name="idpersona">
                    <input type="hidden" id="boolean" name="boolean" value="0">

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" name="telefono" id="telefono" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombreb" id="nombreb" class="form-control" required>
                    </div>


                    <div class="mb-3">
                        <label for="genero" class="form-label">Genero:</label>
                        <input type="text" name="generob" id="generob" class="form-control" required>
                    </div>

                    
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" name="direccionb" id="direccionb" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="text" name="correob" id="correob" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="number" name="edadb" id="edadb" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="peso" class="form-label">Peso:</label>
                        <input type="number" name="pesob" step="any" id="pesob" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="altura" class="form-label">Altura:</label>
                        <input type="number" step="any" name="alturab" id="alturab" class="form-control" required>
                    </div>





                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha inicio:</label>
                        <input type="date" name="fechab" id="fechab" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="membresia" class="form-label">Membresia:</label>
                        <select name="membresia" id="membresia" class="form-select">
                            <option value="">selecion..</option>
                            <?php while ($row_membresia = $membresia->fetch_assoc()) { ?>
                            <option value="<?php echo $row_membresia["idmembresia"] ?>">
                                <?= $row_membresia["nombre"] . "-" . $row_membresia["precio"] ?>
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
$membresia->data_seek(0);
?>
<!-- modal actualizar -->
<div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="actualizarModalLabel">Actualizar miembro</h5>
            </div>
            <div class="modal-body">
                <form action="actualizarmiembro.php" method="post">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="number" name="edad" id="edad" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="peso" class="form-label">Peso:</label>
                        <input type="number" name="peso" step="any" id="peso" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="altura" class="form-label">Altura:</label>
                        <input type="number" step="any" name="altura" id="altura" class="form-control" required>
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
                        <label for="fecha" class="form-label">Fecha inicio:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="membresia" class="form-label">Membresia:</label>
                        <select name="membresia" id="membresia" class="form-select">
                            <option value="">selecion..</option>
                            <?php while ($row_membresia = $membresia->fetch_assoc()) { ?>
                            <option value="<?php echo $row_membresia["idmembresia"] ?>">
                                <?= $row_membresia["nombre"] . "-" . $row_membresia["precio"] ?>
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
                <form action="eliminarmiembro.php" method="post">

                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>

        </div>
    </div>

</div>


