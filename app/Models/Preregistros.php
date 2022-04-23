<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preregistros extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_registro',
        'name',
        'email',
        'telefono',
        'pais',
        'nacionalidad',
        'fecha_nacimiento',
        'modalidad',
        'nombre_r',
        'fecha_primer_pago',
        'monto',
        'n_banco',
        't_cuenta',
        'anombre',
        'ncuenta',
        'identificador',
        'creado',
    ];
}
