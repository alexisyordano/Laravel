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
						<!-- TABLE HOVER -->
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Ultimos movimientos</h3>
							</div>
							<div class="panel-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Username</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Steve</td>
											<td>Jobs</td>
											<td>@steve</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Simon</td>
											<td>Philips</td>
											<td>@simon</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Jane</td>
											<td>Doe</td>
											<td>@jane</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END TABLE HOVER -->
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
    @extends('layouts.footer')
</div>
@endsection