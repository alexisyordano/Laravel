<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Solicitudes;

    Class TransactionsController extends Controller {
        public function inversion()
        {
            return view('auth.inversion');
        }
        public function reinversion()
        {
            return view('auth.reinversion');
        }
        public function retiro()
        {
            return view('auth.retiro');
        }
        public function estado()
        {
            return view('auth.estado');
        }
        public function store()
        {
            $user = Solicitudes::create([
                'id_user' => request('name'),
                'monto' => request('email'),
                'concepto' => request('password'),
            ]);
            
            return redirect()->to('registers')->with('success','Registro creado satisfactoriamente');
        }
    }
?>