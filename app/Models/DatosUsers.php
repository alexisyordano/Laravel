<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosUsers extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
