<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dblines extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_bono',
        'id_user',
        'block',
    ];
}
