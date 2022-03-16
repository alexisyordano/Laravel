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

        public function estado()
        {
            if(Auth::check())
            {
                $inversiones = DB::table('transactions')->select('id_solicitud')
                                ->groupBy('id_solicitud')
                                ->where('id_user', auth()->id())
                                ->get();
                $transacciones = DB::table('transactions')->select('*')
                                ->where('id_user', auth()->id())
                                ->get();
                return view('auth.estado', compact('inversiones'), compact('transacciones'));
            }
            else
            {   
                return redirect()->to('login');
            }            
        }

        public function retiro()
        {
            if(Auth::check())
            {
                $inversiones = DB::table('transactions')->select('id_solicitud')
                                ->groupBy('id_solicitud')
                                ->where('id_user', auth()->id())
                                ->get();
                return view('auth.retiro', compact('inversiones'));
            }
            else
            {   
                return redirect()->to('login');
            }
        }

        public function abono()
        {
            if(Auth::check())
            {
                $inversiones = DB::table('transactions')->select('id_solicitud')
                                ->groupBy('id_solicitud')
                                ->where('id_user', auth()->id())
                                ->get();
                return view('auth.abono', compact('inversiones'));
            }
            else
            {   
                return redirect()->to('login');
            }
        }

        public function insert()
        {

            if(request('tipo') == 'I')
                $id_inv = 0;
            else
                $id_inv = request('id_inv');


            $user = Solicitudes::create([
                'id_user' => request('id_user'),
                'id_solicitud' => $id_inv,
                'monto' => request('monto'),
                'concepto' => request('concepto'),
                'estatus' => 'P',
                'tipo' => request('tipo'),
            ]);
            
            if(request('tipo') == 'I')
                return redirect()->to('inversion')->with('success','Solicitud creada satisfactoriamente');
            elseif (request('tipo') == 'R')
                return redirect()->to('retiro')->with('success','Solicitud creada satisfactoriamente');
            elseif (request('tipo') == 'A')
                return redirect()->to('retiro')->with('success','Solicitud creada satisfactoriamente');
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
                $solicitud = Solicitudes::find(request('id_sol'));
                $solicitud->update(['estatus' => 'A']);

                

                $saldo = Transactions::select('*')
                                            ->where('id_user',request('id_user'))
                                            ->where('id_solicitud',request('id_op'))
                                            ->orderBy('created_at', 'desc')
                                            ->first();             
            
                $concepto = request('concepto');

                if ($concepto == 'Retiro')
                {
                    $dias = 0;   
                    $intereses = 0;
                    $monto = $saldo->saldo - request('monto');
                    $fecha2 = date("Y-m-d");
                }

                if ($concepto == 'Abono')
                {
                    $dias = 0;   
                    $intereses = 0;
                    $monto = $saldo->saldo + request('monto');
                    $fecha2 = date("Y-m-d");
                }

                if ($concepto == 'Inversion')
                {
                    $dias = request('dias');
                    $intereses = request('intereses');
                    $monto = request('monto');
                    $fecha = date("Y-m-d");
                    $fecha2 = date("Y-m-d",strtotime($fecha."+ 3 days"));
                }
                    
            
                $transaccion = Transactions::create([
                    'id_user' => request('id_user'),
                    'id_solicitud' => request('id_op'),
                    'concepto' => $concepto,
                    'dias' => $dias,
                    'date_mov' => date('Y-m-d'),
                    'date_sistema' => $fecha2,
                    'monto' => request('monto'),
                    'p_intereses' => $intereses,
                    'm_intereses' => 0,
                    'saldo' => $monto,
                ]);
                return redirect()->to('solicitudes')->with('success', 'Solicitud aprobada');
            }
            if (request('Rechazar'))
            {
                $solicitud = Solicitudes::find(request('id_sol'));
                $solicitud->update(['estatus' => 'R']);

                $transaccion = Transactions::create([
                    'id_user' => request('id_user'),
                    'id_solicitud' => request('id_op'),
                    'concepto' => request('concepto'),
                    'dias' => 0,
                    'date_mov' => date('Y-m-d'),
                    'date_sistema' => date('Y-m-d'),
                    'monto' => request('monto'),
                    'p_intereses' => 0,
                    'm_intereses' => 0,
                    'saldo' => request('monto'),
                ]);

                return redirect()->to('solicitudes')->with('success', 'Solicitud rechazada');
            }            
        }
    }
?>