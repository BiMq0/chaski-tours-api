<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reserva'; 

    protected $primaryKey = 'id_reserva';

    public $timestamps = false; 

    protected $fillable = [
        'cod_visitante',
        'id_alojamiento',
        'id_salida',
        'cantidad_personas',
        'costo_total_reserva',
        'estado',
        'fecha_reservacion'
    ];

   // Relación N:1 con Visitante
    public function visitante()
    {
        return $this->belongsTo(Visitante::class, 'cod_visitante');
    }

    // Relación N:1 con Alojamiento
    public function alojamiento()
    {
        return $this->belongsTo(Alojamiento::class, 'id_alojamiento');
    }

    // Relación N:1 con CalendarioSalida
    public function salida()
    {
        return $this->belongsTo(Calendario_Salidas::class, 'id_salida');
    }
    // Relación 1:N con TransporteReserva
    public function transportes()
    {
        return $this->hasMany(Transporte_Reservas::class, 'id_reserva');
    }

}
