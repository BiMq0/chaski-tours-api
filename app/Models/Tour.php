<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'Tours';
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
    // Relación N:1 con Sitio (inicio)
    public function sitioInicio()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio_inicio');
    }

    // Relación N:1 con Sitio (fin)
    public function sitioFin()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio_fin');
    }

    // Relación N:1 con Alojamiento
    public function alojamiento()
    {
        return $this->belongsTo(Alojamiento::class, 'id_alojamiento');
    }
     // Relación 1:N con CalendarioSalida
    public function salidas()
    {
        return $this->hasMany(Calendario_Salidas::class, 'id_tour');
    }

    // Relación M:N con Sitio (a través de Ruta)
    public function sitiosRuta()
    {
        return $this->belongsToMany(
            Sitio::class, 
            'Ruta', 
            'id_tour', 
            'id_sitio'
        )->withPivot('orden');
    }
}
