<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use App\Models\Solicitudes;
    use App\Models\Transactions;
    use Illuminate\Support\Facades\DB;

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
            if(Auth::check())
            {
                $inversiones = DB::table('transactions')->select('id_transaction')
                                ->groupBy('id_transaction')
                                ->where('id_user', auth()->id())
                                ->get();
                return view('auth.retiro', compact('inversiones'));
            }
            else
            {   
                return redirect()->to('login');
            }
        }

        public function insert()
        {
            $user = Solicitudes::create([
                'id_user' => request('id_user'),
                'monto' => request('monto'),
                'concepto' => request('concepto'),
                'estatus' => 'P',
            ]);
            
            return redirect()->to('inversion')->with('success','Solicitud creada satisfactoriamente');
        }

        public function solicitudes()
        {
            if(Auth::check())
            {
                $solicitudes = Solicitudes::all()->where('estatus', 'P');
                return view('auth.solicitudes', compact('solicitudes'));
            }
            else
            {   
                return redirect()->to('login');
            }
        }

        public function operacion()
        {
            if (request('Aprobar'))
            {
                $solicitud = Solicitudes::find(request('id_op'));
                $solicitud->update(['estatus' => 'A']);
                $transaccion = Transactions::create([
                    'id_user' => request('id_user'),
                    'id_transaction' => request('id_op'),
                    'concepto' => request('concepto'),
                    'date_mov' => date('Y-m-d'),
                    'monto' => request('monto'),
                    'saldo' => request('monto'),
                ]);
                return redirect()->to('solicitudes')->with('success', 'Solicitud aprobada');
            }
            if (request('Rechazar'))
            {
                $solicitud = Solicitudes::find(request('id_op'));
                $solicitud->update(['estatus' => 'R']);
                return redirect()->to('solicitudes')->with('success', 'Solicitud rechazada');
            }            
        }
    }
?>