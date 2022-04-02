<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */    
    protected $fillable = [
        'id_user',
        'id_solicitud',
        'concepto',
        'dias',
        'date_mov',
        'date_sistema',
        'date_close',
        'date_pay',
        'monto',
        'p_intereses',
        'm_intereses',
        'saldo',
    ];
}
