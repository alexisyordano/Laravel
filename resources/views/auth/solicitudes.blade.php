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
								<h3 class="panel-title">Solicitudes pendientes</h3>
							</div>
							<div class="panel-body">
								
									
									<table id="table" class="table table-striped">
										<thead>
											<tr>
												<!-- <th>#</th> -->
												<th>Usuario</th>
												<th>Monto</th>
												<th>Concepto</th>
												<!-- <th>Intereses</th>
												<th>Dias</th> -->
												<th>Fecha</th>
												<th>Opciones</th>
											</tr>											
										</thead>
										<tbody>										
											@foreach($solicitudes as $solicitud)
											<form action="" method="post">
											@csrf
											<tr>												
													<input type="hidden" value="{{ $solicitud->id_sol }}" name="id_sol">
													<th>{{ $solicitud->name }}</th>
													<th><input type="text" value="{{ $solicitud->monto }}" name="monto"></th>
													<th>{{ $solicitud->concepto }}</th>
													<th>{{ $solicitud->created_at }}</th>
													<th>
														<input type="submit" class="btn btn-success" value="Aprobar" name="Aprobar">
														<input type="submit" class="btn btn-danger" value="Rechazar" name="Rechazar">
													</th>		
											</tr>		
											</form>								
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
<!-- <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
    	$('#table').dataTable();
    } );
</script>  -->
@endsection