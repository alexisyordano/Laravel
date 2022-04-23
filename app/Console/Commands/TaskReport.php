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
      
      $handle = fopen('export.xls', 'w');

      $data = Solicitudes::from('solicitudes as s')
                          ->select('u.name', 's.monto', 's.concepto', 'b.b_name', 's.created_at')
                          ->join('lines as l', 'l.id_line', '=', 's.id_line')
                          ->join('users as u', 'u.id', '=', 'l.id_user')
                          ->join('bonos as b', 'b.id_bono', '=', 'l.id_bono')
                          ->where('u.bloqueo', 0)
                          ->where('l.block', 0)
                          ->where('s.estatus', 'P');
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
