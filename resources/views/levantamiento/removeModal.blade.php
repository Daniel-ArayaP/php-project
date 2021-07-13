  <div class="modal fade" id="saveChangesModal" role="dialog" aria-labelledby="saveChangesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="saveChangesModalLabel">Eliminar</h5>
         
        </div>
        <div class="modal-body">
            ¿Está seguro que desea eliminar este curso del plan de estudios?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
