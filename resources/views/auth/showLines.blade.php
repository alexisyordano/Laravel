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
											<input type="hidden" value="{{ $lineas->id_line }}" name="id_line">
											<th>{{ $lineas->name }}</th>
											<th>{{ $lineas->b_name }}</th>
											<th>
												@if($lineas->block == 1)
													<input type="submit" class="btn btn-success" value="Desbloquear" name="Desbloquear">
												@elseif($lineas->block == 0)
													<input type="submit" class="btn btn-danger" value="Bloquear" name="Bloquear">
												@endif
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
<script type="text/javascript" charset="utf-8">
   var table = $('#table').DataTable({
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
      },
   });
</script> 
@endsection