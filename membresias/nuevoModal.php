<div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nuevoModalTitle">Nueva membresia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="guarda.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" name="precio" id="precio" class="form-control" required>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
             </div>

             <div class="">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                 <button type="submit" class="btn btn-primary">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
             </div>
        </form>

      </div>
    </div>
  </div>
</div>

