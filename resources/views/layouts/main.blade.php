	<div class="main">
		<!-- MAIN CONTENT -->
		<div class="main-content">
			<div class="container-fluid">
				@if( Auth::user()->id_rol  == '1' )
				    <small><strong>Administrador</strong></small>
					<h1>Bienvenido : {{ auth()->user()->name }}</h1>
				@endif
				@if( Auth::user()->id_rol  == '2' )
					<h1>Bienvenido : {{ auth()->user()->name }}</h1>
				@endif
			</div>
		</div>
		<!-- END MAIN CONTENT -->
	</div>
	<!-- END MAIN -->