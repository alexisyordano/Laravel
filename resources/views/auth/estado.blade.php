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
						<!-- TABLE HOVERfasfasf -->
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
									<table id="table" class="table table-hover">
										<thead>
											<tr>
												<th>Ciclo</th>
												<th>Fecha de deposito</th>
												<th>Entrada Sistema</th>
												<th>Modalidad</th>										
												<th>Fecha de cierre</th>
												<th>Fecha de pago</th>
												<th>Monto</th>
												<th>Ganancias</th>
												<th>Total</th>
												<th>Opciones</th>
											</tr>
										</thead>
										<tbody>
											@foreach($transacciones as $transaccion)
												<tr>
													<th></th>
													<th>{{ $transaccion->date_mov }}</th>
													<th>{{ $transaccion->date_sistema }}</th>
													<th>{{ $transaccion->concepto }}</th>
													<th>{{ $transaccion->date_close }}</th>
													<th>{{ $transaccion->date_pay }}</th>
													<th>{{ $transaccion->monto }}</th>
													<th>{{ $transaccion->m_intereses }}</th>
													<th>{{ $transaccion->saldo }}</th>
													<th>
														
														<button class="btn btn-xs btn-success"><a href="{{ route('transactions.inversion') }}" style="color: white;">RI</a></button>
														<button class="btn btn-xs btn-info"><a href="{{ route('transactions.abono') }}" style="color: white;">A</a></button>
														<button class="btn btn-xs btn-danger"><a href="{{ route('transactions.retiro') }}" style="color: white;">R</a></button>
													</th>
												</tr>
											@endforeach
										</tbody>
									</table>
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