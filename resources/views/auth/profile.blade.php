@extends('layouts.app')
<div id="wrapper">
    @section('content')
    @extends('layouts.nav')
    @extends('layouts.left')
    <div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                <div class="panel panel-profile">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <i class="fa fa-check-circle"></i> {{ session()->get('success') }}
                            </div>
                        @endif
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Información Basica </h4>
										<ul class="list-unstyled list-justify">
											<li>Nombre :<span>{{ auth()->user()->name }}</span></li>
											<li>Email : <span>{{ auth()->user()->email }}</span></li>
										</ul>
									</div>
									
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<h4 class="heading">{{ auth()->user()->name }}</h4>
								<div class="custom-tabs-line tabs-line-bottom left-aligned">
									<ul class="nav" role="tablist">
                                         <h2>Cambiar su clave</h2>

									</ul>
								</div>
								<div class="tab-content"> 
                                     <form name="form" action="{{route("login.changePass")}}" method="post">
                                     @csrf
                                         <div class="col-md-4">
                                            <input type="password" name="password" required class="form-control">
                                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                            <br>
                                            <button class="btn btn-info">Cambiar</button>
                                         </div>
                                     </form>  
								</div>
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
    @extends('layouts.footer')
</div>
@endsection