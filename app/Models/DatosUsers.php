<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_datos',
        'telefono',
        'fecha_nacimiento',
        'nacionalidad',
        'pais',
        'nombre_referido',
        'f_primer_pago',
        'monto',
        'identificador',
        'id_user',
    ];
}
