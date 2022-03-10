@extends('layouts.app')
<div id="wrapper">
    @section('content')
    @extends('layouts.nav')
    @extends('layouts.left')
    <div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                     <!-- INPUTS -->
                     <div class="col-md-5">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Registrar Usuarios</h3>
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
                                            <input type="text" name="name"  id="name" required class="form-control" placeholder="Nombre">
                                            <br>
                                            <input type="email" name="email" id="email" required class="form-control" placeholder="Email">
                                            <br>
                                            <input type="password" name="password" required id="password" class="form-control" placeholder="Clave">
                                            <br>
                                            <input type="password" required name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Repetir Clave">
                                            <br>
                                            <select class="form-control" name="rol" required>
                                                <option value="">-- Selecione un Rol --</option>
                                                @foreach($role as $rol)
                                                    <option value={{ $rol['id_role'] }}>{{ $rol['name_role'] }}</option>
                                                @endforeach
                                            </select>
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