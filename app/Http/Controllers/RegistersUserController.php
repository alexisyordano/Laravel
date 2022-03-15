<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegistersUserController extends Controller
{
    public function create()
    {
        if(Auth::check())
        {
            $role = Role::all();
            return view('auth.registers', compact('role'));
        }
        else
        {   
            return redirect()->to('login');
        }
        
    }

    public function store()
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'id_rol' => request('rol'),
        ]);
        
        //auth()->login($user);
        return redirect()->to('registers')->with('success','Registro creado satisfactoriamente');
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
