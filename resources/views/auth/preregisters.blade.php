<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <div class="main">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                     <!-- INPUTS -->
                     <div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Formulario de Registro</h3>
								</div>
                                 <div class="panel-body">
                                        @if(session()->has('success'))
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <i class="fa fa-check-circle"></i> {{ session()->get('success') }}
                                            </div>
                                        @endif
                                       <form name="form" action="{{route("registers.InsertRegister")}}" method="post">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="name"  id="name" required class="form-control" placeholder="Nombre y Apellido">
                                                        <br>
                                                    </div> 
                                                    
                                                    <div class="col-md-6">
                                                        <input type="email" name="email" id="email" required class="form-control" placeholder="Email">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="tele" id="tele" required class="form-control" placeholder="Télefono">
                                                        <br>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input type="text" name="pais" id="pais" required class="form-control" placeholder="Nacionalidad">
                                                        <br>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
								</div>
							</div>
                        </div>
			      </div>
		     </div>
         </div>


