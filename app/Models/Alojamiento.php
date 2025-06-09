<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
    protected $table = 'alojamientos'; 
    protected $primaryKey = 'id_alojamiento';
    public $timestamps = true; 

    protected $fillable = [
        'nombre_aloj',
        'nro_estrellas',
        'nro_habitaciones',
        'Activo',
    ];

    // Relación con reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_alojamiento', 'id_alojamiento');
    }
}
