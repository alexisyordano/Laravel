@extends('layouts.app')
<div id="wrapper">
    @section('content')
    @extends('layouts.nav')
    @extends('layouts.left')
    <div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                     <!-- INPUTS -->
                     <div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Agregar Datos</h3>
								</div>
                                 <div class="panel-body">
                                        @if(session()->has('success'))
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <i class="fa fa-check-circle"></i> {{ session()->get('success') }}
                                            </div>
                                        @endif
                                       <form name="form" action="{{route("registers.InsertAdd")}}" method="post">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="modalidad" id="modalidad" required>
                                                            <option value="">-- Selecione una modalidad --</option>
                                                            @foreach($bonos as $bono)
                                                                <option value="{{ $bono['id_bono'] }}">{{ $bono['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                    </div>

                                                    <input type="hidden" name="id" id="id" value="{{ $id }}">

                                                    <div class="col-md-6">
                                                        <input type="text" name="monto" required id="monto" class="form-control" placeholder="Monto en $">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="n_banco"  id="n_banco" class="form-control" placeholder="Nombre del Banco">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="t_cuenta"  id="t_cuenta" class="form-control" placeholder="Tipo de cuenta">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="anombre"  id="anombre" class="form-control" placeholder="A Nombre de">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="ncuenta"  id="ncuenta" class="form-control" placeholder="Numero de Cuenta">
                                                        <br>
                                                    </div> 

                                                    <input type="hidden" name="dias" id="dias">
                                                    <input type="hidden" name="p_intereses" id="p_intereses">
                                                    
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
								</div>
							</div>
				       </div>
			     </div>
			<!-- END MAIN CONTENT -->
                <script type="text/javascript">
                    $('#modalidad').on('change', function(e)
                    {
                        var id = e.target.value;
                        $.get('{{ url("/") }}/select/'+id, function(data){
                            var dia = $.parseJSON(data);
                            $('#dias').val(dia.days);
                            $('#p_intereses').val(dia.interests); 
                        });
                    });
                </script>
		</div>
		<!-- END MAIN -->
    @extends('layouts.footer')
</div>
@endsection

