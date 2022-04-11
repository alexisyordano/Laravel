<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Lines;
use App\Models\DatosUsers;
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
      $data= User::from('users as u')->select('u.name', 'solicitudes.monto', 'bonos.name AS namebono', 'solicitudes.concepto')
                    ->join('lines', 'lines.id_user', '=', 'u.id')
                    ->join('bonos', 'bonos.id_bono', '=', 'lines.id_bono')
                    ->join('solicitudes', 'solicitudes.id_user', '=', 'u.id') 
                    ->where('u.bloqueo', 0)->get();
      foreach ($data as $item) 
      {
        fputcsv($handle, $item->toArray(), ';');
      }
      fclose($handle);

    }
}
