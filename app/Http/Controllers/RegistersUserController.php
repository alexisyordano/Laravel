<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Bonos;
use App\Models\Banco;
use App\Models\DatosUsers;
use App\Models\Transactions;
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

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'id_rol' => request('rol'),
        ]);

           $id = $user->id;
        //    $id = 15;

            $datos_users = DatosUsers::create([
                'telefono' => request('tele'),
                'fecha_nacimiento' => request('fecha_n'),
                'nacionalidad' => request('nacion'),
                'pais' => request('pais_i'),
                'nombre_referido' => request('nombre_r'),
                'f_primer_pago' => request('fecha_primer_pago'),
                'monto' => request('monto'),
                'identificador' => request('identificador'),
                'id_user' => $id,
            ]);

            $fecha = date("Y-m-d");            
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

            $date_pay = date("Y-m-d",strtotime($date_close."+ 3 days"));
            $dia = date("w", strtotime($date_pay));
            //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
            if ($dia == 6)
            {
                $date_pay = date("Y-m-d",strtotime($date_close."+ 5 days"));
            }
            if ($dia == 0)
            {
                $date_pay = date("Y-m-d",strtotime($date_close."+ 5 days"));
            }
            if ($dia == 1)
            {
                $date_pay = date("Y-m-d",strtotime($date_close."+ 5 days"));
            }

            $monto = request('monto');
            $p_intereses = request('p_intereses');
            $m_intereses = $monto * ($p_intereses / 100);
            $saldo = $monto + $m_intereses;

            // $inversiones = DB::select('SELECT MAX(id) FROM transactions WHERE id_user = '.$id.'');

            // echo "<pre>";
            // print_r($inversiones);
            // echo "</pre>";

            // $solicitud = 1;

            $transaciones = Transactions::create([
                'id_user' => $id,
                'id_solicitud' => 0,
                'concepto' => request('modalidad'),
                'dias' => $dias,     
                'date_mov' => $fecha,
                'date_sistema' => $fecha2,
                'date_close' => $date_close,
                'date_pay' => $date_pay,
                'monto' => request('monto'),
                'p_intereses' => $p_intereses,
                'm_intereses' => $m_intereses,
                'saldo' => $saldo,
            ]);

            $banco = Banco::create([
                'name_banco' => request('n_banco'),
                'tipo_cuenta' => request('t_cuenta'),
                'titular' => request('anombre'),
                'numero' => request('ncuenta'),
                'id_user' => $id,     
                'code_transaction' => request('code_transaction'),
            ]);
        
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

    public function InsertAdd(Request $request)
    {

        $fecha = date("Y-m-d");
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
       
        // $id = request('id');
       
        // $inversiones = DB::select('SELECT MAX(id) FROM transactions WHERE id_user = '.$id.'');
        // echo "<pre>";
        // print_r($inversiones);
        // echo "</pre>";
        
        // foreach ($inversiones as $id)
        // {
        //     print_r($id);
        // }

        // $solicitud = 1;

        $transaciones = Transactions::create([
            'id_user' => request('id'),
            'id_solicitud' => 0,
            'concepto' => request('modalidad'),
            'dias' => request('dias'),     
            'date_mov' => $fecha,
            'date_sistema' => $fecha2,
            'date_close' => $date_close,
            'date_pay' => $date_pay,
            'monto' => request('monto'),
            'p_intereses' => $p_intereses,
            'm_intereses' => $m_intereses,
            'saldo' => $saldo,
        ]);

        $banco = Banco::create([
            'name_banco' => request('n_banco'),
            'tipo_cuenta' => request('t_cuenta'),
            'titular' => request('anombre'),
            'numero' => request('ncuenta'),
            'id_user' => request('id'),     
            'code_transaction' => request('code_transaction'),
        ]);

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
            return view('auth.edit', compact('user'));
        }
        else
        {   
            return redirect()->to('login');
        }
        
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $UserName = $request->name;
        
        $user->update($request->all());
        return redirect()->to('show')->with('success', $UserName.' '. 'Usuario Actualizado');
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
