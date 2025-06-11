<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario_Salidas extends Model
{
    protected $table = 'calendario_salidas';
    protected $primaryKey = 'id_salida';
    public $timestamps = true;

    protected $fillable = [
        'id_tour',
        'fecha_salida',
        'fecha_regreso',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour', 'id_tour');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_salida', 'id_salida');
    }
}
