<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Visitante extends Model
{
     use HasFactory;
     
    protected $table = 'Visitantes';
    protected $primaryKey = 'cod_visitante';
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'cod_visitante',
        'tipo_visitante',
        'Activo'
    ];
    // Relación 1:1 con Turista
    public function turista()
    {
        return $this->hasOne(Turista::class, 'cod_visitante', 'cod_visitante');
    }

    // Relación 1:1 con Institucion
    public function institucion()
    {
        return $this->hasOne(Institucion::class, 'cod_visitante', 'cod_visitante');
    }

    // Relación 1:N con Reserva
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'cod_visitante', 'cod_visitante');
    }
}
