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
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Lista de Inversores</h3>
								</div>
								<div class="panel-body">
                                   <div id="resp"></div>
                                    @if(session()->has('success'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <i class="fa fa-check-circle"></i> {{ session()->get('success') }}
                                        </div>
                                    @endif

                                    <div id="refres">
									<form name="form" action="{{route("registers.store")}}" method="post">
									@csrf	
									<div class="table-responsive">
									<table id="table" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Identificador</th>
												<th>Email</th>
                                                <th>Télefono</th>
                                                <th>País</th>
												<th>Modalidad</th>
												<th>Fecha del primer pago</th>
												<th>Monto</th>
												<th>Nombre del Banco</th>
												<th>Tipo de cuenta</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										@foreach($inv as $fila)
											@if($fila->creado == 0)
											<tr>
												<input type="hidden" name="nacion" value="<?= $fila->nacionalidad ?>">
												<input type="hidden" name="fecha_n" value="<?= $fila->fecha_nacimiento ?>">
												<input type="hidden" name="nombre_r" value="<?= $fila->nombre_r ?>">
												<input type="hidden" name="anombre" value="<?= $fila->anombre ?>">
												<input type="hidden" name="ncuenta" value="<?= $fila->ncuenta ?>">
												<td><input name="name" type="text" readonly value="<?= $fila->name ?>"</td>
												<td><input name="identificador" type="text" readonly value="<?= $fila->identificador ?>"</td>
												<td><input name="email" type="text" readonly value="<?= $fila->email ?>"</td>
												<td><input name="tele" type="text" readonly value="<?= $fila->telefono ?>"</td>
												<td><input name="pais_i" type="text" readonly value="<?= $fila->pais ?>"</td>
												<td><input name="modalidad" type="text" readonly value="<?= $fila->modalidad ?>"</td>
												<td><input name="fecha_primer_pago" type="text" readonly value="<?= $fila->fecha_primer_pago ?>"</td>
												<td><input name="monto" type="text" readonly value="<?= $fila->monto ?>"</td>
												<td><input name="n_banco" type="text" readonly value="<?= $fila->n_banco ?>"</td>
												<td><input name="t_cuenta" type="text" readonly value="<?= $fila->t_cuenta ?>"</td>
												<td>
												<a  class="btn btn-danger" href="{{ route('registers.deletepre', $fila->id_registro) }}" title="Eliminar">
												<i class="fa fa-trash-o"></i>
													Eliminar
												</a>
												<hr> 
												<button type="submit" class="btn btn-info" title="Aprobar">
												<i class="fa fa-check"></i>
													Aprobar
												</button>
												</td>
											 @endif
											</tr>
										@endforeach 
										</tbody>
									</table>
                                 </div>
                                </div>
                              </div>
							</div>
                        </div>
						<!-- END TABLE STRIPED -->
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


