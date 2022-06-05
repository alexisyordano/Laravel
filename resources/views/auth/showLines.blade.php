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
							<div class="table-responsive">																	
								<table id="table" class="table table-striped">
									<thead>
										<tr>
											<th>Usuario</th>
											<th>Linea</th>
											<th>Opciones</th>
										</tr>											
									</thead>
									<tbody>	
									    <form action="" method="post">
										@foreach($list as $lineas)
										@csrf
										<tr>												
											<input type="hidden" value="{{ $lineas->id_line }}" name="id_line">
											<th>{{ $lineas->name }}</th>
											<th>{{ $lineas->b_name }}</th>
											<th>
												@if($lineas->block == 1)
													<a  class="btn btn-success" href="{{ route('transactions.unblock', $lineas->id_line) }}" title="Desbloquear">
													<i class="fa fa-trash-o"></i>
														Desbloquear
													</a>
												@elseif($lineas->block == 0)
													<a  class="btn btn-danger" href="{{ route('transactions.block', $lineas->id_line) }}" title="Bloquear">
													<i class="fa fa-trash-o"></i>
														Bloquear
													</a>
												@endif
											</th>		
										</tr>
										@endforeach	
										</form>	
									</tbody>
								</table>
                              </div>								
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