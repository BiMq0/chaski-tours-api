<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $table = 'Visitantes';
    protected $fillable = [
    'tipo_visitante',  
    'Activo'
    ];
}
