<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
    protected $table = 'alojamientos'; // corregido
    protected $primaryKey = 'id_alojamiento';
    public $timestamps = true; // Laravel manejará created_at y updated_at

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
