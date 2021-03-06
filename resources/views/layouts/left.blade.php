<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{ route('home.index') }}" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<!--  Begin view Admin  !-->
						@if( Auth::user()->id_rol  == '1' )
							<li>
								<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr lnr-cog"></i> <span>Control de Inversores</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages" class="collapse ">
									<ul class="nav">
										<li><a href="{{ route('registers.create') }}" class="">Crear Usuarios</a></li>
										<li><a href="{{ route('registers.show') }}" class="">Listar Usuarios</a></li>
										<li><a href="{{ route('registers.inversionita') }}" class="">Inversionista registrados</a></li>
									</ul>
								</div>
						    </li>
							<li>
								<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr lnr-cog"></i> <span>Bonos</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages2" class="collapse ">
									<ul class="nav">
										<li><a href="{{ route('bonosregister.index') }}" class="">Crear</a></li>
										<li><a href="{{ route('bonos.show') }}" class="">Listar Bonos</a></li>
									</ul>
								</div>
						    </li>
							<li><a href="{{ route('transactions.solicitudes') }}" class="active"><i class="lnr lnr-cog"></i><span>Solicitudes</span></a></li>
							<li><a href="{{ route('transactions.showLines') }}" class="active"><i class="lnr lnr-cog"></i><span>Lineas</span></a></li>
							<li><a href="{{ route('home.download') }}" class="active"><i class="lnr lnr-download"></i><span>Descargar Reporte</span></a></li>
						@endif
						<!-- End view Admin !-->

						<!--  Begin view Invitado  !-->
						@if( Auth::user()->id_rol  == '2' )													
							<li>
								<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr lnr-cog"></i> <span>Inversiones</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages2" class="collapse ">
									<ul class="nav">
										@foreach($inversiones as $inversion)	
											<li><a href="{{ route('transactions.estado', $inversion->id_line) }}" class="">{{ $inversion->b_name }}</a></li>
										@endforeach
									</ul>
								</div>
						    </li>	
						@endif
						<!-- End view Invitado !-->
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->