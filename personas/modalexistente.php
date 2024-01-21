<!-- persona existente  -->
<?php
require '../modelo/conexion.php';
$sqlmembresia = "SELECT idmembresia, nombre, precio FROM membresia";
$membresia = $conexion->query($sqlmembresia);
?>
<div class="modal fade" id="existente" tabindex="-1" role="dialog" aria-labelledby="existenteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="existenteLabel">Agregar proveedor</h5>
            </div>
            <div class="modal-body">
                <form action="guardarexistente.php" method="post">
                    <input type="hidden" id="idpersona" name="idpersona">

                    <div class="mb-3">
                        <label for="telefonobuscar" class="form-label">Telèfono:</label>
                        <input type="number" name="telefonobuscar" id="telefonobuscar" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del encargado:</label>
                        <input type="text" name="nombreb" id="nombreb" class="form-control" disabled required>
                    </div>

                    <div class="mb-3">
                        <label for="correob" class="form-label">Correo:</label>
                        <input type="text" name="correob" id="correob" class="form-control" disabled required>
                    </div>

                    <div class="mb-3">
                        <label for="direccionb" class="form-label">Dirección:</label>
                        <input type="text" name="direccionb" id="direccionb" class="form-control" disabled required>
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