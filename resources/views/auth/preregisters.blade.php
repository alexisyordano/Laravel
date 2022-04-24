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
                                                        <input type="text" name="pais" id="pais" required class="form-control" placeholder="País de residencia">
                                                        <br>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <input type="text" name="nacion" id="nacion" required class="form-control" placeholder="Nacionalidad">
                                                        <br>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input type="text" name="fecha_nacimiento" class="form-control" placeholder="Fecha de nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                        <br>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <select class="form-control" name="modalidad" id="modalidad" required>
                                                            <option value="">-- Selecione una modalidad --</option>
                                                                @foreach($bonos as $bono)
                                                                    <option value="{{ $bono['id_bono'] }}">{{ $bono['b_name'] }}</option>
                                                                @endforeach
                                                        </select>
                                                        <br>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input type="text" name="nombre_r" id="nombre_r" required class="form-control search" placeholder="Nombres y Apellidos de Punto Raíz">
                                                        <div id="suggesstion-box"></div>
                                                        <br> 
                                                    </div>

                                                    <div class="col-md-6">
                                                    <input type="text" name="fecha_primer_pago" class="form-control" placeholder="Fecha del Primer pago" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                        <br>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input type="text" name="monto" required id="monto" class="form-control" placeholder="Monto en $">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="n_banco"  id="n_banco" class="form-control" placeholder="Nombre del Banco">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="t_cuenta"  id="t_cuenta" class="form-control" placeholder="Tipo de cuenta">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="anombre"  id="anombre" class="form-control" placeholder="A Nombre de">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="ncuenta"  id="ncuenta" class="form-control" placeholder="Numero de Cuenta">
                                                        <br>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <input type="text" name="identificador" required id="identificador" class="form-control" placeholder="DNI/Cédula/Pasaporte">
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


