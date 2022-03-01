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
									<table id="table" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Email</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($users as $user)
											<tr>
												<td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
												<td>
													<a class="btn btn-primary" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
														data-attr="{{ route('registers.edit', $user->id) }}">
														Actualizar
														<i class="fa fa-refresh"></i>
													</a>
													<button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</button>
													<button type="button" class="btn btn-warning"><i class="fa fa-warning"></i> Resetear clave</button>
											   </td>
											</tr>
                                        @endforeach 
										</tbody>
									</table>
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


    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        // display a modal (medium modal)
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
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


<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
    	$('#table').dataTable();
    } );
</script> 
@endsection


