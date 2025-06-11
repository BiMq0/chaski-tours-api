<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    protected $table = 'Transporte';
    protected $primaryKey = 'id_vehiculo';
    protected $fillable = [
    'matricula', 
    'marca', 
    'modelo', 
    'capacidad', 
    'año', 
    'disponible', 
    'Activo'
    ];
    // Relación 1:N con TransporteReserva
    public function reservasTransporte()
    {
        return $this->hasMany(Transporte_Reservas::class, 'id_vehiculo');
    }

}
