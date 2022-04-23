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
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($users as $user)
											<tr>
												<td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
												<td>
													<a class="btn btn-primary btn-sm" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
														data-attr="{{ route('registers.edit', $user) }}" title="Actualizar">
														Actualizar
														<i class="fa fa-refresh"></i>
													</a>
                                                    <a  class="btn btn-danger" data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('registers.deleteusers', $user->id) }}" title="Eliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                        Eliminar
                                                    </a>
                                                    <a  class="btn btn-success btn-sm" data-toggle="modal" id="smallButtonPass" data-target="#smallModalPass" data-attr="{{ route('registers.password', $user) }}" title="Password">
                                                        <i class="fa fa-solid fa-lock"></i>
                                                        Cambiar clave
                                                    </a>
                                                    <a  class="btn btn-info btn-sm" href="{{route('registers.add', $user->id)}}" title="Agregar">
                                                        <i class="fa fa-solid fa-plus"></i>
                                                        Añadir
                                                    </a>
                                                    
                                                    @if($user->bloqueo == 0)
                                                        <button class="btn btn-warning btn-sm"  type="submit" id="{{$user->id}}"  value="{{route('registers.bloqueo', $user->id)}}">
                                                            <i class="fa fa-solid fa-lock"></i> Bloquear    
                                                        </button>
                                                    @endif

                                                    @if($user->bloqueo != 0)
                                                        <button class="btn btn-default btn-sm" type="submit" id="{{$user->id}}" value="{{route('registers.activar', $user->id)}}">
                                                            <i class="fa fa-solid fa-check"></i> Activar    
                                                        </button>
                                                    @endif
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


    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- small modal -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body" id="smallBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
        </div>
    </div>
</div>

   <!-- small modal Pass -->
   <div class="modal fade" id="smallModalPass" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="smallBodyPass">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
$("button").click(function(){

    var id = ($(this).val());
    $.ajax({
        type: "GET",
        url: id,
        //data: value,
        success: function(data) {
            $("#refres").load(window.location.href + " #refres" );
            $('#resp').html(data);           
        }
    });
})
</script>

<script>

$("button").click(function(){
   var id = ($(this).val());
   $.ajax({
        type: "GET",
        url: id,
        //data: value,
        success: function(data) {
            $("#refres").load(window.location.href + " #refres" );
            $('#resp').html(data);           
        }
    });
});

</script>

<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href
            , beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            }
            , complete: function() {
                $('#loader').hide();
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            }
            , timeout: 8000
        })
    });

</script>


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

    <script>
        // display a modal (modal password)
        $(document).on('click', '#smallButtonPass', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModalPass').modal("show");
                    $('#smallBodyPass').html(result).show();
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


