<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporte_Reservas extends Model
{
    protected $table = 'Transporte_Reservas';
     protected $primaryKey = 'id_asignacion';
    protected $fillable = [
        'id_vehiculo',
        'id_reserva',
        'fecha',
    ];
    // Relación N:1 con Transporte
    public function transporte()
    {
        return $this->belongsTo(Transporte::class, 'id_vehiculo');
    }

    // Relación N:1 con Reserva
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva');
    }
}
