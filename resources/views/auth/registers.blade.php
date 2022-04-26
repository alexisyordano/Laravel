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
                     <div class="col-md-12">
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
                                                    <input type="text" name="fecha_n" class="form-control" placeholder="Fecha de Nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                        <br>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input type="text" name="nacion" id="nacion" required class="form-control" placeholder="Nacionalidad">
                                                        <br>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <select class="form-control" name="modalidad_buscar" id="modalidad_buscar" required>
                                                            <option value="">-- Selecione una modalidad --</option>
                                                                @foreach($bonos as $bono)
                                                                    <option value="{{ $bono['id_bono'] }}">{{ $bono['b_name'] }}</option>
                                                                @endforeach
                                                        </select>
                                                        <br>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input type="text" name="pais_i" id="pais_i" required class="form-control" placeholder="País de residencia">
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
                                                    
                                                    <div class="col-md-6">
                                                        <input type="password" name="password" maxlength="8" required id="password" class="form-control" placeholder="Clave de 8 digitos">
                                                        <br>
                                                    </div> 
                                                    
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="rol" required>
                                                            <option value="">-- Selecione un Rol --</option>
                                                            @foreach($role as $rol)
                                                                <option value={{ $rol['id_role'] }}>{{ $rol['name_role'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <input type="hidden" name="dias" id="dias">
                                                    <input type="hidden" name="p_intereses" id="p_intereses">
                                                    <input type="hidden" name="id_bono" id="id_bono">
                                                    
                                                    <div class="col-md-6">
                                                        <input type="text" name="code_transaction"  id="code_transaction" class="form-control" placeholder="Codigo transacción" required>
                                                        <br>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
								</div>
							</div>
							<!-- END INPUTS -->

                        <script>
                            $(document).ready(function(){
                                $('#nombre_r').focus();
                            });
                            $(document).ready(function() {
                                $('#nombre_r').autocomplete({
                                source: "{{ route('registers.search') }}"
                                });
                            });
                        </script>
                            <script type="text/javascript">
                                $('#modalidad_buscar').on('change', function(e)
                                {
                                    var id = e.target.value;

                                    //alert(ciudad_id);
                                    $.get('{{ url("/") }}/select/'+id, function(data){
                                        var dia = $.parseJSON(data);
                                        $('#dias').val(dia.days);
                                        $('#p_intereses').val(dia.interests); 
                                        $('#id_bono').val(dia.id_bono); 
                                    });
                                });
                            </script>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
    @extends('layouts.footer')
</div>
@endsection

