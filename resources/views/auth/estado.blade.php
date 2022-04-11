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
									<div class="col-md-3">
										<input type="hidden" value="{{ auth()->id() }}" name="id_user" id="id_user">
										<select class="form-control" name="id_line" id="id_line" onchange="search()">
											<option value="">-- Seleccione una inversion</option>		
											@foreach($inversiones as $inversion)	
												<option value="{{ $inversion->id_bono }}">{{ $inversion->name }}</option>
												<?php $name = $inversion->name ?>
											@endforeach							
										</select>
									</div>									
								</div>
							</div>
							<div class="panel-body">
									<table id="table_s" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th><h5>Ciclo</h5></th>
												<th><h5>Fecha de deposito</h5></th>
												<th><h5>Entrada Sistema</h5></th>
												<th><h5>Modalidad</h5></th>										
												<th><h5>Fecha de cierre</h5></th>
												<th><h5>Fecha de pago</h5></th>
												<th><h5>Monto</h5></th>
												<th><h5>Ganancias</h5></th>	
												<th><h5>Total</h5></th>
												<th><h5>Opciones</h5></th>
											</tr>
										</thead>
										
									</table>
							</div>
						</div>
						<!-- END TABLE HOVER -->
						<script>
							// $(document).ready(function() {
							// 	$('#table').DataTable();
							// } );
						</script>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<script type="text/javascript" charset="utf-8">

			function search() {
				var id_bono = $('#id_line').val();
				var id_user = $("#id_user").val();


var dataset = [
	["1", "2022-04-07", "2022-04-12","1","2022-05-17","2022-05-20","4600","1380","5980","3"]
]


				$('#table_s').dataTable({
					// bDestroy: true,
					// processing: true,
                  	// serverSide: true,
					
						
					// ajax : {
					// 	type: 'GET',
						// url: "{{route('transactions.searchT')}}",
						data : dataset,
						// data : { 
						// 		'id_bono' : id_bono,
						// 		'id_user' : id_user,
						// 		},
						//dataSrc : "myData",
						columns: [
							{ data: "cicle"},
							{ data: "date_mov"},
							{ data: "date_sistema"},
							{ data: "id_bono"},
							{ data: "date_close"},
							{ data: "date_pay"},
							{ data: "monto"},
							{ data: "m_intereses"},
							{ data: "saldo"},
							{ data: "id"}
						],
					// },					
				});
				

			}
		</script> 
		<!-- END MAIN -->
    @extends('layouts.footer')
</div>
@endsection