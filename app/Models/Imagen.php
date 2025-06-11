<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Imagen extends Model
{
    protected $table = 'Imagen';
    protected $primaryKey = 'id_img';
    protected $fillable = ['
    id_sitio', 
    'url_img'
    ];

    // Relación N:1 con Sitio
    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio');
    }
}

