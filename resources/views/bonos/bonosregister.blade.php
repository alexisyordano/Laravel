@extends('layouts.app')
<div id="wrapper">
    @section('content')
    @extends('layouts.nav')
    @extends('layouts.left')
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
                     <div class="col-md-5">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Registrar Bonos</h3>
								</div>
                                 <div class="panel-body">
                                        @if(session()->has('success'))
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <i class="fa fa-check-circle"></i> {{ session()->get('success') }}
                                            </div>
                                        @endif
                                       <form name="form" action="" method="post">
                                            @csrf
                                            <input type="text" name="name"  id="name" required class="form-control" placeholder="Nombre del bono">
                                            <br>
                                            <input type="number" name="days"  id="days" required class="form-control" placeholder="Días">
                                            <br>
                                            <input type="number" name="interests"  id="interests" required class="form-control" placeholder="Interese">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                                        </form>
                                    </div>
								</div>
							</div>
							<!-- END INPUTS -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
    @extends('layouts.footer')
</div>
@endsection