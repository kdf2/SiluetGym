<!-- Modal productos-->

<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="editarModalLabel">editar categoria</h5>
            </div>
            <div class="modal-body">
                <form action="actualizap.php" method="post">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal gastos-->

<div class="modal fade" id="editarModalgastos" tabindex="-1" role="dialog" aria-labelledby="editarModalgastosLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="editarModalgastoslLabel">Editar tipo de gasto</h5>
            </div>
            <div class="modal-body">
                <form action="actualizag.php" method="post">
                <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal gargos-->

<div class="modal fade" id="editarModalgargos" tabindex="-1" role="dialog" aria-labelledby="editarModalgargosLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="editarModalgargosLabel">Editar cargo</h5>
            </div>
            <div class="modal-body">
                <form action="actulizarcargos.php" method="post">
                <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

