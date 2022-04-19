<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bonos;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $inversiones = DB::table('lines')->select('*')
            ->join('bonos', 'bonos.id_bono', '=', 'lines.id_bono')                                
            ->where('id_user', auth()->id())
            ->where('lines.block' , '0')
            ->get();
            return view('home.home', compact('inversiones'));
        }
        else
        {   
            return redirect()->to('login');
        }
        
    }
}
