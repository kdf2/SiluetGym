<div class="modal fade" id="eliminaModalg" tabindex="-1" role="dialog" aria-labelledby="eliminaModalgLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="eliminaModalgLabel">Aviso</h5>
            </div>
            <div class="modal-body">
                ¿Desea eliminar la membresia?
            </div>
            <div class="modal-footer">
                <form action="eliminarmembresia.php" method="post">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-primary"><i
                            class="fa-solid fa-trash"></i>&nbsp;Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
