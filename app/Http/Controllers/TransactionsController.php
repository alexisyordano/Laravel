<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use App\Models\Solicitudes;
    use App\Models\Transactions;
    use App\Models\Dblines;
    use Illuminate\Support\Facades\DB;
/**/
    Class TransactionsController extends Controller 
    {

        public function inversion()
        {
            date_default_timezone_set('America/Lima');
            if(Auth::check())
            {
                return view('auth.inversion');
            }
            else
            {
                return redirect()->to('login');
            }
            
        }

        public function estado($id)
        {            
            date_default_timezone_set('America/Lima');
            if(Auth::check())
            {
                $inversiones = DB::table('dblines')->select('*')
                                    ->join('bonos', 'bonos.id_bono', '=', 'dblines.id_bono')                                
                                    ->where('id_user', auth()->id())
                                    ->where('dblines.block' , '0')
                                    ->get();

                $transacciones = DB::table('transactions')
                                ->select('transactions.id',
                                'transactions.cicle',
                                    'transactions.date_mov',
                                    'transactions.date_sistema',
                                    'bonos.b_name',
                                    'solicitudes.concepto',
                                    'transactions.id_solicitud',
                                    'transactions.date_close',
                                    'transactions.date_pay',
                                    'transactions.monto',
                                    'transactions.m_intereses',
                                    'transactions.saldo',
                                    'transactions.solicitud')
                                ->join('bonos', 'bonos.id_bono', '=', 'transactions.id_bono')
                                ->join('dblines', 'dblines.id_line', '=', 'transactions.id_line')
                                ->join('solicitudes', 'solicitudes.id_sol', '=', 'transactions.id_solicitud', 'left')
                                ->where('dblines.block' , '0')
                                ->where('transactions.id_user', '=', auth()->id())
                                ->where('transactions.id_line', '=', $id)
                                ->orderBy('transactions.date_sistema', 'asc')
                                ->get();                              

                $date = date("Y-m-d");
                return view('auth.estado', compact('inversiones'), compact('transacciones'), compact('date'));
            }
            else
            {   
                return redirect()->to('login');
            }            
        }

        public function solicitudes()
        {
            date_default_timezone_set('America/Lima');
            if(Auth::check())
            {
                $solicitudes = Solicitudes::select('solicitudes.id_sol','u.name', 'solicitudes.monto', 'solicitudes.concepto', 'solicitudes.created_at')
                ->join('dblines as l', 'l.id_line', '=', 'solicitudes.id_line')
                ->join('users as u', 'u.id', '=', 'l.id_user')
                ->where('solicitudes.estatus', 'P')
                ->get();
                return view('auth.solicitudes', compact('solicitudes'));
            }
            else
            {   
                return redirect()->to('login');
            }
        }

        public function reinvertir($id_line)
        {        
            date_default_timezone_set('America/Lima');
            try 
            {
                $update = Transactions::where('transactions.id', $id_line)
                                        ->join('dblines', 'dblines.id_line', '=', 'transactions.id_line')
                                        ->where('dblines.block' , '0')
                                        ->update(([
                                            'transactions.solicitud' => '1',
                                         ]));
                if($update == TRUE)
                {
                    $info = Transactions::select('*')
                            ->where('id', $id_line)
                            ->first();
                            
                    $reinversion = Solicitudes::create([
                        'id_line' => $info->id_line,
                        'id_transaction' => $info->id,
                        'monto' => $info->saldo,
                        'concepto' => 'Reinvertir',
                        'estatus' => 'A',
                        'tipo' => 'RI',
                    ]);

                    $fecha = $info->date_pay;
                    $fecha2 = date("Y-m-d",strtotime($fecha."+ 3 days"));
                    $dia = date("w", strtotime($fecha2));
                    //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
                    if ($dia == 6)
                    {
                    $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                    }
                    if ($dia == 0)
                    {
                    $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                    }
                    if ($dia == 1)
                    {
                    $fecha2 = date("Y-m-d",strtotime($fecha."+ 5 days"));
                    }

                    $dias = $info->dias;
                    $aux =  $info->dias;

                    $date_close = date("Y-m-d",strtotime($fecha2."+ ".$dias." days"));
                    $dia = date("w", strtotime($date_close));
                    if ($dia == 6)
                    {
                    $aux = $aux + 2;
                    $date_close = date("Y-m-d",strtotime($fecha2."+ ".$aux." days"));
                    }
                    if ($dia == 0)
                    {
                    $aux = $aux + 2;
                    $date_close = date("Y-m-d",strtotime($fecha2."+ ".$aux." days"));
                    }

                    $date_pay = date("Y-m-d",strtotime($date_close."+ 4 days"));
                    $dia = date("w", strtotime($date_pay));
                    //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
                    if ($dia == 6)
                    {
                        $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                    }
                    if ($dia == 0)
                    {
                        $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                    }
                    if ($dia == 1)
                    {
                        $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                    }
                    if ($dia == 2)
                    {
                        $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                    }

                    $m_intereses = $info->saldo * ($info->p_intereses / 100);
                    $saldo = $info->saldo + $m_intereses;

                    $reinvertir = Transactions::create([
                    'id_user' => $info->id_user,
                    'id_solicitud' => $info->id_solicitud,
                    'id_bono' => $info->id_bono,
                    'cicle' => $info->cicle + 1,
                    'dias' => $info->dias,     
                    'date_mov' => $info->date_pay,
                    'date_sistema' => $fecha2,
                    'date_close' => $date_close,
                    'date_pay' => $date_pay,
                    'monto' => $info->saldo,
                    'p_intereses' => $info->p_intereses,
                    'm_intereses' => $m_intereses,
                    'saldo' => $saldo,
                    'id_line' => $info->id_line,
                    'solicitud' => '0',
                    ]);

                    $vista = 'estado/'.strval($info->id_line);
                    return redirect()->to($vista);
                }                
            }
            catch (\Exception $e)
            {
                return $e->getMessage();
            }            
        }
        
        public function abono($id)
        {
            date_default_timezone_set('America/Lima');
            if(Auth::check())
            {
                $id_line = Transactions::select('*')
                                        ->where('id', $id)
                                        ->first()
                                        ->id_line;                
                return view('auth.abono', compact('id_line'), compact('id'));
            }
            else
            {   
                return redirect()->to('login');
            }
        }

        public function retiro($id)
        {
            date_default_timezone_set('America/Lima');
            if(Auth::check())
            {
                $id_line = Transactions::select('*')
                                        ->where('id', $id)
                                        ->first()
                                        ->id_line;
                return view('auth.retiro', compact('id'),compact('id_line'));
            }            
            else
            {   
                return redirect()->to('login');
            }
        }

        public function upAbono()
        {
            date_default_timezone_set('America/Lima');
            $update = Transactions::where('id', request('id_transaction'))
                                        ->update([
                                            'solicitud' => '1',
                                         ]);
                                        
            $reinversion = Solicitudes::create([
                'id_line' => request('id_line'),
                'id_transaction' => request('id_transaction'),
                'monto' => request('m_abono'),
                'concepto' => 'Abono',
                'estatus' => 'P',
                'tipo' => 'A',
            ]);

            $vista = 'estado/'.request('id_line');
            return redirect()->to($vista);
        }
        public function upRetiro()
        {
            date_default_timezone_set('America/Lima');
            $monto = Transactions::select('*')
                                        ->where('id', request('id_transaction'))
                                        ->orderBy('created_at', 'desc')
                                        ->first()
                                        ->saldo;

            if (request('m_retiro') < $monto)
            {
                $update = Transactions::where('id', request('id_transaction'))
                                        ->update(([
                                            'solicitud' => '1',
                                         ]));

                $retiro = Solicitudes::create([
                    'id_line' => request('id_line'),
                    'id_transaction' => request('id_transaction'),
                    'monto' => request('m_retiro'),
                    'concepto' => 'Retiro',
                    'estatus' => 'P',
                    'tipo' => 'R',
                ]);
            }          

            $vista = 'estado/'.request('id_line');
            return redirect()->to($vista);
        }

        public function operacion()
        {
            date_default_timezone_set('America/Lima');
            if(request('Aprobar'))
            {
                $estatus = 'A';
            }
            if(request('Rechazar'))
            {
                $estatus = 'R';
            }
            $update = Solicitudes::where('id_sol', request('id_sol'))
                        ->update([
                            'monto' => request('monto'),
                            'estatus' =>  $estatus,
                         ]);

            $solicitudes = Solicitudes::select('solicitudes.id_sol','u.name', 'solicitudes.monto', 'solicitudes.concepto', 'solicitudes.created_at')
                ->join('dblines as l', 'l.id_line', '=', 'solicitudes.id_line')
                ->join('users as u', 'u.id', '=', 'l.id_user')
                ->where('solicitudes.estatus', 'P')
                ->get();
            

            $info_sol = Solicitudes::select('solicitudes.id_transaction', 'solicitudes.created_at')
                                    ->where('id_sol', request('id_sol'))
                                    ->get();
            
            $info = Transactions::select('*')
                ->join('bonos', 'bonos.id_bono', '=', 'transactions.id_bono')
                ->where('transactions.id', $info_sol[0]->id_transaction)
                ->get();

            $transaccion = Transactions::create([
                'id_user' => $info[0]->id_user,
                'id_solicitud' => request('id_sol'),
                'id_bono' => $info[0]->id_bono,
                'cicle' => $info[0]->cicle,
                'dias' => '0',     
                'date_mov' => $info_sol[0]->created_at,
                'date_sistema' => $info[0]->date_pay,
                'date_close' => $info[0]->date_pay,
                'date_pay' => $info[0]->date_pay,
                'monto' => request('monto'),
                'p_intereses' => '0',
                'm_intereses' => '0',
                'saldo' => request('monto'),
                'id_line' => $info[0]->id_line,
                'solicitud' => '1',
            ]);
            
            return view('auth.solicitudes', compact('solicitudes'));
        }

        public function showLines()
        {
            date_default_timezone_set('America/Lima');
            if(Auth::check())
            {
                $list = Dblines::select('*')
                ->join('users as u', 'u.id', '=', 'dblines.id_user')
                ->join('bonos as b', 'b.id_bono', '=', 'dblines.id_bono')
                ->get();
    
                return view('auth.showLines', compact('list'));
            }
            else
            {
                return redirect()->to('login');
            } 
        }

        public function block($id)
        {
            date_default_timezone_set('America/Lima');
            $update = Dblines::where('id_line', $id)
                                    ->update([
                                        'block' => '1',
                                        ]);                                    

            $list = Dblines::select('*')
                            ->join('users as u', 'u.id', '=', 'dblines.id_user')
                            ->join('bonos as b', 'b.id_bono', '=', 'dblines.id_bono')
                            ->get();

            return view('auth.showLines', compact('list'));
        }

        public function unblock($id)
        {
            date_default_timezone_set('America/Lima');
            $update = Dblines::where('id_line', $id)
                                    ->update([
                                        'block' => '0',
                                        ]);

            $list = Dblines::select('*')
                            ->join('users as u', 'u.id', '=', 'dblines.id_user')
                            ->join('bonos as b', 'b.id_bono', '=', 'dblines.id_bono')
                            ->get();

            return view('auth.showLines', compact('list'));
        }
    }
?>