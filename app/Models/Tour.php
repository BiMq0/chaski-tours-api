<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'Tour';
    protected $primaryKey = 'id_tour';
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
    public function alojamiento()
    {
        return $this->belongsTo(Alojamiento::class, 'id_alojamiento', 'id_alojamiento');
    }
    public function sitioFin()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio_fin', 'id_sitio');
    }
    public function sitioInicio()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio_inicio', 'id_sitio');
    }
}
