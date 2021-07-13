<div class="modal fade" id="saveChangesModal" role="dialog" aria-labelledby="saveChangesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="saveChangesModalLabel">
                @if($title)
                  {{$title}}
                @endif
            </h5>
         
        </div>
        <div class="modal-body">
          @if($message)
            {{$message}}
          @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button id="submit" type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
