<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        if(auth()->attempt(request(['email', 'password'])) == false)
        {
            return back()->withErrors([
                'message' => 'El email es incorrecto o la clave es incorrecta',
            ]);
        }
         
        return redirect()->to('home');
    }

    public function destroy(Request $request)
    {
        auth()->logout();
        return redirect()->to('login');
    }
}
