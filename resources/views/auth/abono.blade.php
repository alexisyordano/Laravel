@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center font-weight-bolder">
                <h3 class="font-weight-bold">Abono de inversion</h3>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.upAbono') }}" method="POST">
        @csrf
        <input type="hidden" value="{{ $id_line }}" name="id_line">
        <input type="hidden" value="{{ $id }}" name="id_transaction">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Monto a abonar:</strong>
                    <input type="number" name="m_abono" step="any" class="form-control" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-danger" href="" data-dismiss="modal"> Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </form>
@endsection