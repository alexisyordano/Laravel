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
												<th>Usuario</th>
												<th>Linea</th>
												<th>Opciones</th>
											</tr>											
										</thead>
										<tbody>										
											@foreach($list as $lineas)
											<form action="" method="post">
											@csrf
											<tr>												
													<input type="hidden" value="{{ $lineas->id_sol }}" name="id_sol">
													<th>{{ $lineas->name }}</th>
													<th><input type="text" value="{{ $lineas->concepto }}" name="monto"></th>
													<th>
														<input type="submit" class="btn btn-success" value="Desbloquear" name="Desbloquear">
														<input type="submit" class="btn btn-danger" value="Bloquear" name="Bloquear">
													</th>		
											</tr>		
											</form>								
											@endforeach											
										</tbody>
									</table>
								
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
<!-- <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
    	$('#table').dataTable();
    } );
</script>  -->
@endsection