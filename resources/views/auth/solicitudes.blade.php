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
								<h3 class="panel-title">Ultimos movimientos</h3>
							</div>
							<div class="panel-body">
								<form action="" method="post">
									@csrf
									<table id="table" class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Usuario</th>
												<th>Monto</th>
												<th>Concepto</th>
												<th>Fecha</th>
												<th>Opciones</th>
											</tr>
										</thead>
										<tbody>
											@foreach($solicitudes as $solicitud)
											<tr>																								
												<td>{{ $solicitud->id }}</td>
												<input type="hidden" value="{{ $solicitud->id }}" name="id_op">
												<td>{{ $solicitud->id_user }}</td>
												<input type="hidden" value="{{ $solicitud->id_user }}" name="id_user">
												<td>{{ $solicitud->monto }}</td>
												<input type="hidden" value="{{ $solicitud->monto }}" name="monto">
												<td>{{ $solicitud->concepto }}</td>
												<input type="hidden" value="{{ $solicitud->concepto }}" name="concepto">
												<td>{{ $solicitud->created_at }}</td>
												<td>
													<input type="submit" class="btn btn-success" name="Aprobar" title="Aprobar" value="Aprobar">		
													<input type="submit" class="btn btn-danger" name="Rechazar" title="Rechazar" value="Rechazar">																								
												</td>
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