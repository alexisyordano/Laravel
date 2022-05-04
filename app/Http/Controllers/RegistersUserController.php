<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Bonos;
use App\Models\Banco;
use App\Models\Lines;
use App\Models\DatosUsers;
use App\Models\Transactions;
use App\Models\Preregistros;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegistersUserController extends Controller
{
    public function create()
    {
        if(Auth::check())
        {
            $role = Role::all();
            $bonos = Bonos::all();
            return view('auth.registers', compact('role','bonos'));
        }
        else
        {   
            return redirect()->to('login');
        }
        
    }

    public function store(Request $request)
    {
        $validator  = $request->validate([
            'email' => 'required|unique:users',
            'identificador' => 'required|unique:datos_users',
        ]);

        $id_rol = request('rol');

        if($id_rol == "")
        {
            try {

                $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => '1234',
                'id_rol' => '2',
                'bloqueo' => 0,
                ]);

                $id = $user->id;

                try {

                    $date_first_pay = date("Y-m-d");
                    $datos_users = DatosUsers::create([
                    'telefono' => request('tele'),
                    'fecha_nacimiento' => request('fecha_n'),
                    'nacionalidad' => request('nacion'),
                    'pais' => request('pais_i'),
                    'nombre_referido' => request('nombre_r'),
                    'f_primer_pago' => $date_first_pay,
                    'monto' => request('monto'),
                    'identificador' => request('identificador'),
                    'id_user' => $id,
                    ]);

                    try {

                        $fecha = $date_first_pay;            
                        $fecha2 = date("Y-m-d",strtotime($fecha."+ 3 days"));
                        $dia = date("w", strtotime($fecha2));
                        //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
                        if ($dia == 6)
                        {
                            $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                        }
                        if ($dia == 0)
                        {
                            $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                        }
                        if ($dia == 1)
                        {
                            $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                        }

                        $sql = DB::table('bonos')->select('days')
                                    ->where('id_bono', request('modalidad'))
                                    ->get();

                        $dias = $sql[0]->days;                        
                        $aux =  $dias;
                        
                        $date_close = date("Y-m-d",strtotime($fecha2."+ ".$dias." days"));
                        $dia = date("w", strtotime($date_close));
                        if ($dia == 6)
                        {
                            $aux = $aux + 2;
                            $date_close = date("Y-m-d",strtotime($fecha2."+ ".$aux." days"));
                        }
                        if ($dia == 0)
                        {
                            $aux = $aux + 2;
                            $date_close = date("Y-m-d",strtotime($fecha2."+ ".$aux." days"));
                        }

                        $date_pay = date("Y-m-d",strtotime($date_close."+ 4 days"));
                        $dia = date("w", strtotime($date_pay));
                        //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
                        if ($dia == 6)
                        {
                            $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                        }
                        if ($dia == 0)
                        {
                            $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                        }
                        if ($dia == 1)
                        {
                            $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                        }

                        $sql = DB::table('bonos')->select('interests')
                                    ->where('id_bono', request('modalidad'))
                                    ->get();

                        $monto = request('monto');
                        $p_intereses = $sql[0]->interests;
                        $m_intereses = $monto * ($p_intereses / 100);
                        $saldo = $monto + $m_intereses;

                        $modalidad = request('modalidad');

                        $line = Lines::create([
                            'id_bono' => request('modalidad'),
                            'id_user' => $id,
                            'block' => 0,
                        ]);

                        $id_line = Lines::select('id_line')
                                        ->where('id_bono', $modalidad)
                                        ->where ('id_user', $id)
                                        ->first()
                                        ->id_line;

                        try {

                            $banco = Banco::create([
                                'name_banco' => request('n_banco'),
                                'tipo_cuenta' => request('t_cuenta'),
                                'titular' => request('anombre'),
                                'numero' => request('ncuenta'),
                                'id_user' => $id,     
                                'code_transaction' => "Null",
                            ]);

                            try {

                                $transaciones = Transactions::create([
                                    'id_user' => $id,
                                    'id_solicitud' => 0,
                                    'id_bono' => request('modalidad'),
                                    'cicle' => 1,
                                    'dias' => $dias,     
                                    'date_mov' => $fecha,
                                    'date_sistema' => $fecha2,
                                    'date_close' => $date_close,
                                    'date_pay' => $date_pay,
                                    'monto' => request('monto'),
                                    'p_intereses' => $p_intereses,
                                    'm_intereses' => $m_intereses,
                                    'saldo' => $saldo,
                                    'id_line' => $id_line,
                                    'solicitud' => '0',
                                ]);

                                if($banco == TRUE)
                                {
                                    $email = request('email');
                                    $creado = 1;
                                    DB::update('update preregistros set creado = ? where email = ?',[$creado,$email]); 
                                }

                            } catch (\Exception $e) {
                                return $e->getMessage();
                            }

                            } catch (\Exception $e) {
                            return $e->getMessage();
                        }

                        } catch (\Exception $e) {
                        return $e->getMessage();
                    } 

                    } catch (\Exception $e) {
                    return $e->getMessage();
                }   

                } catch (\Exception $e) {
                return $e->getMessage();
            }       
        }
        else
        {
            try {

                $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => request('password'),
                'id_rol' => request('rol'),
                'bloqueo' => 0,
                ]);

                $id = $user->id;

                try {

                    $date_first_pay = date("Y-m-d");
                    $datos_users = DatosUsers::create([
                    'telefono' => request('tele'),
                    'fecha_nacimiento' => request('fecha_n'),
                    'nacionalidad' => request('nacion'),
                    'pais' => request('pais_i'),
                    'nombre_referido' => request('nombre_r'),
                    'f_primer_pago' => $date_first_pay,
                    'monto' => request('monto'),
                    'identificador' => request('identificador'),
                    'id_user' => $id,
                    ]);

                    try {

                        $fecha = $date_first_pay;            
                        $fecha2 = date("Y-m-d",strtotime($fecha."+ 3 days"));
                        $dia = date("w", strtotime($fecha2));
                        //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
                        if ($dia == 6)
                        {
                            $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                        }
                        if ($dia == 0)
                        {
                            $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                        }
                        if ($dia == 1)
                        {
                            $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                        }

                        $dias = request('dias');
                        $aux =  request('dias');
                        
                        $date_close = date("Y-m-d",strtotime($fecha2."+ ".$dias." days"));
                        $dia = date("w", strtotime($date_close));
                        if ($dia == 6)
                        {
                            $aux = $aux + 2;
                            $date_close = date("Y-m-d",strtotime($fecha2."+ ".$aux." days"));
                        }
                        if ($dia == 0)
                        {
                            $aux = $aux + 2;
                            $date_close = date("Y-m-d",strtotime($fecha2."+ ".$aux." days"));
                        }

                        $date_pay = date("Y-m-d",strtotime($date_close."+ 4 days"));
                        $dia = date("w", strtotime($date_pay));
                        //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
                        if ($dia == 6)
                        {
                            $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                        }
                        if ($dia == 0)
                        {
                            $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                        }
                        if ($dia == 1)
                        {
                            $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                        }

                        $monto = request('monto');
                        $p_intereses = request('p_intereses');
                        $m_intereses = $monto * ($p_intereses / 100);
                        $saldo = $monto + $m_intereses;

                        $modalidad = request('id_bono');

                        $line = Lines::create([
                            'id_bono' => request('id_bono'),
                            'id_user' => $id,
                            'block' => 0,
                        ]);                        
                        
                        $id_line = Lines::select('id_line')
                                    ->where('id_bono', $modalidad)
                                    ->where ('id_user', $id)
                                    ->first()
                                    ->id_line;

                        try {

                            $banco = Banco::create([
                                'name_banco' => request('n_banco'),
                                'tipo_cuenta' => request('t_cuenta'),
                                'titular' => request('anombre'),
                                'numero' => request('ncuenta'),
                                'id_user' => $id,     
                                'code_transaction' => request('code_transaction'),
                            ]);

                            try {

                                $transaciones = Transactions::create([
                                    'id_user' => $id,
                                    'id_solicitud' => 0,
                                    'id_bono' => request('id_bono'),
                                    'cicle' => 1,
                                    'dias' => $dias,     
                                    'date_mov' => $fecha,
                                    'date_sistema' => $fecha2,
                                    'date_close' => $date_close,
                                    'date_pay' => $date_pay,
                                    'monto' => request('monto'),
                                    'p_intereses' => $p_intereses,
                                    'm_intereses' => $m_intereses,
                                    'saldo' => $saldo,
                                    'id_line' => $id_line,
                                    'solicitud' => '0',
                                ]);

                            } catch (\Exception $e) {
                                return $e->getMessage();
                            }

                            } catch (\Exception $e) {
                            return $e->getMessage();
                        }

                        } catch (\Exception $e) {
                        return $e->getMessage();
                    }

                    } catch (\Exception $e) {
                    return $e->getMessage();
                }       

                } catch (\Exception $e) {
                return $e->getMessage();
            }
        }    
        return redirect()->to('registers')->with('success','Registro creado satisfactoriamente');
    }

    public function add($id)
    {
        if(Auth::check())
        {   $id = $id;
            $bonos = Bonos::all();
            return view('auth.add', compact('bonos','id'));
        }
        else
        {   
            return redirect()->to('login');
        }
    }

    public function bloqueo(Request $request, $id)
    {
        if(Auth::check())
        {   
            $id = $id;
            $bloqueo = 1;
            DB::update('update users set bloqueo = ? where id = ?',[$bloqueo,$id]);  
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i>Usuario Bloqueado
                </div>'; 
        }
        else
        {   
            return redirect()->to('show');
        }
    }

    public function activar(Request $request, $id)
    {
        if(Auth::check())
        {   
            $id = $id;
            $bloqueo = 0;
            DB::update('update users set bloqueo = ? where id = ?',[$bloqueo,$id]);  
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i>Usuario Activado
                </div>'; 
        }
        else
        {   
            return redirect()->to('show');
        }
    }

    public function InsertAdd(Request $request)
    {
        try {
            $date_first_pay = date("Y-m-d");
            $fecha = $date_first_pay;
            $fecha2 = date("Y-m-d",strtotime($fecha."+ 3 days"));
            $dia = date("w", strtotime($fecha2));
            //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
            if ($dia == 6)
            {
                $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
            }
            if ($dia == 0)
            {
                $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
            }
            if ($dia == 1)
            {
                $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
            }


            $dias = request('dias');
            $aux =  request('dias');

            $date_close = date("Y-m-d",strtotime($fecha2."+ ".$dias." days"));
            $dia = date("w", strtotime($date_close));
            if ($dia == 6)
            {
                $aux = $aux + 2;
                $date_close = date("Y-m-d",strtotime($fecha2."+ ".$aux." days"));
            }
            if ($dia == 0)
            {
                $aux = $aux + 2;
                $date_close = date("Y-m-d",strtotime($fecha2."+ ".$aux." days"));
            }

            $date_pay = date("Y-m-d",strtotime($date_close."+ 4 days"));
            $dia = date("w", strtotime($date_pay));
            //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 6 dias
            if ($dia == 6)
            {
                $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
            }
            if ($dia == 0)
            {
                $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
            }
            if ($dia == 1)
            {
                $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
            }

            $monto = request('monto');
            $p_intereses = request('p_intereses');
            $m_intereses = $monto * ($p_intereses / 100);
            $saldo = $monto + $m_intereses;

            try {

                $modalidad = request('id_bono');
                $id = request('id');
                $line = Lines::create([
                    'id_bono' => request('id_bono'),
                    'id_user' => request('id'),
                    'block' => 0,
                ]);

                $id_line = Lines::select('id_line')
                                    ->where('id_bono', $modalidad)
                                    ->where ('id_user', $id)
                                    ->first()
                                    ->id_line;
                        
                try {
                    $banco = Banco::create([
                        'name_banco' => request('n_banco'),
                        'tipo_cuenta' => request('t_cuenta'),
                        'titular' => request('anombre'),
                        'numero' => request('ncuenta'),
                        'id_user' => request('id'),     
                        'code_transaction' => request('code_transaction'),
                    ]);
                    try {

                        $transaciones = Transactions::create([
                            'id_user' => request('id'),
                            'id_solicitud' => 0,
                            'id_bono' => request('id_bono'),
                            'cicle' => 1,
                            'dias' => request('dias'),     
                            'date_mov' => $fecha,
                            'date_sistema' => $fecha2,
                            'date_close' => $date_close,
                            'date_pay' => $date_pay,
                            'monto' => request('monto'),
                            'p_intereses' => $p_intereses,
                            'm_intereses' => $m_intereses,
                            'saldo' => $saldo,
                            'id_line' => $id_line,
                            'solicitud' => '0',
                        ]);
        

                    } catch (\Exception $e) {
                        return $e->getMessage();
                    }
                }   catch (\Exception $e) {
                    return $e->getMessage();
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect()->to('registers')->with('success','Registro creado satisfactoriamente');
    }

    public function select($id)
    {
       
       $bono = Bonos::select('*')->where('id_bono', $id)->first();
       return json_encode($bono);  
    }

    public function show()
    {
        if(Auth::check())
        {
            $users = User::all();
            return view('auth.show', compact('users'));
        }
        else
        {   
            return redirect()->to('login');
        }
    }

    public function edit(Request $request, User $user)
    { 
        if(Auth::check())
        {
            $id = $user->id; 
            $user = DB::table('users')->select('*')
                        ->join('datos_users', 'users.id', '=', 'datos_users.id_user')
                        ->join('bancos', 'bancos.id_user', '=', 'users.id')
                        ->where('users.id', $id)
                        ->first();

            return view('auth.edit', compact('user'));
        }
        else
        {   
            return redirect()->to('login');
        }
        
    }

    public function update(Request $request, $id)
    {

        $UserName = $name = $request->input('name');

        $name = $request->input('name');
        $email = $request->input('email');
        DB::update('update users set name = ?, email= ? where id = ?',[$name,$email,$id]);

        $telefono = $request->input('telefono');
        $fecha_n = $request->input('fecha_n');
        $nacionalidad = $request->input('nacionalidad');
        $pais = $request->input('pais');
        $nombre_referido = $request->input('nombre_referido');
        $f_primer_pago = $request->input('f_primer_pago');
        $monto = $request->input('monto');
        $identificador = $request->input('identificador');
        DB::update('update datos_users set telefono = ?, fecha_nacimiento =?, 
                    nacionalidad = ?,
                    pais = ?,
                    nombre_referido = ?,
                    f_primer_pago = ?,
                    monto = ?,
                    identificador = ?
                    where id_user = ?',[$telefono,$fecha_n,$nacionalidad,$pais,$nombre_referido,
                                  $f_primer_pago, $monto, $identificador,$id]);

        $name_banco = $request->input('name_banco');
        $tipo_cuenta = $request->input('tipo_cuenta');
        $titular = $request->input('titular');
        $numero = $request->input('numero');
        $code_transaction = $request->input('code_transaction');
        DB::update('update bancos set name_banco = ?, tipo_cuenta =?, 
                    titular = ?,
                    numero = ?,
                    code_transaction = ?
                    where id_user = ?',[$name_banco,$tipo_cuenta,$titular,$numero,$code_transaction,$id]);
  
        //$user->update($request->all());
        return redirect()->to('show')->with('success', $UserName.' '. 'Usuario Actualizado');
    }

    public function search(Request $request)
    {
        $results = User::where('name', 'LIKE', "%{$request->search}%")->get();
        $response = array();
        foreach($results as $results)
        {
            $response[] = array("value"=>$results->name,"label"=>$results->name);
        }

        echo json_encode($response);
    }

    public function preregister()
    {
        $bonos = Bonos::limit(1)->get();
        return view('auth.preregisters', compact('bonos'));
    }

    public function InsertRegister()
    {
        $pre = Preregistros::create([
            'name' => request('name'),
            'email' => request('email'),
            'telefono' => request('tele'),
            'pais' => request('pais'),
            'nacionalidad' => request('nacion'),
            'fecha_nacimiento' => request('fecha_nacimiento'),
            'modalidad' => request('modalidad'),
            'nombre_r' => request('nombre_r'),
            'fecha_primer_pago' => request('fecha_primer_pago'),
            'monto' => request('monto'),
            'n_banco' => request('n_banco'),
            't_cuenta' => request('t_cuenta'),
            'anombre' => request('anombre'),
            'ncuenta' => request('ncuenta'),
            'identificador' => request('identificador'),
            'creado' => "0"
        ]);

        return redirect()->to('preregister')->with('success','Registro creado satisfactoriamente');
    }

    public function inversionita()
    {
        if(Auth::check())
        {
            $inv = Preregistros::all();
            return view('auth.showInve', compact('inv'));
        }
        else
        {   
            return redirect()->to('login');
        }
    }

    public function deletepre($id)
    {
        $inv = Preregistros::where('id_registro', $id)->delete();
        return redirect()->to('inversionita')->with('success', 'Inversionita Eliminado');
    }


    public function delete($id)
    {
        $user = User::find($id);
        return view('auth.delete', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->to('show')->with('success', 'Usuario Eliminado');
    }

    public function password(Request $request, User $user)
    {
        return view('auth.password', compact('user'));
    }

    public function updatePass(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required',
        ]);

        
        $user->update($request->all());

        return redirect()->to('show')->with('success', 'Se actualizo la clave');
    }
}
