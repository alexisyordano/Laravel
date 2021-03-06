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
								</div>
							</div>
							<div class="panel-body">
									<table id="table" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th><h5>Ciclo</h5></th>
												<th><h5>Fecha de Ingreso</h5></th>
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
										<tbody>
											@foreach($transacciones as $transaccion)
												<tr>
												<th>{{ $transaccion->cicle }}</th>
												<th>{{ $newDate = date("d-m-Y", strtotime($transaccion->date_mov)); }}</th>
												<th>{{ $newDate = date("d-m-Y", strtotime($transaccion->date_sistema)); }}</th>
												<th>@if($transaccion->id_solicitud == 0)
														{{ $transaccion->b_name }}
													@endif
													@if($transaccion->id_solicitud <> 0)
														{{ $transaccion->concepto }}
													@endif
												</th>
												<th>{{ $newDate = date("d-m-Y", strtotime($transaccion->date_close)); }}</th>
												<th>{{ $newDate = date("d-m-Y", strtotime($transaccion->date_pay)); }}</th>
												<th>{{ $valor =  number_format($transaccion->monto, 2, ',', '.') }}$</th>
												<th>{{ $valor =  number_format($transaccion->m_intereses, 2, ',', '.') }}$</th>
												<th>{{ $valor =  number_format($transaccion->saldo, 2, ',', '.') }}$</th>
												<th>
													<?php $date = date('Y-m-d');  ?>
													@if($date >= $transaccion->date_sistema && $date <= $transaccion->date_close && $transaccion->solicitud == 0)
													<a  class="btn btn-info btn-xs" id="BtnReinvetir" href="{{ route('transactions.reinvertir', $transaccion->id) }}" title="Reinvertir">
                                                        RI
                                                    </a>
													<a  class="btn btn-success btn-xs" data-toggle="modal" id="BtnAbono" data-target="#ModalAbono" data-attr="{{ route('transactions.abono', $transaccion->id) }}" title="Abonar">
                                                        A
                                                    </a>
													<a  class="btn btn-primary btn-xs" data-toggle="modal" id="BtnRetiro" data-target="#ModalRetiro" data-attr="{{ route('transactions.retiro', $transaccion->id) }}" title="Retirar">
                                                        R
                                                    </a>
													@endif
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
<!-- ModalAbono -->
<div class="modal fade" id="ModalAbono" tabindex="-1" role="dialog" aria-labelledby="LabelModalAbono" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body" id="BodyModalAbono">
				<div>
					<!-- the result to be displayed apply here -->
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	// display ModalAbono
	$(document).on('click', '#BtnAbono', function(event) {
		event.preventDefault();
		let href = $(this).attr('data-attr');
		$.ajax({
			url: href,
			beforeSend: function() {
				$('#loader').show();
			},
			// return the result
			success: function(result) {
				$('#ModalAbono').modal("show");
				$('#BodyModalAbono').html(result).show();
			},
			complete: function() {
				$('#loader').hide();
			},
			error: function(jqXHR, testStatus, error) {
				console.log(error);
				//alert("Page " + href + " cannot open. Error:" + error);
				$('#loader').hide();
			},
			timeout: 8000
		})
	});
    </script>

<!-- ModalRetiro -->
<div class="modal fade" id="ModalRetiro" tabindex="-1" role="dialog" aria-labelledby="LabelModalRetiro" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body" id="BodyModalRetiro">
				<div>
					<!-- the result to be displayed apply here -->
				</div>
			</div>
		</div>
	</div>
</div>

<script>
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
<script>
	// display ModalRetiro
	$(document).on('click', '#BtnRetiro', function(event) {
		event.preventDefault();
		let href = $(this).attr('data-attr');
		$.ajax({
			url: href,
			beforeSend: function() {
				$('#loader').show();
			},
			// return the result
			success: function(result) {
				$('#ModalRetiro').modal("show");
				$('#BodyModalRetiro').html(result).show();
			},
			complete: function() {
				$('#loader').hide();
			},
			error: function(jqXHR, testStatus, error) {
				console.log(error);
				//alert("Page " + href + " cannot open. Error:" + error);
				$('#loader').hide();
			},
			timeout: 8000
		})
	});
    </script>
@endsection