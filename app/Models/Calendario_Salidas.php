<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario_Salidas extends Model
{
    protected $table = 'Calendario_Salidas';
protected $fillable = [
    'id_tour', 
    'fecha_salida', 
    'fecha_regreso',
];
}
