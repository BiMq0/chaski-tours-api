<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
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
    public function reservas()
{
    return $this->hasMany(Reserva::class, 'cod_visitante', 'cod_visitante');
}
}
