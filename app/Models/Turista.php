<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turista extends Model
{
    protected $table = "Turistas";
    
    protected $fillable = [
        'correo_electronico',
        'contrasenia',
        'documento',
        'nombre',
        'ap_pat',
        'ap_mat',
        'fecha_nac',
        'nacionalidad',
        'telefono'
    ];

    public function visitante()
    {
        return $this->belongsTo(Visitante::class, 'cod_visitante', 'cod_visitante');
    }

    public function nacionalidadRel()
    {
        return $this->belongsTo(Nacionalidad::class, 'nacionalidad', 'nacionalidad');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'cod_visitante', 'cod_visitante');
    }

}
