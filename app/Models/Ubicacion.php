<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Ubicacion extends Model
{
    protected $table = 'Ubicacion';
    protected $primaryKey = 'id_ubicacion';
    protected $fillable = [
        'departamento', 
        'municipio', 
        'zona', 
        'calle', 
        'latitud', 
        'longitud'
    ];

    // Relación 1:N con Sitio
    public function sitios()
    {
        return $this->hasMany(Sitio::class, 'id_ubicacion');
    }
}
