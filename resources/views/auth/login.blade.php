@extends('layouts.app')
<!-- WRAPPER -->
@section('content')
<!-- WRAPPER -->
<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								@error('message')
								<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<i class="fa fa-times-circle"></i> Usuario o clave incorrectas
									</div>
								@enderror
								@error('messageBloqueo')
								<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<i class="fa fa-times-circle"></i> Usuario Bloqueado
									</div>
								@enderror
                                @error('messagenoexiste')
								<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<i class="fa fa-times-circle"></i> Usuario no existe
									</div>
								@enderror
								<div class="logo text-center"><img src="assets/img/logo.png" alt="Logo"></div>
							</div>
							<form class="form-auth-small" method="post" action="">
							   @csrf
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" name="email" id="email" value="" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Password">
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
								</div>	
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Bienvenido</h1>
							<p><a style="color:#fff; cursor:pointer;" href="{{ route('registers.preregister') }}">Pre-Registro</a></p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
@endsection
