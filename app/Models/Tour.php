<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'Tour';
protected $fillable = [
    'nombre_tour', 
    'descripcion_tour', 
    'costo_tour', 
    'id_sitio_inicio', 
    'id_sitio_fin', 
    'duracion_dias', 
    'duracion_noches', 
    'id_alojamiento', 
    'Activo'
];
}
