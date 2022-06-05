<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bonos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        date_default_timezone_set('America/Lima');
        if(Auth::check())
        {
            $inversiones = DB::table('dblines')->select('*')
            ->join('bonos', 'bonos.id_bono', '=', 'dblines.id_bono')                                
            ->where('id_user', auth()->id())
            ->where('dblines.block' , '0')
            ->get();
            return view('home.home', compact('inversiones'));
        }
        else
        {   
            return redirect()->to('login');
        }
        
    }

    public function download()
    {
        return redirect()->to('/Report.php');
    }
}
