<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'Habitacion';
protected $fillable = [
    'nro_habitacion', 
    'id_alojamiento', 
    'tipo_habitacion', 
    'capacidad', 
    'disponible', 
    'Activo'
];
}
