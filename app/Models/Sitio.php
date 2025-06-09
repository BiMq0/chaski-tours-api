<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{

    protected $primaryKey  = "id_sitio";
    protected $table = 'Sitio';
    protected $fillable = [
    'nombre', 
    'desc_conceptual_sitio', 
    'desc_historica_sitio', 
    'costo_sitio', 
    'id_ubicacion', 
    'temporada_recomendada', 
    'recomendacion_climatica', 
    'horario_apertura', 
    'horario_cierre', 
    'Activo'
    ];
    
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }
}
