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
									<h3 class="panel-title">Listar Usuarios</h3>
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
									<table id="table" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Email</th>
                                                <th>Télefono</th>
                                                <th>País</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($inv as $fila)
											<tr>
												<td>{{ $fila->name }}</td>
                                                <td>{{ $fila->email }}</td>
                                                <td>{{ $fila->telefono }}</td>
                                                <td>{{ $fila->pais }}</td>
												<td>
                                                    <a  class="btn btn-danger" href="{{ route('registers.deletepre', $fila->id_registro) }}" title="Eliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                        Eliminar
                                                    </a>
											    </td>
											</tr>
                                        @endforeach 
										</tbody>
									</table>
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
    $(document).ready(function() {
    	$('#table').dataTable();
    } );
</script> 
@endsection


