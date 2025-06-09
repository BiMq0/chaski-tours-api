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

    // Relaciones
    public function visitante()
    {
        return $this->belongsTo(Visitante::class, 'cod_visitante', 'cod_visitante');
    }

    public function alojamiento()
    {
        return $this->belongsTo(Alojamiento::class, 'id_alojamiento', 'id_alojamiento');
    }

    public function salida()
    {
        return $this->belongsTo(Calendario_Salida::class, 'id_salida', 'id_salida');
    }
}
