{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('registers.destroy', $user->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Estas seguro de Eliminar el {{ $user->name }} ?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Borrar</button>
    </div>
</form>