<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Sitio_Categoria extends Model
{
    protected $table = 'Sitio_Categoria';
    protected $primaryKey = 'nombre_categoria';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nombre_categoria'
    ];

    // Relación M:N con Sitio
    public function sitios()
    {
        return $this->belongsToMany(
            Sitio::class, 
            'Sitio_Categoria', 
            'nombre_categoria', 
            'id_sitio'
        );
    }
}
