<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alojamiento;

class Habitacion extends Model
{
    protected $table = 'Habitacion';
    public $incrementing = false;

    protected $primaryKey = ['nro_habitacion', 'id_alojamiento']; 

    protected $fillable = [
        'nro_habitacion',
        'id_alojamiento',
        'tipo_habitacion',
        'capacidad',
        'disponible'
    ];

    public $timestamps = false; 

    public function alojamiento()
    {
        return $this->belongsTo(Alojamiento::class, 'id_alojamiento', 'id_alojamiento');
    }
}
