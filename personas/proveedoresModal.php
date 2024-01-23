<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
<div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="nuevoModalLabel">Agregar proveedor</h5>
            </div>
            <div class="modal-body">
                <form action="guardarproveedore.php" method="post">
                    <input type="hidden" id="idpersona" name="idpersona" >
                    <input type="hidden" id="boolean" name="boolean" value="0" >
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono:</label>
                        <input type="number"  name="telefono" id="telefono" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del encargado:</label>
                        <input type="text" maxlength="8" name="nombreb" id="nombreb" class="form-control"  required>
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label">Genero:</label>
                        <input type="text" name="generob" id="generob" class="form-control"  required>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">direccion:</label>
                        <input type="text" name="direccionb" id="direccionb" class="form-control"  required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="text" name="correob" id="correob" class="form-control"   required>
                    </div>



                    <div class="mb-3">
                        <label for="nombree" class="form-label">Nombre de la empresa:</label>
                        <input type="text" name="nombree" id="nombree" class="form-control" required>
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



<div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="actualizarModalLabel">Actualizar proveedor</h5>
            </div>
            <div class="modal-body">
                <form action="actualizarproveedor.php" method="post">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="nombree" class="form-label">Nombre de la empresa:</label>
                        <input type="text" name="nombree" id="nombree" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del encargado:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="genero" class="form-label">Genero:</label>
                        <input type="text" name="genero" id="genero" class="form-control" required>
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
                <form action="elimnaproveedor.php" method="post">

                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- persona existente  -->

<div class="modal fade" id="existente" tabindex="-1" role="dialog" aria-labelledby="existenteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="existenteLabel">Agregar proveedor</h5>
            </div>
            <div class="modal-body">
                <form action="guardarnuevopro.php" method="post">
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
                        <label for="nombree" class="form-label">Nombre de la empresa:</label>
                        <input type="text" name="nombree" id="nombree" class="form-control" required>
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