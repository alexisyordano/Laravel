<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request, User $user)
    {
        date_default_timezone_set('America/Lima');
        
        //DB::connection()->enableQueryLog();
        //$queries = DB::getQueryLog();
        //print_r($queries);
        $usersBloqueo = $request->input('email');
        $data = User::select('*')->where('email', $usersBloqueo)->first();
        if (empty($data))
        {
            return back()->withErrors([
                'messagenoexiste' => 'Usuario no existe',
            ]);
        }
        
        $data->bloqueo;

        if($data->bloqueo == 1)
        {

            return back()->withErrors([
                'messageBloqueo' => 'Usuario Bloqueado',
            ]);
        }

        if(auth()->attempt(request(['email', 'password'])) == false)
        {
            return back()->withErrors([
                'message' => 'El email es incorrecto o la clave es incorrecta',
            ]);
        }
         
        return redirect()->to('home');
    }

    public function profile()
    {
        date_default_timezone_set('America/Lima');
        if(Auth::check())
        {
            $inversiones = DB::table('dblines')->select('*')
            ->join('bonos', 'bonos.id_bono', '=', 'dblines.id_bono')                                
            ->where('id_user', auth()->id())
            ->where('dblines.block' , '0')
            ->get();
            return view('auth.profile', compact('inversiones'));
        }
        else
        {   
            return redirect()->to('login');
        } 
       
    }

    public function changePass(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $pass = Hash::make($request->input('password'));
        $id = $request->input('id');
        DB::update('update users set password = ? where id = ?',[$pass,$id]);
        return redirect()->to('profile')->with('success', 'Clave Actualizada');
    }

    public function destroy(Request $request)
    {
        date_default_timezone_set('America/Lima');
        auth()->logout();
        return redirect()->to('login');
    }
}
