<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{ route('home.index') }}" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						@if( Auth::user()->id_rol  == '1' )
							<li>
								<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr lnr-cog"></i> <span>Control de usuarios</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages" class="collapse ">
									<ul class="nav">
										<li><a href="{{ route('registers.create') }}" class="">Crear Usuarios</a></li>
										<li><a href="{{ route('registers.show') }}" class="">Listar Usuarios</a></li>
									</ul>
								</div>
						    </li>
						@endif
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->