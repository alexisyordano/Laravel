@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center font-weight-bolder">
                <h2 class="font-weight-bold">Editar Usuario</h2>
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

    <form action="{{ route('registers.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="name"  value="{{ $user->name }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Correo:</strong>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Teléfono:</strong>
                    <input type="text" name="telefono" value="{{ $user->telefono }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de nacimiento:</strong>
                    <input type="text" name="fecha_n" class="form-control" value="{{ $user->fecha_nacimiento }}" placeholder="Fecha de Nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nacionalidad:</strong>
                    <input type="text" name="nacionalidad" value="{{ $user->nacionalidad }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>País:</strong>
                    <input type="text" name="pais" value="{{ $user->pais }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Referido:</strong>
                    <input type="text" name="nombre_referido" value="{{ $user->nombre_referido }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha del primer pago:</strong>
                    <input type="text" name="f_primer_pago" class="form-control" value="{{ $user->f_primer_pago }}" placeholder="Fecha de Nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Monto:</strong>
                    <input type="text" name="monto" value="{{ $user->monto }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Identificador:</strong>
                    <input type="text" name="identificador" value="{{ $user->identificador }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre del Banco:</strong>
                    <input type="text" name="name_banco" value="{{ $user->name_banco }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipo de cuenta:</strong>
                    <input type="text" name="tipo_cuenta" value="{{ $user->tipo_cuenta }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Titular:</strong>
                    <input type="text" name="titular" value="{{ $user->titular }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Número de la cuenta:</strong>
                    <input type="text" name="numero" value="{{ $user->numero }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Número de la Referencia Primer pago:</strong>
                    <input type="text" name="code_transaction" value="{{ $user->code_transaction }}" class="form-control">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-primary" href="" data-dismiss="modal"> Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>

    </form>
@endsection
