<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Sitio extends Model
{

    protected $table = 'Sitio';
    protected $primaryKey = 'id_sitio';
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
    
    // Relación N:1 con Ubicacion
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    // Relación 1:N con Imagen
    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'id_sitio');
    }

    // Relación M:N con Categoria (a través de la tabla pivot Sitio_Categoria)
    public function categorias()
    {
        return $this->belongsToMany(
            Sitio_Categoria::class, 
            'Sitio_Categoria', 
            'id_sitio', 
            'nombre_categoria'
        );
    }
    // Relación M:N con Tour (a través de la tabla pivot Ruta)
    public function tours()
    {
        return $this->belongsToMany(
            Tour::class, 
            'Ruta', 
            'id_sitio', 
            'id_tour'
        )->withPivot('orden');
    }
}
