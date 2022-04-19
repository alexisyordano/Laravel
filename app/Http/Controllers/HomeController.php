<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return view('home.home');
        }
        else
        {   
            return redirect()->to('login');
        }
        
    }
}
