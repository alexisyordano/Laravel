<!-- NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="{{ route('home.index') }}"><img src="{{ asset('/assets/img/logoPanel.png') }}"  alt="Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
                 
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Ayuda</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								@if( Auth::user()->id_rol  == '1' )	
									<li>
										<a href="./GuiaAdmin.pdf" target="_blanck">Descargar Guia</a>
									</li>
								@endif
								@if( Auth::user()->id_rol  == '2' )	
									<li>
										<a href="./Guia.pdf" target="_blanck">Descargar Guia</a>
									</li>
								@endif
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('/assets/img/user.png') }}" class="img-circle" alt="Avatar"> <span>{{ auth()->user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('login.profile') }}"><i class="lnr lnr-user"></i> <span>Mi Perfil</span></a></li>
								<li><a href="{{ route('login.destroy') }}"><i class="lnr lnr-exit"></i> <span>Salir</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
