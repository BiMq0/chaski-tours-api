<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'Reserva';
protected $fillable = [
    'id_visitante', 
    'id_alojamiento', 
    'id_transporte', 
    'id_salida', 
    'cantidad_personas', 
    'costo_total_reserva', 
    'estado', 
    'fecha_creacion', 
    'Activo'
];
}
