<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Lines;
use App\Models\DatosUsers;
use App\Models\Solicitudes;
use Response;

class TaskReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para generar un excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 
      $date = date('Y-m-d');
      $date2 = date("Y-m-d",strtotime($date."- 1 days"));      
      $handle = fopen('export.xls', 'w');

      $data = DB::table('users as s')
                ->select('u.name', 's.monto', 's.concepto', 'b.b_name', 's.created_at')
                ->join('lines as l', 'l.id_line', '=', 'u.id')
                ->join('transactions as t', 't.id_linea', '=', 'l.id_line')
                ->join('bonos as b', 'b.id_bono', '=', 'l.id_bono')
                ->join('solicitudes as s', 's.id_transaction', '=', 't.id')
                ->where('u.bloqueo', 0)
                ->where('l.block', 0)
                ->where('t.date_close', $date2)
                ->where('s.estatus', 'P')
                ->get();
      foreach ($data as $item) 
      {
        fputcsv($handle, $item->toArray(), ';');
      }
      fclose($handle);

    }
}
/*
  entrar a transacciones validar cuales son las que tienen fecha de cierre del dia anterior tomar
*/
