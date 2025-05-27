<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $table = 'Visitantes';
    protected $fillable = [
    'cod_visitante', 
    'tipo_visitante', 
    'fecha_registro', 
    'Activo'
    ];
}
