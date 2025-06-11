<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Alojamiento extends Model
{
    protected $table = 'Alojamiento';
    protected $primaryKey = 'id_alojamiento';
    protected $fillable = [
        'nombre_aloj', 
        'nro_estrellas', 
        'nro_habitaciones', 
        'Activo'
    ];
    
    // Relación 1:N con Habitacion
    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class, 'id_alojamiento');
    }
    // Relación 1:N con Tour
    public function tours()
    {
        return $this->hasMany(Tour::class, 'id_alojamiento');
    }
    // Relación 1:N con Reserva
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_alojamiento');
    }
}
