<!-- Modal productos-->

<div class="modal fade" id="eliminaModal" tabindex="-1" role="dialog" aria-labelledby="eliminaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="eliminaModalLabel">Aviso</h5>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro?
            </div>
            <div class="modal-footer">
                <form action="eliminarp.php" method="post">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-primary"><i
                            class="fa-solid fa-trash"></i>&nbsp;Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal gastos-->


<div class="modal fade" id="eliminaModalg" tabindex="-1" role="dialog" aria-labelledby="eliminaModalgLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="eliminaModalgLabel">Aviso</h5>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro?
            </div>
            <div class="modal-footer">
                <form action="eliminargastos.php" method="post">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-primary"><i
                            class="fa-solid fa-trash"></i>&nbsp;Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="eliminarcargo" tabindex="-1" role="dialog" aria-labelledby="eliminarcargoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="eliminarcargoLabel">Aviso</h5>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro?
            </div>
            <div class="modal-footer">
                <form action="eliminarcargos.php" method="post">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-primary"><i
                            class="fa-solid fa-trash"></i>&nbsp;Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>


