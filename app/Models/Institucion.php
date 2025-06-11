<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Institucion extends Model
{
    use HasFactory;
    protected $table = 'Instituciones';
    protected $primaryKey = 'cod_visitante';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'cod_visitante', 
        'nombre', 
        'correo_electronico', 
        'contrasenia', 
        'nacionalidad', 
        'telefono', 
        'nombre_represent', 
        'ap_pat_represent', 
        'correo_electronico_represent', 
        'telefono_represent'
    ];
   // protected $hidden = ['contrasenia'];

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
