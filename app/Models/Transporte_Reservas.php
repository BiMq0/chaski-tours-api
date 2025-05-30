<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporte_Reservas extends Model
{
    protected $table = 'Transporte_Reservas';
protected $fillable = [
    'id_vehiculo', 
    'id_reserva', 
    'fecha', 
];
}
