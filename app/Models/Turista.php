<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Turista extends Model
{
    protected $table = 'Turistas';
    protected $primaryKey = 'cod_visitante';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'cod_visitante', 
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
    //protected $hidden = ['contrasenia'];
    protected $casts = [
        'fecha_nac' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    // Relación 1:1 con Visitante (inversa)
    public function visitante()
    {
        return $this->belongsTo(Visitante::class, 'cod_visitante', 'cod_visitante');
    }

    // Relación N:1 con Nacionalidad
    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'nacionalidad', 'nacionalidad');
    }

}
