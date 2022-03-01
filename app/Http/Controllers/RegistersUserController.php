<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegistersUserController extends Controller
{
    public function create()
    {
        return view('auth.registers');
    }

    public function store()
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
        ]);

        auth()->login($user);
        return redirect()->to('registers')->with('success','Registro creado satisfactoriamente');
    }

    public function show()
    {
        $users = User::all();
        return view('auth.show', compact('users'));
    }

    public function edit(User $users)
    { 
        return view('auth.edit', compact('users'));
    }
}
