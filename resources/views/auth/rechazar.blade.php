{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('transactions.reject') }}" method="post">
    <div class="modal-body">
        @csrf
        
        <h5 class="text-center">Estas seguro de aprobar esta solicitud ?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Borrar</button>
    </div>
</form>