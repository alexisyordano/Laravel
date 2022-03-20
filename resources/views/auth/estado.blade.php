@extends('layouts.app')
<div id="wrapper">
    @section('content')
    @extends('layouts.nav')
    @extends('layouts.left')
    <div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="col-md-12">
						@if(session()->has('success'))
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<i class="fa fa-check-circle"></i> {{ session()->get('success') }}
							</div>
						@endif
						<!-- TABLE HOVER -->
						<div class="panel">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3">
										<h3 class="panel-title">Ultimos movimientos</h3>
									</div>
									<!-- <div class="col-md-3">
										<select class="form-control" name="id_inv" require>
											<option value="">-- Seleccione una inversion</option>		
											@foreach($inversiones as $inversion)	
												<option value="{{ $inversion->id_solicitud }}">{{ $inversion->id_solicitud }}</option>
											@endforeach							
										</select>
									</div>									 -->
								</div>
							</div>
							<div class="panel-body">
								<form action="" method="post">
									@csrf
									<table id="table" class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Usuario</th>
												<th>Solicitud</th>
												<th>Concepto</th>											
												<th>Dias</th>
												<th>Monto</th>
												<th>%</th>
												<th>Intereses</th>
												<th>Saldo</th>
												<th>Fecha</th>
											</tr>
										</thead>
										<tbody>
											@foreach($transacciones as $transaccion)
												<tr>
													<th></th>
													<th>{{ $transaccion->name }}</th>
													<th>{{ $transaccion->id_solicitud }}</th>
													<th>{{ $transaccion->concepto }}</th>
													<th>{{ $transaccion->dias }}</th>
													<th>{{ $transaccion->monto }}</th>
													<th>{{ $transaccion->p_intereses }}</th>
													<th>{{ $transaccion->m_intereses }}</th>
													<th>{{ $transaccion->saldo }}</th>
													<th>{{ $transaccion->date_mov }}</th>
												</tr>
											@endforeach
										</tbody>
									</table>
								</form>
							</div>
						</div>
						<!-- END TABLE HOVER -->
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
    @extends('layouts.footer')
</div>
@endsection