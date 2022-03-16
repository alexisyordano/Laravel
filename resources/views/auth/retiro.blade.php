@extends('layouts.app')
<div id="wrapper">
    @section('content')
    @extends('layouts.nav')
    @extends('layouts.left')
    <div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="col-md-6">
						<div class="panel" style="text-align:center;">
							<div class="panel-heading">
								<h3>Retiro de Inversion</h3>
							</div>
							<div class="panel-body">
								@if(session()->has('success'))
									<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<i class="fa fa-check-circle"></i> {{ session()->get('success') }}
									</div>
								@endif
								<form action="" method="post">
									@csrf
									<input type="hidden" value="{{ auth()->id() }}" name="id_user" id="id_user">
									<input type="hidden" name="concepto" value="Retiro" id="concepto">
									<input type="number" name="monto"  id="monto" required class="form-control" placeholder="Monto a retirar">
									<br>
									<select class="form-control" name="id_inv" required>
										<option value="">-- Seleccione una inversion</option>		
										@foreach($inversiones as $inversion)	
											<option value="{{ $inversion->id_transaction }}">{{ $inversion->id_transaction }}</option>
										@endforeach							
									</select>
									<br>
									<input type="hidden" name="tipo" id="tipo" value="R">
									<button type="submit" class="btn btn-success btn-lg btn-block">Guardar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
    @extends('layouts.footer')
</div>
@endsection